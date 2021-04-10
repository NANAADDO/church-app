@extends('layouts.report')

@section('content')
    <div class="container-fluid">
<?php
        $gensel =  ['0'=>'All'];
        $read = false;
        $qoption = DBSELOPTION::get_all_options();
        $right =  Permissions::confirm_user_permission('/admin/dailycollectionreport');
        ?>
    <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
        <div class="portlet-title">
            <h5 style="color:red;">Member Daily Collection Report</h5>
            <hr/>
            {{Form::open(array('method'=>'post'))}}
            {{csrf_field()}}
            <div class="row">

                <p style="display: none;" id="get_searcch_endpoint">/admin/dailycollectionreport</p>
                <p style="display: none;" id="get_col_type">7</p>

                {!! HtmlEntities::get_dynamic_form_complete_collective_c3_input(['text','payment_date','form-control','start','',$errors,'',$read,'Select Payment Date ?']) !!}
                {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['col_type', 'false','19' ,"form-control","",DBSELOPTION::get_all_collections(),$errors,$read,' Collection Type?',null])!!}

                <div>
                    <button type="button" class="btn-block btn btn-info" id="search_form">Search</button>
                </div>
            </div>

            </div>
            {{Form::close()}}

            <div class="table-responsive">

                <table id="example" class="display " style="width:100%;text-align: center;" >

                    <thead>
                    <tr id="td_title">
                        <th>Name</th>
                        <th>Member ID</th>
                        <th>OLD Member ID</th>
                        <th>Amount</th>
                        <th>Collection Type</th>
                        <th>Date Paid</th>


                    </tr>
                    </thead>
                    <tbody id="td_body">

                    @foreach($data as $item)
                        <tr>
                            <th>{{$item->name}}</th>
                            <th>{{$item->new_member_id}}</th>
                            <th>{{$item->old_member_id}}</th>
                            <th>{{$item->amount}}</th>
                            <th>{{$item->coltype}}</th>
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
