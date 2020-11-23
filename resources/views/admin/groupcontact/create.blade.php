@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Groupcontact'])
                        {!! Form::open(['url' => '/admin/groupcontact', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.groupcontact.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/groupcontact'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
