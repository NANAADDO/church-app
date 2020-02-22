@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        @csrf()
        <div class="row">

            <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">

                <div class="hpanel shadow-lg" >

                    <div class="panel-heading hbuilt mailbox-hd">

                        <div class="text-center p-xs font-normal">
                            <hr/>

                            <h4 class="text-info " style="text-align: left;">Other  Payment Collection</h4>
                            <hr/>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class=" col-md-12">

                                        {!! Form::select('',DBSELOPTION::get_all_collection_based_groups(5),null,array('class'=>'form-control','id'=>'welare_type','placeholder'=>'select collection type')) !!}

                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm search_to_pay_multiple_select" placeholder="search by member ID/ name..." id="admin/othercollections"> <span class="input-group-btn active-hook"> <button type="button" class="btn btn-sm btn-default search_member_payment_manual">Search
											</button> </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <section class="ajax_show_detail">

                            </section>


                        </div>

                    </div>
                    <div class="panel-footer ib-ml-ft">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="WarningModalalert" class="modal modal-edu-general Customwidth-popup-WarningModal fade in" role="dialog" style="display:none;">
        <div class="modal-dialog" style="width:70%;">
            <div class="modal-content" >
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body" style="margin-top: -30px;">
                    <div class="row ">

                        <div class="col-md-10 col-md-offset-1 user " style="background: white; padding: 10px 0px; border-radius: 10px;">

                            <div class="text-center" >
                                <p><small><b > <span id="show_header_title"></span> <span style="color: red;" id="show_pledge_year"></span></b></small></p>
                                <div id="show_payee_info_hear">

                                </div>
                            </div>
                            <div class="stats-icon text-center" id="stat_icon">
                                <img src="{{asset('general/img/icons/employ.jpg')}}" id="show_rimg" style="max-height:70px; max-width: 70px; border-radius: 50%;border: solid 1px #C7C7C7;">
                            </div>
                            <hr/>
                            <div class="result_show">


                            </div>

                            {!! Form::open(['url' => '', 'class' => 'form-horizontal user', 'files' => true]) !!}
                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['years_all_selected', 'false','get_year_sel' ,"form-control show_all_years","",[],$errors,'false','Year',null])!!}

                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','amount','form-control p_amount','p_paid','',$errors,'','true','Amount Ghc:']) !!}

                            <div style="display: none;" id="show_p_amount">
                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','','form-control ','total_paid','',$errors,'','true','Total Paid Ghc:']) !!}

                            </div>
                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_people','form-control','p_amount_paying','',$errors,'','true','Total Amount Paying Ghc:']) !!}



                            <section style="display: none"  id="show_annual_box">
                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','indicate_annual_amount','form-control','show_annual_box','pannualamount',$errors,'','false','specify Annual Pledge Amount:']) !!}
                            </section>

                            <div class="form-group-inner" id="month_left_unpaid"> <div class="col-md-8 col-md-offset-2"> <div class="row"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <label name="Permissions" class="login2"> Non Paid Months</label>
                                        </div> <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 show_non_paid_month">

                                        </div> </div> </div> </div>
                            {!! Form::close() !!}

                        </div>

@include('includes.relatedtags',['val'=>['admin/othercollections',0,'',2]])

                        <div class="text-center" style="padding: 0px 0px 20px 0px;">

                            <button type="button" class="btn btn-md btn-info form-control-user" style="clear: both;" id="pay_for_welfare">
                                <i class="fa fa-send"></i>
                                Submit</button>
                        </div>

                    </div>


                </div>
                <div class="modal-footer warning-md">
                    <a data-dismiss="modal" href="#" >Cancel</a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.paymentmodal',['title'=>'Other Collection'])
@endsection
