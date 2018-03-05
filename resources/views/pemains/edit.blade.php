@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pemain
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pemain, ['route' => ['pemains.update', $pemain->id], 'method' => 'patch']) !!}

                        @include('pemains.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection