
{!! Form::open(['route' => 'admin.article-categories.store']) !!}
    @csrf

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', old('title'), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}