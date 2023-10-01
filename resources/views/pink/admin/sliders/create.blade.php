{!! Form::open(['route' => 'admin.sliders.store', 'enctype' => 'multipart/form-data']) !!}
    @csrf

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', old('title'), ['class' => 'form-control']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image', old('image'), ['class' => 'form-control']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
    </div>

    <div class="form-check">
        {{ Form::checkbox('active', old('active')) }}
        {{ Form::label('active', 'Active') }}
        
    </div>

    <div class="card-footer">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}