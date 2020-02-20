@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'Edit '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'route' =>['users.update',$data->id], 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.users.form', ['formMode' => 'update','read'=>false])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection
