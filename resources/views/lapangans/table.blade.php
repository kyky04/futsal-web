<table class="table table-responsive" id="lapangans-table">
    <thead>
        <th>Nama</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($lapangans as $lapangan)
        <tr>
            <td>{!! $lapangan->nama !!}</td>
            <td>{!! $lapangan->latitude !!}</td>
            <td>{!! $lapangan->longitude !!}</td>
            <td>
                {!! Form::open(['route' => ['lapangans.destroy', $lapangan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('lapangans.show', [$lapangan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('lapangans.edit', [$lapangan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>