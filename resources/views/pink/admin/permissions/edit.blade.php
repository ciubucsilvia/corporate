{!! Form::open(['route' => ['admin.permissions.update', $permission->id]]) !!}
    @csrf
    @method('PUT')

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name', $permission->name), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <h3>Add Roles</h3>
        @if($roles)
            @foreach($roles as $role)
            {{ Form::checkbox('roles[]', $role->name, old('roles', $role->hasPermissionTo($permission))) }}    
            {{ Form::label('roles[]', $role->name) }} <br>
            @endforeach
        @endif
    </div>
    
    <div class="card-footer">
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}