{!! HtmlEntities::get_dynamic_form_complete_select_collective(['message_id', 'false','' ,"form-control","",[],$errors,$read,'message_id',(!empty($data)?$data->d->d:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['tag_id', 'false','' ,"form-control","",[],$errors,$read,'tag_id',(!empty($data)?$data->d->d:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['state_id', 'false','' ,"form-control","",[],$errors,$read,'state_id',(!empty($data)?$data->d->d:null)])!!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
