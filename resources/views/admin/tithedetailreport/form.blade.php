{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','name','form-control','','',$errors,'',$read,'name']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','location','form-control','','',$errors,'',$read,'location']) !!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['region_id', 'false','' ,"form-control","",[],$errors,$read,'region_id',(!empty($data)?$data->d->d:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['country_id', 'false','' ,"form-control","",[],$errors,$read,'country_id',(!empty($data)?$data->d->d:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','address','form-control','','',$errors,'',$read,'address']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','phone_numbers','form-control','','',$errors,'',$read,'phone_numbers']) !!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
