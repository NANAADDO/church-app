{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','oldpasssword','form-control','','',$errors,'',$read,'oldpasssword']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','password','form-control','','',$errors,'',$read,'password']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','password_confirmation','form-control','','',$errors,'',$read,'password_confirmation']) !!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
