<table class="table">
    <tr>
        <td>Name</td>
        <td>Email</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}">
                    {{ $user->name }}
                </a>
            </td>
            <td>{{ $user->email }}</td>
            <td>
                {!! Form::open(['route' => ['admin.users.destroy', $user->id]]) !!}
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary">delete</button>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
</table>

<div class="card-footer clearfix">
    {{ $users->links() }}    
</div>