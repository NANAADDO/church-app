@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'/admin/transport/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.transport.form', ['formMode' => 'edit','read'=>true,'route'=>'/admin/transport'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

