@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/birthdaynotification');
        ?>
    {!! Form::open(['url' => '/admin/birthdaynotification', 'class' => 'form-horizontal user', 'files' => true]) !!}

    @include ('admin.birthdaynotification.form', ['formMode' => 'create','read'=>false,'route'=>'/admin/birthdaynotification'])
    {!!Form::close()!!}
            </div>



@endsection
