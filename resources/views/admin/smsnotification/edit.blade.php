@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'Edit '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'route' =>['smsnotification.update',$data->id], 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.smsnotification.form', ['formMode' => 'update','read'=>false,'route'=>'/admin/smsnotification'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

