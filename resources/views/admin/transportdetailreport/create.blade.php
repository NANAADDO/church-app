@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Transportdetailreport'])
                        {!! Form::open(['url' => '/admin/transportdetailreport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.transportdetailreport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/transportdetailreport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
