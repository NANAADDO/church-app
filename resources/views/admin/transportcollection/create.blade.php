@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    @csrf()
    <div class="row">

        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
            <div class="hpanel shadow-lg" >
                <div class="panel-heading hbuilt mailbox-hd">
                    <div class="text-center p-xs font-normal">
                        <h4 class="text-info " style="text-align: left;">Transportation Payment Collection</h4>
                        <hr/>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm search_to_pay" placeholder="search by member ID/ name..." id="admin/transportcollection"> <span class="input-group-btn active-hook"> <button type="button" class="btn btn-sm btn-default">Search
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

                    <div class="text-center" >
                        <p><small><b > <span id="show_header_title"></span> <span style="color: red;" id="show_pledge_year"></span></b></small></p>
                        <div id="show_payee_info_hear">

                        </div>
                    </div>
                    <div class="stats-icon text-center" id="stat_icon">
                        <img src="{{asset('general/img/icons/employ.jpg')}}" id="show_rimg"  style="max-height:70px; max-width: 70px; border-radius: 50%;border: solid 1px #C7C7C7;">
                    </div>
                    <hr/>
                    <div class="result_show">


                    </div>


                    {!! Form::open(['url' => '', 'class' => 'form-horizontal user', 'files' => true]) !!}

                        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','amount','form-control','p_amount','',$errors,'','true','Amount Ghc:']) !!}

                        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_amount','form-control','p_paid','',$errors,'','true','Paid Ghc:']) !!}

                        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_amount','form-control','p_bal','',$errors,'','true','Balance Ghc:']) !!}

                        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_people','form-control','p_amount_paying','',$errors,'','false','Amount Paying Ghc:']) !!}
                        {!! Form::close() !!}

                        </div>

                    @include('includes.relatedtags',['val'=>['admin/transportcollection',3,'',4]])

                    <div class="text-center" style="padding: 0px 0px 20px 0px;">

                        <button type="button" class="btn btn-md btn-info form-control-user" style="clear: both;" id="pay_for_transport">
                            <i class="fa fa-send"></i>
                            Submit</button>
                    </div>

                </div>
            <div class="modal-footer warning-md">
                <a data-dismiss="modal" href="#" >Cancel</a>
            </div>

            </div>

        </div>
    </div>
</div>
@include('includes.paymentmodal',['title'=>'Transportation'])


@endsection
