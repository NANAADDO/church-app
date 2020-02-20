@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'admin/branch/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.branch.form', ['formMode' => 'edit','read'=>true])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection
