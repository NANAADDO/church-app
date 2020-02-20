@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'Create Role'])

    {!! Form::open(['url' => '/admin/roles', 'class' => 'form-horizontal user', 'files' => true]) !!}

    @include ('admin.roles.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/roles'])

    {!! Form::close() !!}
    @include('crud.renderfooter')
@endsection
