{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','amount','form-control','','',$errors,'',$read,'amount']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_amount','form-control','','',$errors,'',$read,'expected_amount']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','expected_people','form-control','','',$errors,'',$read,'expected_people']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','user_id','form-control','','',$errors,'',$read,'user_id']) !!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['member_id', 'false','' ,"form-control","",[],$errors,$read,'member_id',(!empty($data)?$data->d->d:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','date','form-control','','',$errors,'',$read,'date']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','funeral_date','form-control','','',$errors,'',$read,'funeral_date']) !!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['txt_state_id', 'false','' ,"form-control","",[],$errors,$read,'txt_state_id',(!empty($data)?$data->d->d:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','description','form-control','','',$errors,'',$read,'description']) !!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
