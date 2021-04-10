@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <?php
        $gensel =  ['0'=>'All'];
        $read = false;
        $qoption = DBSELOPTION::get_all_options();
        $right =  Permissions::confirm_user_permission('/admin/generalsmartmessages');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">
                <h5 style="color:red;">General Smart Messages</h5>
                <hr/>
                {{Form::open(array('method'=>'post'))}}
                {{csrf_field()}}
                <div class="row">
                    <p style="display: none;" id="get_search_endpoint">getsmscontactfilterlist</p>


                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['locality', 'false','7' ,"form-control","",DBSELOPTION::get_all_localities(),$errors,$read,' Member Locality?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['hometown', 'false','8' ,"form-control","",DBSELOPTION::get_all_hometowns(),$errors,$read,' Member Hometown?',null])!!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['profession', 'false','9' ,"form-control","",DBSELOPTION::get_all_profession(),$errors,$read,' Member Profession?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['welfare_state', 'false','2' ,"form-control","",$qoption,$errors,$read,' Member Belongs to welfare ?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['gender', 'false','4' ,"form-control","",DBSELOPTION::get_all_genders(),$errors,$read,' Member Gender?',null])!!}
                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['marital_status', 'false','5' ,"form-control","",DBSELOPTION::get_all_marital_status(),$errors,$read,' Member Marital status?',null])!!}

                    {!! HtmlEntities::get_dynamic_form_complete_collective_c3_input(['text','by_age','form-control','6','',$errors,'',$read,'Age']) !!}

                    {!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['church_group', 'false','3' ,"form-control","",DBSELOPTION::get_all_church_groups() ,$errors,$read,' Member church groups?',null])!!}

                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <div class="col-md-12">
                            <section style="margin-bottom:30px; ">
                            {!!	Form::select('MessageID',DBSELOPTION::get_all_textMessages(),null,array('class'=>'form-control', 'id'=>'messagepop','placeholder'=>'Select Message'  )) !!}
                            </section>
                        <p style="float:left; width:auto;">No of characters : <span id="display_count" style=" color:red;">0</span></p>
                        <p style="float:right; width:auto;">SMS Used : <span id="usedsms" style=" color:red;">0</span></p>
                    </div>
                    {!! Form::hidden('sms_qty',null, array('id'=>'smscount','class' => 'form-control') ) !!}
                    {!! Form::hidden('total_characters',null, array('id'=>'characters','class' => 'form-control') ) !!}

                        <textarea class="form-control form-control-user" id="charactno" placeholder="" style="border-radius:0px;" name="content" cols="50" rows="5"></textarea>

                    </div>
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <a class="btn btn-warning" href="javascript:void(0);" role="button" id="showtagbox" style="margin-bottom:20px;">CREATE NEW SENDERTAG</a>

                        <div class="col-md-12 new-tag" style="display:none; margin-bottom: 20px;">
                            {!!	Form::text('SenderTag',null,array('class'=>'form-control','id'=>'newtag','placeholder'=>'ENTER SENDERTAG NAME'  )) !!}
                        </div>
                        <div class="col-md-12" style="margin-top: 20px;">
                            {!!	Form::select('SenderTagID',DBSELOPTION::get_all_tags(),null,array('class'=>'form-control','id'=>'sendtagname','placeholder'=>'Select a SenderTag Name'  )) !!}
                        </div>
                        <div class="col-md-12" >
                        <a class="btn btn-primary" href="javascript:void(0);" role="button" id="show_sms_details" style="margin-top:70px;" data-toggle="modal" data-target="#WarningModalalert">View SMS Details
                        <i class="fa fa-envelope"></i></a>
                        </div>
                    </div>

                    <button type="button" class="btn-block btn btn-info" id="fetchTextMessageFilter">Search</button>


                {{Form::close()}}
<p style="display: none" id="textmessage_contact_filter">textmessagecontactfilter</p>
 <p style="display: none" id="get_process_endpoint">processsmscontactfilterlist</p>
                    <section id="display_sms_filter_list">



               @include('admin.generalsmartmessages.data');
                    </section>


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

                            <div class="row">
                                <div class="col-md-4">
                                <p style="margin-bottom: 20px;">Total Contact: <span class="badge badge-success" id="sms_detail_contact">0</span></p>
                                <p>Total SMS Cost: <span class="badge badge-info" id="sms_detail_cost">0</span></p>
                                </div>
                                <div class="col-md-4">
                                <p style="margin-bottom: 20px;">Total Message Characters: <span class="badge badge-success" id="sms_detail_char">0</span></p>
                                <p>Unit Message Cost: <span class="badge badge-info" id="sms_detail_unit_cost">0</span></p>
                                </div>
                                <div class="col-md-4">
                                <p style="margin-bottom: 20px;">Unit SMS Cost: <span class="badge badge-success" id="sms_detail_unit_cost">1</span></p>
                                    <p>SMS Balance: <span class="badge badge-success" id="sms_detail_balance">0</span></p>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 40px;">

                                <div class="col-md-4">
                                    <p >Subject: <span id="sms_detail_subject"></span></p>
                                </div>
                                <div class="col-md-8">
                                    <p><b>Message:</b> <span id="sms_detail_content"></span></p>
                                </div>

                                <div class="row" style="margin-top: 40px;">
                                    <H3><b>Message Status</b></H3>
                                    <hr/>
                                    <h5 ></h5>
                                </div>

                                    <div class="col-md-4">
                                        <p >Success: <b><span id="res_success" class=""></span></b></p>
                                    </div>
                                    <div class="col-md-8">
                                        <p><b>Message:</b> <b><span id="res_message"class="" ></span></b></p>
                                    </div>
                                <section id="depends_response_success" style="display: none;">
                                    <div class="col-md-4">
                                        <p >Total Sent: <span id="res_sent" class="badge badge-success">0</span></p>
                                    </div>
                                    <div class="col-md-8">
                                        <p><b>Total Rejected:</b> <span id="res_rejected" class="badge badge-success">0</span></p>
                                    </div>


                                </section>
                            </div>


                        </div>
                        <div class="modal-footer warning-md">
                            <a  href="javascript:void(0);"  class="btn btn-success" id="process_sms">Send Message <i class="fa fa-send"></i></a>
                            <button data-dismiss="modal" class="btn btn-danger btn-lg"  href="#" >Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection
