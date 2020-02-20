@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'View '.$data->name.' details'])

{{  Form::model($data->toArray(), array('method' => 'PATCH', 'url' =>'admin/users/update/'.$data->id, 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

@csrf()

@include ('admin.users.form', ['formMode' => 'edit','read'=>true])

{!! Form::close() !!}
@include('crud.renderfooter')

@endsection
