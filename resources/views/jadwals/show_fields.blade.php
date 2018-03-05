<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $jadwal->id !!}</p>
</div>

<!-- Id Team Field -->
<div class="form-group">
    {!! Form::label('id_team', 'Id Team:') !!}
    <p>{!! $jadwal->id_team !!}</p>
</div>

<!-- Waktu Field -->
<div class="form-group">
    {!! Form::label('waktu', 'Waktu:') !!}
    <p>{!! $jadwal->waktu !!}</p>
</div>

<!-- Hari Field -->
<div class="form-group">
    {!! Form::label('hari', 'Hari:') !!}
    <p>{!! $jadwal->hari !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $jadwal->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $jadwal->updated_at !!}</p>
</div>

