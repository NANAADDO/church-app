<div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">

    <div class="portlet-title">



        <div class="form-check text-center">
            <label class="form-check-label">
                <input class="form-check-input notification" type="checkbox" value="1" name='state_id' {{(empty($data->state_id)?(old('state_id')==1? 'checked' : ''):($data->state_id==1?'checked' : ''))}}>
                <span style="color:red;">Click to Enable Automatic Birthday Notification</span>
            </label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p style="color:red; font-weight:bold;">NB*</p>
            <p style=" margin-bottom:50px;"> Enabling Automatic Birthday Notification  will notify all your contacts who are celebrating their birthdays, by sending them a customized
                message selected from your account.
        </div>
    </div>


    <div class="notification_setting" style="display: none;">
        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['tag_id', 'false','' ,"form-control","",DBSELOPTION::get_all_sms_tag(),$errors,false,'Tag ID',null])!!}


        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['message_id', 'false','messagepoped' ,"form-control","",DBSELOPTION::get_all_message_text(),$errors,false,'Message ID',null])!!}


        <p  style="clear: both;"><span><b style="color:red;">Message Selected Preview : </b></span><span class="display-selected_text"></span></p>


    </div>
    @include('crud.button',['formMode'=>'Submit','url'=>'/home','urledit'=>'#'])

</div>

@foreach(DBSELOPTION::get_all_message_content() as $row)
    <p style="display:none;" id="message-{{$row->id}}">{{$row->content}}</p>

@endforeach
