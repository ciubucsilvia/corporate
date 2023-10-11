{!! Form::open(['route' => ['admin.articles.update', $article->id], 'enctype' => 'multipart/form-data']) !!}
    @csrf
    @method('PATCH')

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', old('title', $article->title), ['class' => 'form-control']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image', old('image'), ['class' => 'form-control']) }}
        <img src="/{{ env('THEME') }}/images/articles/{{ $article->getMiniImage() }}" class="img-thumbnail" alt="...">
    </div>

    <div class="form-group">
        {{ Form::label('category_id', 'Category') }}
        {{ Form::select('category_id', 
            $categories, 
            old('category_id', $article->category_id), 
            ['class' => 'form-control']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('text', 'Text') }}
        {{ Form::textarea('text', old('text', $article->text), ['class' => 'form-control']) }}
    </div>

    <div class="form-check">
        {{ Form::checkbox('is_published', 1, old('is_published', $article->is_published)) }}
        {{ Form::label('is_published', 'Published') }}
    </div>

    <div class="card-footer">
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    </div>
    
{!! Form::close() !!}