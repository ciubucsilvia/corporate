{!! Form::open(['route' => 'admin.permissions.store']) !!}
    @csrf

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <h3>Add Roles</h3>
        @if($roles)
            @foreach($roles as $role)
            {{ Form::checkbox('roles[]', $role->name, old('roles')) }}    
            {{ Form::label('roles[]', $role->name) }} <br>
            @endforeach
        @endif
    </div>
    
    <div class="card-footer">
        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}