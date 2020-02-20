@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/textmessage');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">

                           @include('crud.top',['routename'=>'admin/textmessage','modulename'=>'Text Message'])
  @if ($data->count())
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>title</th> <th>Message</th><th>SMS Qty</th><th>Total Characters</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>

                                        <td>{{ $item->title }}</td><td>{{ $item->content }}</td><td>{{ $item->sms_qty }}</td><td>{{ $item->total_characters }}</td>
                                       <td class="td-actions">
                                 @include('crud.down',['route'=>'admin/textmessage','id'=>$item->id])

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
