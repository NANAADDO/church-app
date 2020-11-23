@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Sms Groups'])
                        {!! Form::open(['url' => '/admin/smsgroups', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.smsgroups.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/smsgroups'])


    {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
