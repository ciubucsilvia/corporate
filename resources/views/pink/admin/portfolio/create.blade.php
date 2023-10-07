{!! Form::open(['route' => 'admin.portfolio.store', 'enctype' => 'multipart/form-data']) !!}
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
        {{ Form::label('category_id', 'Category') }}
        {{ Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::textarea('content', old('content'), ['class' => 'form-control']) }}
    </div>

    <div class="form-check">
        {{ Form::checkbox('is_published', old('is_published')) }}
        {{ Form::label('is_published', 'is published') }}
    </div>

    <div class="card-footer">
        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}