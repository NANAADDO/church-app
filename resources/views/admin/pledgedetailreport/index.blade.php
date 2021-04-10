@extends('layouts.report')

@section('content')
    <div class="container-fluid">
<?php
        $gensel =  ['0'=>'All'];
        $read = false;
        $qoption = DBSELOPTION::get_all_options();
        $right =  Permissions::confirm_user_permission('/admin/pledgedetailreport');
        ?>
    <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
        <div class="portlet-title">
            <h5 style="color:red;">Member Pledge Report Based On Details</h5>
            <hr/>
            {{Form::open(array('method'=>'post'))}}
            {{csrf_field()}}
            <div class="row">

                <p style="display: none;" id="get_searcch_endpoint">/admin/pledgedetailreport</p>
                <p style="display: none;" id="get_col_type">5</p>


@include('admin.reportIncludes.filterselection');


            {{Form::close()}}

            <div class="table-responsive" id="tableDiv">

                <table id="example" class="display " style="width:100%;text-align: center;" >

                    <thead>
                    <tr id="td_title">
                        <th>Name</th>
                        <th>Member ID</th>
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

    @foreach(DBSELOPTION::get_all_collection_based_groups_raw(2) as $db)
        <p style="display: none;" id="show_{{$db->id}}" class="get_all_welfar"><option value="{{$db->id}}">{{$db->name}}</option></p>

    @endforeach

@endsection
