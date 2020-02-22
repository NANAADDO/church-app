@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'/admin/birthdaynotification/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.birthdaynotification.form', ['formMode' => 'edit','read'=>true,'route'=>'/admin/birthdaynotification'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

