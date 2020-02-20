@extends('layouts.admin')

@section('content')

@include('crud.render',['title'=>'Create user'])

        {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal user', 'files' => true]) !!}
           @csrf()

        @include ('admin.users.form', ['formMode' => 'create','read'=>false])

        {!! Form::close() !!}
@include('crud.renderfooter')
@endsection
