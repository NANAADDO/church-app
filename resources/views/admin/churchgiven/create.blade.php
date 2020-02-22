@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Church Collection'])

                        {!! Form::open(['url' => '/admin/churchgiven', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.churchgiven.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/churchgiven'])

                        {!! Form::close() !!}
@include('crud.renderfooter')
@endsection
