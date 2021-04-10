@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Dailycollectionreport'])
                        {!! Form::open(['url' => '/admin/dailycollectionreport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.dailycollectionreport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/dailycollectionreport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
