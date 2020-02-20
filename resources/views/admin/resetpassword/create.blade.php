@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Reset password'])
                        {!! Form::open(['url' => '/admin/resetpassword', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.resetpassword.form', ['formMode' => 'Change Password','read'=>false,'route'=>'/admin/resetpassword'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
