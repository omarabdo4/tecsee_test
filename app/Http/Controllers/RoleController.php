<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('policy-based-gate','readall-role')){
            abort(403);
        }
        $roles = Role::where("name","!=","owner")->get();
        return view('roles.index',["roles" => $roles]);
    }


    public function resource_grouped_policies()
    {
        $policies_results = Policy::all();
        $policies_resources = DB::table('policies')
            ->select('resource')->distinct()->pluck("resource");
        $policies = [];
        foreach ($policies_resources as $key => $resource) {
            $policies[$resource] = $policies_results->filter(function ($result, $key) use($resource){
                return $result->resource == $resource;
            });
        }
        return $policies;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('policy-based-gate','create-role')){
            abort(403);
        }
        return view('roles.create',["policies" => $this->resource_grouped_policies()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('policy-based-gate','create-role')){
            abort(403);
        }

        $policies_ids = Policy::pluck('id');

        $request->validate([
            'role_name' => ['required','string','max:100',Rule::notIn(['owner']),'unique:roles,name'],
            'policies' => ['array','min:1','max:500'],
            'policies.*' => ['integer', Rule::in($policies_ids)]
        ]);
        $role = new Role();
        $role->name = $request->role_name;
        $role->save();

        $role->policies()->attach($request->policies);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if(!Gate::allows('policy-based-gate','update-role')){
            abort(403);
        }

        return view('roles.edit',[
            "role" => $role,
            "policies" => $this->resource_grouped_policies(),
            "role_policies_ids" => $role->policies->pluck('id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if(!Gate::allows('policy-based-gate','update-role')){
            abort(403);
        }

        $policies_ids = Policy::pluck('id');

        $request->validate([
            'policies' => ['array','min:1','max:500'],
            'policies.*' => ['integer', Rule::in($policies_ids)]
        ]);

        $role->policies()->detach();
        $role->policies()->attach($request->policies);

        return redirect()->back()->with('status','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort(404);
    }
}
