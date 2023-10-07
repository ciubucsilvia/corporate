<a href="{{ route('admin.permissions.create') }}" class="btn btn-info btn-lg">Create</a>
<table class="table">
    @foreach($permissions as $permission)
        <tr>
            <td>
                <a href="{{ route('admin.permissions.edit', $permission->id) }}">
                    {{ $permission->name }}
                </a>
            </td>
            <td>
                {!! Form::open(['route' => ['admin.permissions.destroy', $permission->id]]) !!}
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary">delete</button>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
</table>

<div class="card-footer clearfix">
    {{ $permissions->links() }}    
</div>