@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'/admin/collectiongroups/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.collectiongroups.form', ['formMode' => 'edit','read'=>true,'route'=>'/admin/collectiongroups'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

