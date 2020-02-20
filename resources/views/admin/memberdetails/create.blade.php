@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Member Profile'])
                        {!! Form::open(['url' => '/admin/memberdetails', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.memberdetails.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/memberdetails'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
