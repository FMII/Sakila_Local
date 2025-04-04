<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id'
        ]);

        // Hashear la contraseña antes de guardar
        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);
        
        User::create($userData);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id'
        ]);

        $userData = $request->except('password');
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8'
            ], [
                'password.min' => 'La contraseña debe tener al menos 8 caracteres'
            ]);
            
            $userData['password'] = Hash::make($request->password);
        }
        
        $user->update($userData);
        
        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        // Evitar eliminar al usuario actual
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }
        
        $user->delete();
        
        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}