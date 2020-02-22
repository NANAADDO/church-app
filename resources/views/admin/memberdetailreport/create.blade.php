@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Memberdetailreport'])
                        {!! Form::open(['url' => '/admin/memberdetailreport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.memberdetailreport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/memberdetailreport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
