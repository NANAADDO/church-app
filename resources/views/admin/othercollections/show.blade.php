@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'/admin/othercollections/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('%%viewTemplateDir%%.form', ['formMode' => 'edit','read'=>true,'route'=>'/admin/othercollections'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

