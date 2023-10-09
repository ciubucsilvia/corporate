<a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary btn-lg">Create</a>
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
                    true, 
                    $item->is_published, 
                    $attributes = ['disabled']) }}</td>
                <td>
                    <a href="{{ route('admin.portfolio.edit', $item->id) }}">
                    {{ $item->title }}</a>
                </td>
                <td>{{ $item->category->title }}</td>
                <td>
                    {!! Form::open(['route' => ['admin.portfolio.destroy', $item->id]]) !!}
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