<table class="table table-responsive" id="pemains-table">
    <thead>
        <th>Nama</th>
        <th>Id Team</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($pemains as $pemain)
        <tr>
            <td>{!! $pemain->nama !!}</td>
            <td>{!! $pemain->id_team !!}</td>
            <td>
                {!! Form::open(['route' => ['pemains.destroy', $pemain->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pemains.show', [$pemain->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pemains.edit', [$pemain->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>