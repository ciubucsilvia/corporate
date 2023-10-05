<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->title = 'Permission';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$this->user->hasPermissionTo('View Permissions')){
            abort(403);
        }

        $this->title .= 's';

        $permissions = Permission::all();

        $this->content = view(env('THEME') . '.admin.permissions.index',
            compact('permissions'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->user->hasPermissionTo('Create Permission')){
            abort(403);
        }

        $this->title .= '::create';

        $roles = Role::all();

        $this->content = view(env('THEME') . '.admin.permissions.create',
            compact('roles'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        if(!$this->user->hasPermissionTo('Create Permission')){
            abort(403);
        }

        $permission = Permission::create($request->all());
        $permission->assignRole($request->roles);

        return redirect()
            ->route('admin.permissions.index')
            ->with(['success' => 'Successfully saved!']);
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
        if(!$this->user->hasPermissionTo('Update Permission')){
            abort(403);
        }

        $permission = Permission::find($id);
        $roles = Role::all();

        $this->title .= '::edit';
        $this->content = view(env('THEME') . '.admin.permissions.edit', 
            compact('permission', 'roles'));
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        if(!$this->user->hasPermissionTo('Update Permission')){
            abort(403);
        }

        $permission = Permission::find($id);
        
        if($permission) {
            $permission->update($request->all());
            $permission->syncRoles($request->roles);
        }

        return redirect()
            ->route('admin.permissions.index')
            ->with(['success' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$this->user->hasPermissionTo('Delete Permission')){
            abort(403);
        }

        $permission = Permission::find($id);
        $permission->delete();
        $permission->syncRoles();

        return redirect()
            ->route('admin.permissions.index')
            ->with(['success' => 'Permission '. $permission->name . ' updated!']);
    }
}
