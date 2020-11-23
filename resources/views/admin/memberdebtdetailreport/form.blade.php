{!! HtmlEntities::get_dynamic_form_complete_select_collective(['roles', 'false','' ,"form-control","",[],$errors,$read,'roles',(!empty($data)?$data->d->d:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['permissions', 'false','' ,"form-control","",[],$errors,$read,'permissions',(!empty($data)?$data->d->d:null)])!!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
