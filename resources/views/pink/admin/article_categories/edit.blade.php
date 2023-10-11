
{!! Form::open(['route' => ['admin.article-categories.update', $articleCategory->id]]) !!}
    @csrf
    @method('PATCH')

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', 
            old('title', $articleCategory->title), 
            ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', 
            old('description', $articleCategory->description), 
            ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}

{!! Form::close() !!}