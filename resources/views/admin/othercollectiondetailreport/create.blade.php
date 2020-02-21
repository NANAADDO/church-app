@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create othercollectiondetailreport'])
                        {!! Form::open(['url' => '/admin/othercollectiondetailreport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.othercollectiondetailreport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/othercollectiondetailreport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
