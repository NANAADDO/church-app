@extends('layouts.report')

@section('content')
    <div class="container-fluid">
<?php
        $gensel =  ['0'=>'All'];
        $read = false;
        $qoption = DBSELOPTION::get_all_options();
        $right =  Permissions::confirm_user_permission('/admin/memberdetailreport');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">
                <h5 style="color:red;">Church Member Report Based On Details</h5>
                <hr/>
                {{Form::open(array('method'=>'post'))}}
                {{csrf_field()}}
                <div class="row">
           <p style="display: none;" id="get_searcch_endpoint">/admin/memberdetailreport</p>
                    <p style="display: none;" id="get_col_type">0</p>


                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['locality[]', 'true','7' ,"form-control","",DBSELOPTION::get_all_localities(),$errors,$read,' Member Locality?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['hometown[]', 'true','8' ,"form-control","",DBSELOPTION::get_all_hometowns(),$errors,$read,' Member Hometown?',null])!!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['profession[]', 'true','9' ,"form-control","",DBSELOPTION::get_all_profession(),$errors,$read,' Member Profession?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['religious[]', 'true','1' ,"form-control","",['All','Baptized','Confirm','Communicant','Convert'] ,$errors,false,'Member Spirituality',null])!!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['welfare_state', 'false','2' ,"form-control","",$qoption,$errors,$read,' Member Belongs to welfare ?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['gender', 'false','4' ,"form-control","",DBSELOPTION::get_all_genders(),$errors,$read,' Member Gender?',null])!!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['marital_status', 'false','5' ,"form-control","",DBSELOPTION::get_all_marital_status(),$errors,$read,' Member Marital status?',null])!!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['member_status', 'false','5' ,"form-control","",DBSELOPTION::get_all_status(),$errors,$read,' Member Status?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_collective_c3_input(['text','start_date','form-control','start','',$errors,'',$read,'Start Date Joined']) !!}
                    {!! HtmlEntities::get_dynamic_form_complete_collective_c3_input(['text','end_date','form-control','finish','',$errors,'',$read,'End Date Joined']) !!}

                    {!! HtmlEntities::get_dynamic_form_complete_collective_c3_input(['text','by_age','form-control','6','',$errors,'',$read,'Age']) !!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['have_kids', 'false','10' ,"form-control","",$qoption,$errors,$read,' Member Have kids?',null])!!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['church_groups[]', 'true','3' ,"form-control","",DBSELOPTION::get_all_church_groups() ,$errors,$read,' Member church groups?',null])!!}

                    <div>
        <button type="button" class="btn-block btn btn-info" id="search_form">Search</button>
    </div>
                </div>


                {{Form::close()}}

                <div class="table-responsive">

                    <table id="example" class="display " style="width:100%;text-align: center;" >

                        <thead>
                        <tr id="td_title">
                            <th>#</th>
                            <th>Name</th>
                            <th>Member ID</th>
                            <th>OLD Member ID</th>
                            <th>Phone #</th>
                            <th>Address</th>
                            <th>Country</th>
                            <th>Home Town</th>
                            <th>Gender</th>
                            <th>Profession</th>
                            <th>Locality</th>
                            <th>Marital Status</th>
                            <th>Date Joined</th>
                        </tr>
                        </thead>
                        <tbody id="td_body">

                        @foreach($data as $key=>$item)
                        <tr>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->surname.' '.$item->other_names}}</td>
                            <td>{{ $item->new_member_id }}</td>
                            <td>{{ $item->old_member_id }}</td>
                            <td>{{ $item->phone_numbers }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->country->name}}</td>
                            <td>{{ $item->hometown->name }}</td>
                            <td>{{ $item->gender->name }}</td>
                            <td>{{ (isset($item->Employment->profession)?$item->Employment->profession->name:'N/A') }}</td>
                            <td>{{ $item->locality->name }}</td>
                            <td>{{ $item->marital->name }}</td>
                            <td>{{ $item->date_joined }}</td>

                        </tr>
                            @endforeach

                        </tbody>


                    </table>
                </div>


                    </div>
                </div>
            </div>

@endsection
