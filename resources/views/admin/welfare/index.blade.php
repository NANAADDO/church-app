@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <?php
        $right =  Permissions::confirm_user_permission('/admin/welfare');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">

                @include('crud.top',['routename'=>'admin/welfare','modulename'=>'Welfare collection'])
                @include('includes.history')

            </div>
        </div>
    </div>

@endsection
