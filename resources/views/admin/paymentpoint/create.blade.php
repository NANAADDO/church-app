@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Paymentpoint'])
                        {!! Form::open(['url' => '/admin/paymentpoint', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.paymentpoint.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/paymentpoint'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
