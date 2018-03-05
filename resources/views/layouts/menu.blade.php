<li class="{{ Request::is('lapangans*') ? 'active' : '' }}">
    <a href="{!! route('lapangans.index') !!}"><i class="fa fa-edit"></i><span>Lapangans</span></a>
</li>

<li class="{{ Request::is('teams*') ? 'active' : '' }}">
    <a href="{!! route('teams.index') !!}"><i class="fa fa-group"></i><span>Teams</span></a>
</li>

<li class="{{ Request::is('jadwals*') ? 'active' : '' }}">
    <a href="{!! route('jadwals.index') !!}"><i class="fa fa-calendar"></i><span>Jadwals</span></a>
</li>

<li class="{{ Request::is('pemains*') ? 'active' : '' }}">
    <a href="{!! route('pemains.index') !!}"><i class="fa fa-soccer-ball-o "></i><span>Pemains</span></a>
</li>

<li class="{{ Request::is('kompetisis*') ? 'active' : '' }}">
    <a href="{!! route('kompetisis.index') !!}"><i class="fa fa-diamond"></i><span>Kompetisis</span></a>
</li>

<li class="{{ Request::is('turnamens*') ? 'active' : '' }}">
    <a href="{!! route('turnamens.index') !!}"><i class="fa fa-edit"></i><span>Turnamens</span></a>
</li>

