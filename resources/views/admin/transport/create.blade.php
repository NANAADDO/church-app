@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Transport'])
                        {!! Form::open(['url' => '/admin/transport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.transport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/transport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
