<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\UserRepository;

class UserController extends AdminController
{
    private $user_repsitory;

    public function __construct()
    {
        parent::__construct();
        $this->title = 'User';

        $this->user_repository = app(UserRepository::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$this->user->hasPermissionTo('View Users')){
            abort(403);
        }

        $this->title .= 's';
        $users = $this->user_repository->getUsers();
        
        $this->content = view(env('THEME') . '.admin.users.index', 
            compact('users'));
        
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        if(!$this->user->hasPermissionTo('Update User')){
            abort(403);
        }

        $this->title .= '::edit';

        $user = $this->user_repository->getById($id);
        $roles = $this->role_repository->getForCheckbox();
        
        $this->content = view(env('THEME') . '.admin.users.edit', 
            compact('user', 'roles'));
        
            return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = $this->user_repository->getById($id);

        if($user) {
            $user->update($request->all());
            $user->syncRoles($request->roles);
        }
        
        return redirect()
            ->route('admin.users.index')
            ->with(['success' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$this->user->hasPermissionTo('Delete User')){
            abort(403);
        }

        $user = $this->user_repository->getById($id);
        if($user) {
            $user->delete();
            $user->syncRoles([]);
        }

        return redirect()
            ->route('admin.users.index')
            ->with(['success' => 'Role ' . $user->name . ' deleted!']);
    }
}
