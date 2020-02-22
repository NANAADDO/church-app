@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Paymentplantype'])
                        {!! Form::open(['url' => '/admin/paymentplantypes', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.paymentplantypes.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/paymentplantypes'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
