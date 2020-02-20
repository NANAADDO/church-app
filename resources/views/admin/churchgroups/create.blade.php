@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'Create Church Groups'])

                        {!! Form::open(['url' => '/admin/churchgroups', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.churchgroups.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/churchgroups'])

                        {!! Form::close() !!}
@endsection
