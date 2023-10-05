<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->title = 'Role';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$this->user->hasPermissionTo('View Roles')){
            abort(403);
        }

        $this->title .= 's';

        $roles = Role::all();

        $this->content = view(env('THEME') . '.admin.roles.index', 
            compact('roles'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->user->hasPermissionTo('Create Role')){
            abort(403);
        }

        $this->title .= '::create';
        $permissions = Permission::all();

        $this->content = view(env('THEME') . '.admin.roles.create',
            compact('permissions'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        if(!$this->user->hasPermissionTo('Create Role')){
            abort(403);
        }

        $role = Role::create($request->all());

        $permissionsNames = $request->input('permissions');
        $role->syncPermissions($permissionsNames);

        if($role){
            return redirect()
                ->route('admin.roles.index')
                ->with(['success' => 'Successfully saved!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!$this->user->hasPermissionTo('Update Role')){
            abort(403);
        }

        $this->title .= '::edit';
        $role = Role::find($id);
        $permissions = Permission::all();

        $this->content = view(env('THEME') . '.admin.roles.edit',
            compact('role', 'permissions'));
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        if(!$this->user->hasPermissionTo('Update Role')){
            abort(403);
        }

        $role = Role::find($id);
        if($role) {
            $role->update($request->all());
            $role->syncPermissions($request->input('permissions'));
        }
        
        return redirect()
            ->route('admin.roles.index')
            ->with(['success' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$this->user->hasPermissionTo('Delete Role')){
            abort(403);
        }

        $role = Role::find($id);
        $role->delete();
        $role->syncPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with(['success' => 'Role ' . $role->name . ' deleted!']);
    }
}
