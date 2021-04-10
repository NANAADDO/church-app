@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create Welfaredetailreport'])
                        {!! Form::open(['url' => '/admin/welfaredetailreport', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.welfaredetailreport.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/welfaredetailreport'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
