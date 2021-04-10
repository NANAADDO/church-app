@extends('layouts.report')

@section('content')
    <div class="container-fluid">
<?php

        $gensel =  ['0'=>'All'];
        $read = false;
        $qoption = DBSELOPTION::get_all_options();
        $right =  Permissions::confirm_user_permission('/admin/tithedetailreport');
        ?>
    <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
        <div class="portlet-title">
            <h5 style="color:red;">Member Tithe Report Based On Details</h5>
            <hr/>
            {{Form::open(array('method'=>'post'))}}
            {{csrf_field()}}
            <div class="row">

                <p style="display: none;" id="get_searcch_endpoint">/admin/tithedetailreport</p>
                <p style="display: none;" id="get_col_type">2</p>


                @include('admin.reportIncludes.filterselection');

            </div>
            {{Form::close()}}

            <div class="table-responsive">

                <table id="example" class="display " style="width:100%;text-align: center;" >

                    <thead>
                    <tr id="td_title">
                        <th>Name</th>
                        <th>Member ID</th>
                        <th>OLD Member ID</th>
                        <th>Month</th>
                        <th>Amount Paid</th>

                        <th>Year</th>
                        <th>Date Paid</th>

                    </tr>
                    </thead>
                    <tbody id="td_body">

                    @foreach($data as $item)
                        <tr>
                            <th>{{$item->name}}</th>
                            <th>{{$item->new_member_id}}</th>
                            <th>{{$item->old_member_id}}</th>
                            <th>{{$item->mname}}</th>
                            <th>{{$item->amp}}</th>
                            <th>{{$item->ryear}}</th>
                            <th>{{$item->dpaid}}</th>

                        </tr>
                    @endforeach

                    </tbody>


                </table>
            </div>


        </div>
    </div>
    </div>


@endsection
