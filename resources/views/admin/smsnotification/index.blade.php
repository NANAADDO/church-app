@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/smsnotification');
        ?>
    {!! Form::open(['url' => '/admin/smsnotification', 'class' => 'form-horizontal user', 'files' => true]) !!}

    @include ('admin.smsnotification.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/smsnotification'])
    {!!Form::close()!!}
    </div>


@endsection
