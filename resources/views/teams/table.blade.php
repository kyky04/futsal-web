<table class="table table-responsive" id="teams-table">
    <thead>
        <th>Nama</th>
        <th>Home Base</th>
        <th>Manager Team</th>
        <th>Email</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($teams as $team)
        <tr>
            <td>{!! $team->nama !!}</td>
            <td>{!! $team->lapang->nama !!}</td>
            <td>{!! $team->user->name !!}</td>
            <td>{!! $team->user->email !!}</td>
            <td>
                {!! Form::open(['route' => ['teams.destroy', $team->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('teams.show', [$team->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('teams.edit', [$team->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>