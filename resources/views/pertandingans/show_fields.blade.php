<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pertandingan->id !!}</p>
</div>

<!-- Id Team Home Field -->
<div class="form-group">
    {!! Form::label('id_team_home', 'Id Team Home:') !!}
    <p>{!! $pertandingan->id_team_home !!}</p>
</div>

<!-- Id Team Away Field -->
<div class="form-group">
    {!! Form::label('id_team_away', 'Id Team Away:') !!}
    <p>{!! $pertandingan->id_team_away !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $pertandingan->status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $pertandingan->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $pertandingan->updated_at !!}</p>
</div>

