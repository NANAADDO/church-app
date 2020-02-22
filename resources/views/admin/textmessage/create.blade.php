@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Textmessage'])
                        {!! Form::open(['url' => '/admin/textmessage', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.textmessage.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/textmessage'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
