<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required|in:admin,user', 
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    
        return redirect()->route('admin.users')->with('status', 'Usuário cadastrado com sucesso!');
    }
    

    public function index(Request $request)
    {
        $users = User::all();
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
