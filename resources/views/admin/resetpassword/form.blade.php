{!! HtmlEntities::get_dynamic_form_complete_collective_input(['password','oldpassword','form-control','','',$errors,'',$read,'Old Password']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['password','password','form-control','','',$errors,'',$read,'Password']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['password','password_confirmation','form-control','','',$errors,'',$read,'Password confirmation']) !!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
