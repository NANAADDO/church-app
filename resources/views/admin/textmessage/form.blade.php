{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','title','form-control','','',$errors,'',$read,'Message Title'])!!}
<div class="col-md-6 col-md-offset-4">
<p style="float:left; width:auto;">No of characters : <span id="display_count" style=" color:red;">{{(isset($data->total_characters)?$data->total_characters:  0)}}</span></p>
<p style="float:right; width:auto;">SMS Used : <span id="usedsms" style=" color:red;">{{(isset($data->sms_qty)?$data->sms_qty:  0)}}</span></p>
</div>
{!! Form::hidden('sms_qty',null, array('id'=>'smscount','class' => 'form-control') ) !!}
{!! Form::hidden('total_characters',null, array('id'=>'characters','class' => 'form-control') ) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_textarea(['text','content','form-control','charactno','',$errors,'',$read,'Content']) !!}




@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
