@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lapangan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lapangan, ['route' => ['lapangans.update', $lapangan->id], 'method' => 'patch']) !!}

                        @include('lapangans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection