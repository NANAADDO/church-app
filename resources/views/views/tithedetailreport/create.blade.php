@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Tithedetailreport'])
                        {!! Form::open(['url' => '/admin/tithedetailreport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.tithedetailreport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/tithedetailreport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
