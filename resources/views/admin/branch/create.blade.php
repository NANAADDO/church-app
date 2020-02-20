@extends('layouts.admin')

@section('content')

    @include('crud.render',['title'=>'Create Branch'])

                        {!! Form::open(['url' => '/admin/branch', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.branch.form', ['formMode' => 'create','read'=>false])

                        {!! Form::close() !!}
    @include('crud.renderfooter')
@endsection
