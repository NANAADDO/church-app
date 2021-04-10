@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create SmsNotification'])
                        {!! Form::open(['url' => 'smsnotification', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.smsnotification.form', ['formMode' => 'create','read'=>false,'route'=>'smsnotification'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
