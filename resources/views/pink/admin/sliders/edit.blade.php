{!! Form::open(['route' => ['admin.sliders.update', $slider->id], 'enctype' => 'multipart/form-data']) !!}
    @csrf
    @method('PUT')

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', old('title', $slider->title), ['class' => 'form-control']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image', old('image'), ['class' => 'form-control']) }}
        <img src="/{{ env('THEME') }}/images/sliders/{{ $slider->getMiniImage() }}" class="img-thumbnail" alt="...">
    </div>
    
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', old('description', $slider->description), ['class' => 'form-control']) }}
    </div>

    <div class="form-check">
        {{ Form::checkbox('active', 1, old('active', $slider->active)) }}
        {{ Form::label('active', 'Active') }}
        
    </div>

    <div class="row card-footer">
        <div class="col-md-6">
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        </div>
    </div>
{!! Form::close() !!}
    
    
