<a href="{{ route('admin.sliders.create') }}" class="btn btn-info btn-lg"> Create slider</a>
@if($paginator->isNotEmpty())
<table class="table table-bordered">
<thead>
    <tr>
        <td>#</td>
        <td>Image</td>
        <td>Active</td>
    </tr>
</thead>
<tbody>
    @foreach($paginator as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td><a href="{{ route('admin.sliders.edit', $item->id) }}">
               <img src="/{{env('THEME') }}/images/sliders/{{ $item->getMiniImage() }}" alt={{ $item->title }}> 
            </a></td>
            <td>
                <input type="checkbox" disabled
                @checked($item->active)>
            </td>
        </tr>
    @endforeach
</tbody>
</table>

<div class="card-footer clearfix">
    {{ $paginator->links() }}    
</div>
<!-- /.card -->
@endif