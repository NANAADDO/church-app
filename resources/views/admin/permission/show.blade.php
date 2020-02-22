@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'/admin/permission/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.permission.form', ['formMode' => 'edit','read'=>true,'route'=>'/admin/permission'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

