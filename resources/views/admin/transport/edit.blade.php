@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'Edit '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'route' =>['transport.update',$data->id], 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.transport.form', ['formMode' => 'update','read'=>false,'route'=>'/admin/transport'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

