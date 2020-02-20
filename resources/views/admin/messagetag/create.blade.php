@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Messagetag'])
                        {!! Form::open(['url' => '/admin/messagetag', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.messagetag.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/messagetag'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
