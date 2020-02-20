@extends('layouts.report')

@section('content')
    <div class="container-fluid">
        <?php
        $gensel =  ['0'=>'All'];
        $read = false;
        $qoption = DBSELOPTION::get_all_options();
        $right =  Permissions::confirm_user_permission('/admin/transportdetailreport');
        ?>
            <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
                <div class="portlet-title">
                    <h5 style="color:red;">Church Funeral Transport Report Based On Details</h5>
                    <hr/>
                    {{Form::open(array('method'=>'post'))}}
                    {{csrf_field()}}
                    <div class="row">

                        <p style="display: none;" id="get_searcch_endpoint">/admin/transportdetailreport</p>
                        <p style="display: none;" id="get_col_type">1</p>


                        <div class="col-md-3">
                            <label name="collection Type" class="login2"> Member Name</label>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <select class="form-control form-control-user chosen-select"  tabindex="-1"  style="font-size: 1.0rem;height:50px; border-radius:2px; display: none;" size="" id=""
                                        name="member_id">
                                    <option selected="selected" value="">

                                        select option.. </option>

                                    @foreach(DBSELOPTION::get_all_memberID() as $dat )
                                        <option value="{{$dat->id}}" >{{$dat->surname.' '. $dat->other_names.'['.$dat->new_member_id.']'}}</option>



                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                        {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['status', 'false','5' ,"form-control","",$qoption,$errors,$read,'  IS It Active?',null])!!}

                        {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['funeral_person', 'false','5th' ,"form-control","",DBSELOPTION::get_all_funerals(),$errors,$read,' Transport Funeral ?',null])!!}

                        {!! HtmlEntities::get_dynamic_form_complete_collective_c3_input(['text','start_date','form-control','start','',$errors,'',$read,'Start Date ']) !!}
                        {!! HtmlEntities::get_dynamic_form_complete_collective_c3_input(['text','end_date','form-control','finish','',$errors,'',$read,'End Date']) !!}
                        {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['fetch_type', 'false','19' ,"form-control","",['1'=>'fully paid','2'=>'committed','3'=>'zero payment'],$errors,$read,' Sort By?',null])!!}


                        <div>
                            <button type="button" class="btn-block btn btn-info" id="search_form">Search</button>
                        </div>
                    </div>


                    {{Form::close()}}

                    <div class="table-responsive">

                        <table id="example" class="display " style="width:100%;text-align: center;" >

                            <thead>
                            <tr id="td_title">
                                <th>Name</th>
                                <th>Member ID</th>
                                <th>Transport Description</th>
                                <th>Total</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                                <th>Date Paid</th>

                            </tr>
                            </thead>
                            <tbody id="td_body">

                            @foreach($data as $item)
                                <tr>
                                    <th>{{$item->rname}}</th>
                                    <th>{{$item->rmember_id}}</th>
                                    <th>{{$item->descrip}}</th>
                                    <th>{{$item->amount}}</th>
                                    <th>{{$item->tpaid}}</th>
                                    <th>{{$item->amount - $item->tpaid}}</th>
                                    <th>{{$item->date_paid}}</th>

                                </tr>
                            @endforeach

                            </tbody>


                        </table>
                    </div>


                </div>
            </div>
        </div>

@endsection
