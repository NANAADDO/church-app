@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'/admin/textmessage/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.textmessage.form', ['formMode' => 'edit','read'=>true,'route'=>'/admin/textmessage'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

