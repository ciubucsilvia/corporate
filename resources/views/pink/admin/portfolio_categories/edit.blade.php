
{!! Form::open(['route' => ['admin.portfolio-categories.update', $portfolioCategory->id]]) !!}
    @csrf
    @method('PATCH')

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', 
            old('title', $portfolioCategory->title), 
            ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', 
            old('description', $portfolioCategory->description), 
            ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}

{!! Form::close() !!}