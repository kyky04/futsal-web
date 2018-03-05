<table class="table table-responsive" id="turnamens-table">
    <thead>
        <th>Nama</th>
        <th>Waktu</th>
        <th>Tempat</th>
        <th>Keterangan</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($turnamens as $turnamen)
        <tr>
            <td>{!! $turnamen->nama !!}</td>
            <td>{!! $turnamen->waktu !!}</td>
            <td>{!! $turnamen->tempat !!}</td>
            <td>{!! $turnamen->keterangan !!}</td>
            <td>
                {!! Form::open(['route' => ['turnamens.destroy', $turnamen->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('turnamens.show', [$turnamen->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('turnamens.edit', [$turnamen->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>