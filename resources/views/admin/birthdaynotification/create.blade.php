@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Birthdaynotification'])
                        {!! Form::open(['url' => '/admin/birthdaynotification', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.birthdaynotification.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/birthdaynotification'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
