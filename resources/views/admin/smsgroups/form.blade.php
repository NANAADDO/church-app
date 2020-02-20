{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','name','form-control','','',$errors,'',$read,'Name']) !!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
