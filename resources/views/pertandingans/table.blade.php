<table class="table table-responsive" id="pertandingans-table">
    <thead>
        <th>Id Team Home</th>
        <th>Id Team Away</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($pertandingans as $pertandingan)
        <tr>
            <td>{!! $pertandingan->id_team_home !!}</td>
            <td>{!! $pertandingan->id_team_away !!}</td>
            <td>{!! $pertandingan->status !!}</td>
            <td>
                {!! Form::open(['route' => ['pertandingans.destroy', $pertandingan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pertandingans.show', [$pertandingan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pertandingans.edit', [$pertandingan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>