@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Memberdebtdetailreport'])
                        {!! Form::open(['url' => '/admin/memberdebtdetailreport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.memberdebtdetailreport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/memberdebtdetailreport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
