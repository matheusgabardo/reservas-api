<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function createAdmin()
    {
        return view('admin.users.createAdmin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.users')->with('status', 'Admin cadastrado com sucesso!');
    }

    public function index(Request $request)
    {
        $users = User::all(); // ou use paginação com paginate(10)
        return view('admin.users.index', [
            'title' => 'Admin - Usuários',
            'users' => $users,
        ]);
    }
    public function destroy(User $user)
    {
        $userName = $user->name;

        $user->delete();
    
        session()->flash('status', "Usuário {$userName} removido com sucesso.");

        return redirect()->route('admin.users');
    }
    
}
