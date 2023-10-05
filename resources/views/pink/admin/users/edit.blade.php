{!! Form::open(['route' => ['admin.users.update', $user->id]]) !!}
    @csrf
    @method('PUT')

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name', $user->name), ['class' => 'form-control']) }}
    </div>
    <h3>Roles:</h3>    
    @if($roles)
        @foreach($roles as $role)
            {{ Form::checkbox('roles[]', 
                $role->name, 
                old('role', $user->hasRole($role))) }}    
            {{ Form::label('role[]', $role->name) }} <br>
            @if($role->permissions->isNotEmpty())
                <h4>Permissions</h4>
                <ul>
                    @foreach($role->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    @endif

    <div class="card-footer">
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}