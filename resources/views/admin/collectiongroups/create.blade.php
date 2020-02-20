@extends('layouts.admin')

@section('content')
@include('crud.render',['title'=>'Create collectiongroup'])
                        {!! Form::open(['url' => '/admin/collectiongroups', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        @include ('admin.collectiongroups.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/collectiongroups'])

                        {!! Form::close() !!}
 @include('crud.renderfooter')
@endsection
