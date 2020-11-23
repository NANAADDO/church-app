<div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">

    <div class="portlet-title">



        <div class="form-check text-center">
            <label class="form-check-label">
                <input class="form-check-input notification" type="checkbox" value="1" name='notification_state' {{(empty($data->notification_state)?(old('notification_state')==1? 'checked' : ''):($data->notification_state==1?'checked' : ''))}}>
                <span style="color:red;">Click to enable automatic SMS critical balance  notification</span>
            </label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p style="color:red; font-weight:bold;">NB*</p>
            <p style=" margin-bottom:50px;"> Enabling automatic flag notification will notify you when your SMS balance get to the amount
                entered below, in which the notification will be based on schedule option choosed.
        </div>
    </div>


    <div class="notification_setting" style="display: none;">

        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','quantity','form-control','','',$errors,'',$read,'SMS Quantity']) !!}


        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['notification_id', 'false','' ,"form-control","",DBSELOPTION::get_all_period(),$errors,false,'Notification Period',null])!!}


    </div>
    @include('crud.button',['formMode'=>'Submit','url'=>'/home','urledit'=>'#'])

</div>


