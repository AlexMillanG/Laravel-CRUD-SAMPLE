<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request){
        $validated = $request->validate([
            'email'=> 'required|email|unique:users',
            'password'=>'required|min:3|max:60',
            'name' =>'required|string',
            'roles' =>'required|array',
            'roles.*'=>'integer|exists:roles,id'
        ]);

        return DB::transaction(function () use ($validated) {

            $userData = collect($validated)->except('roles')->toArray();

            $user = User::create($userData);

            // 👇 aquí asignas los roles (tabla pivote)
            $user->roles()->sync($validated['roles']);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(["token"=>$token, "user"=>$user],200);
        });
    }

    public function login (Request $request){

         $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);

        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json(["message"=>"credenciales incorrectas"],401);
        }

        $user = Auth::user();


        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return response()->json(["token"=>$token, "user" => $user ],200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
