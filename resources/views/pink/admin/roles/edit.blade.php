{!! Form::open(['route' => ['admin.roles.update', $role->id]]) !!}
    @csrf
    @method('PUT')
    
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name', $role->name), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <h3>Permissions</h3>
        @if($permissions)
            @foreach($permissions as $permission)
                {{ Form::checkbox('permissions[]', 
                    $permission->name, 
                    old('permissions', $role->hasPermissionTo($permission), )) }}    
                {{ Form::label('permissions[]', $permission->name) }} <br>
            @endforeach
        @endif
    </div>
    
    <div class="card-footer">
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}