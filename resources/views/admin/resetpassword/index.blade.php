@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/resetpassword');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">

                           @include('crud.top',['routename'=>'admin/resetpassword','modulename'=>'Resetpassword'])
  @if ($data->count())
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Oldpasssword</th><th>Password</th><th>Password Confirmation</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>

                                        <td>{{ $item->oldpasssword }}</td><td>{{ $item->password }}</td><td>{{ $item->password_confirmation }}</td>
                                       <td class="td-actions">
                                 @include('crud.down',['route'=>'admin/resetpassword','id'=>$item->id])

                                                </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

@else
                            <p class="text-danger" style="padding: 20px;">There are no records</p>
                        @endif

                    </div>
                </div>
            </div>

@endsection
