<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(!Gate::allows('policy-based-gate','readall-user')){
            abort(403);
        }

        $roles = Role::all();
        $users = User::with('role')->get();
        return view('users.index',[
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function assign(Request $request, User $user)
    {
        if(!Gate::allows('policy-based-gate','assign-user')){
            abort(403);
        }

        $roles_ids = Role::pluck('id');
        $request->validate([
            'role_id' => ['required','integer', Rule::in($roles_ids)]
        ]);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->back()->with('status','user updated successfully');
    }
}
