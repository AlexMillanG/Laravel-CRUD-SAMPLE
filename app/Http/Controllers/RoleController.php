<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|string|max:50|unique:roles,role',
        ]);

        return Role::create($validated);
    }

    public function show(Role $role)
    {
        return $role->load('users');
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'role' => 'required|string|max:50|unique:roles,role,' . $role->id,
        ]);

        $role->update($validated);

        return $role;
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->noContent();
    }
}
