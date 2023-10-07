<a href="{{ route('admin.roles.create') }}" class="btn btn-info btn-lg">Create</a>
<table class="table">
    <tr>
        <td>Role</td>
        <td></td>
    </tr>
    @foreach($roles as $role)
        <tr>
            <td>
                <a href="{{ route('admin.roles.edit', $role->id) }}">
                    {{ $role->name }}
                </a>
            </td>
            <td>
                {!! Form::open(['route' => ['admin.roles.destroy', $role->id]]) !!}
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary">delete</button>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
</table>

<div class="card-footer clearfix">
    {{ $roles->links() }}    
</div>