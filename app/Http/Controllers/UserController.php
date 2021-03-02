<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = User::with('role')->get();
        return view('users.index',[
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function assign(Request $request, User $user)
    {
        $roles_ids = Role::pluck('id');
        $request->validate([
            'role_id' => ['required','integer', Rule::in($roles_ids)]
        ]);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->back()->with('status','user updated successfully');
    }
}
