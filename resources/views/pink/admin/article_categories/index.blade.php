<a href="{{ route('admin.article-categories.create') }}" class="btn btn-primary btn-lg">Create</a>
@if($items->isNotEmpty())
    <table class="table">
        <tr>
            <td></td>
            <td>Title</td>
            <td>Alias</td>
            <td></td>
        </tr>
        @foreach($items as $item)  
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <a href="{{ route('admin.article-categories.edit', $item->id) }}">
                    {{ $item->title }}</a>
                </td>
                <td>{{ $item->slug }}</td>
                <td>
                    {!! Form::open(['route' => ['admin.article-categories.destroy', $item->id]]) !!}
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