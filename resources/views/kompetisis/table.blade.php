<table class="table table-responsive" id="kompetisis-table">
    <thead>
        <th>Nama</th>
        <th>Waktu</th>
        <th>Keterangan</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($kompetisis as $kompetisi)
        <tr>
            <td>{!! $kompetisi->nama !!}</td>
            <td>{!! $kompetisi->waktu !!}</td>
            <td>{!! $kompetisi->keterangan !!}</td>
            <td>
                {!! Form::open(['route' => ['kompetisis.destroy', $kompetisi->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('kompetisis.show', [$kompetisi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('kompetisis.edit', [$kompetisi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>