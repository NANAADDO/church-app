@extends('layouts.report')

@section('content')
    <div class="container-fluid">
<?php
        $gensel =  ['0'=>'All'];
        $read = false;
        $qoption = DBSELOPTION::get_all_options();
        $right =  Permissions::confirm_user_permission('/admin/welfaredetailreport');
        ?>
    <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
        <div class="portlet-title">
            <h5 style="color:red;">Member Welfare Report Based On Details</h5>
            <hr/>
            {{Form::open(array('method'=>'post'))}}
            {{csrf_field()}}
            <div class="row">

                <p style="display: none;" id="get_searcch_endpoint">/admin/welfaredetailreport</p>
                <p style="display: none;" id="get_col_type">3</p>


                <div class="col-md-3">
                    <label name="collection Type" class="login2"> Member Name</label>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select class="form-control form-control-user chosen-select name_selected"  tabindex="-1"  style="font-size: 1.0rem;height:50px; border-radius:2px; display: none;" size="" id=""
                                    name="member_id">
                                <option selected="selected" value="">

                                    select option.. </option>

                                @foreach(DBSELOPTION::get_all_memberID() as $dat )
                                    <option value="{{$dat->id}}_{{$dat->date_joined}}_{{$dat->does_member_want_to_join_welfare}}_{{$dat->date_joined_welfare}}" >{{$dat->surname.' '. $dat->other_names.'['.$dat->new_member_id.']'}}</option>



                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['type', 'false','type_collection' ,"form-control","",DBSELOPTION::get_all_collection_based_groups(2),$errors,$read,'  Welfare Type?',null])!!}
                {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['year_paid', 'false','3' ,"form-control","",DBSELOPTION::get_all_years(),$errors,$read,'  Start Year ?',null])!!}
                {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['end_year', 'false','3' ,"form-control","",DBSELOPTION::get_all_years(),$errors,$read,'   End Year?',null])!!}

                {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['start_month', 'false','2' ,"form-control","",DBSELOPTION::get_all_month(),$errors,$read,'  Start Month ?',null])!!}
                {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['end_month', 'false','2' ,"form-control","",DBSELOPTION::get_all_month(),$errors,$read,'  End Month ?',null])!!}

                {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['fetch_type', 'false','19' ,"form-control","",['1'=>'None paid month','2'=>'paid month','3'=>'group by year','4'=>'group by year range'],$errors,$read,' Filter By?',null])!!}



                <div>
                    <button type="button" class="btn-block btn btn-info" id="search_form">Search</button>
                </div>
            </div>


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
