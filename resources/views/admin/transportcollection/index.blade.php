@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/transportcollection');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">

                           @include('crud.top',['routename'=>'admin/transportcollection','modulename'=>'Transport Collection'])
  @if ($data->count())
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Name</th><th>Receipt ID</th><th>Church ID</th><th>Amount Paid</th><th>Date Paid</th><th>Collection Type</th>
                                        <th>Year</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>

                                        <td>{{ $item->member->surname.' '.$item->member->other_names}}</td><td>{{ $item->receipt_id }}</td><td>{{ $item->member->new_member_id }}</td><td>{{ $item->amount_paid }}</td>
                                        <td>{{ $item->date_paid }}</td><td>{{ $item->collection->name }}</td><td>{{ $item->year }}</td>
                                       <td class="td-actions">
                                 @include('crud.print',['id'=>$item->id])

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
