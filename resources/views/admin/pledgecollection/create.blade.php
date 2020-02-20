@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        @csrf()
        <div class="row">

            <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                <div class="hpanel shadow-lg" >
                    <div class="panel-heading hbuilt mailbox-hd">
                        <div class="text-center p-xs font-normal">
                            <h4 class="text-info " style="text-align: left;">Pledge Payment Collection</h4>
                            <hr/>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm search_to_pay" placeholder="search by member ID/ name..." id="admin/pledgecollection"> <span class="input-group-btn active-hook"> <button type="button" class="btn btn-sm btn-default">Search
											</button> </span></div>
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
                                <p><small><b >PLEDGE YEAR  <span style="color: red;" id="show_pledge_year"></span></b></small></p>
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
                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['years_all_selected', 'false','get_year_sel' ,"form-control show_all_years","",[],$errors,'false','Pledge Year',null])!!}

                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','amount','form-control','p_amount','',$errors,'','true','Pledge Annual Amount Ghc:']) !!}

                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_amount','form-control','p_paid','',$errors,'','true','Pledge Monthly Ghc:']) !!}

                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_people','form-control','p_amount_paying','',$errors,'','true','Total Amount Paying Ghc:']) !!}



                            <div class="col-md-offset-2 col-md-8" style="display: none; margin-bottom: 20px;" id="show_annual_box_option">
                               <button type="button" class="btn btn-block btn-info">Define Annual Pledge Amount</button>
                           </div>
<section style="display: none"  id="show_annual_box">
                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','indicate_annual_amount','form-control','show_annual_box','pannualamount',$errors,'','false','specify Annual Pledge Amount:']) !!}
</section>

                            <div class="form-group-inner"> <div class="col-md-8 col-md-offset-2"> <div class="row"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <label name="Permissions" class="login2"> Non Paid Months</label>
                                        </div> <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 show_non_paid_month">

                                        </div> </div> </div> </div>
                            {!! Form::close() !!}

                        </div>

                        @include('includes.relatedtags',['val'=>['admin/pledgecollection',2,'get_pledge_payment_details',1]])
                        <p style="display: none;" id="payment_details"></p>

                        <div class="text-center" style="padding: 0px 0px 20px 0px;">

                            <button type="button" class="btn btn-md btn-info form-control-user" style="clear: both;" id="pay_for_general">
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
    @include('includes.paymentmodal',['title'=>'Pledge'])
@endsection
