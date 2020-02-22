@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        {!! Form::open(['url' => '/admin/permission', 'class' => 'form-horizontal user']) !!}

        @include ('admin.permission.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/permission'])

        {!! Form::close() !!}

    </div>
@endsection
