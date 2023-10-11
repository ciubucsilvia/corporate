<a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-lg">Create</a>
@if($items->isNotEmpty())
    <table class="table">
        <tr>
            <td></td>
            <td>Published</td>
            <td>Title</td>
            <td>Category</td>
            <td></td>
        </tr>
        @foreach($items as $item)  
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ Form::checkbox('published', 
                    $item->is_published, 
                    ($item->is_published == 1) ? true : false,
                    $attributes = ['disabled']) }}</td>
                <td>
                    <a href="{{ route('admin.articles.edit', $item->id) }}">
                    {{ $item->title }}</a>
                </td>
                <td>{{ $item->category->title }}</td>
                <td>
                    {!! Form::open(['route' => ['admin.articles.destroy', $item->id]]) !!}
                        @csrf
                        @method('DELETE')
                        {{ Form::submit('Delete', ['class' => 'btn btn-secondary']) }}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    <div class="card-footer clearfix">
        {{ $items->links() }}    
    </div>
@endif