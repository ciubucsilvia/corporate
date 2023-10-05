{!! Form::open(['route' => 'admin.roles.store']) !!}
    @csrf

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <h3>Add Permissions</h3>
        @if($permissions)
            @foreach($permissions as $permission)
            {{ Form::checkbox('permissions[]', $permission->name, old('permissions')) }}    
            {{ Form::label('permissions[]', $permission->name) }} <br>
            @endforeach
        @endif
    </div>
        
    
    <div class="card-footer">
        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}