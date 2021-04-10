@extends('layouts.admin')

@section('content')
    @include('crud.render',['title'=>'Edit '.$data->name.' details'])

    {{  Form::model($data->toArray(), array('method' => 'PATCH', 'route' =>['memberdetailreport.update',$data->id], 'class'=>'form-horizontal user', 'role'=>'form', 'files'=>'true'  )) }}

    @csrf()

    @include ('admin.memberdetailreport.form', ['formMode' => 'update','read'=>false,'route'=>'/admin/memberdetailreport'])

    {!! Form::close() !!}
    @include('crud.renderfooter')

@endsection

