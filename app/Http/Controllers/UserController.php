<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::with('roles')->get();
    }

    public function show(User $user)
    {
        return $user->load('roles');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'    => 'sometimes|required|string',
            'email'   => 'sometimes|required|email|unique:users,email,' . $user->id,
            'roles'   => 'sometimes|array',
            'roles.*' => 'integer|exists:roles,id',
        ]);

        if (isset($validated['roles'])) {
            $user->roles()->sync($validated['roles']);
            unset($validated['roles']);
        }

        if (!empty($validated)) {
            $user->update($validated);
        }

        return $user->load('roles');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
