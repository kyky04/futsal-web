<table class="table table-responsive" id="tims-table">
    <thead>
        <th>Nama</th>
        <th>Id Lapang</th>
        <th>Id User</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tims as $tim)
        <tr>
            <td>{!! $tim->nama !!}</td>
            <td>{!! $tim->id_lapang !!}</td>
            <td>{!! $tim->id_user !!}</td>
            <td>
                {!! Form::open(['route' => ['tims.destroy', $tim->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tims.show', [$tim->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tims.edit', [$tim->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>