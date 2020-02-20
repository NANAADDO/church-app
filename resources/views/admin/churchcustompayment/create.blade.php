@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Church Custom Payment'])
                        {!! Form::open(['url' => '/admin/churchcustompayment', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.churchcustompayment.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/churchcustompayment'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
