@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Payment.php'])
                        {!! Form::open(['url' => '/admin/membercustompayment', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.membercustompayment.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/membercustompayment'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
