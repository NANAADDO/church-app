@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'/admin/messagetag/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.messagetag.form', ['formMode' => 'edit','read'=>true,'route'=>'/admin/messagetag'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

