@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'Edit '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'route' =>['churchgiven.update',$data->id], 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.churchgiven.form', ['formMode' => 'update','read'=>false,'route'=>'/admin/churchgiven'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

