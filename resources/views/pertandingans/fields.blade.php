<!-- Id Team Home Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_team_home', 'Id Team Home:') !!}
    {!! Form::text('id_team_home', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Team Away Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_team_away', 'Id Team Away:') !!}
    {!! Form::text('id_team_away', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pertandingans.index') !!}" class="btn btn-default">Cancel</a>
</div>
