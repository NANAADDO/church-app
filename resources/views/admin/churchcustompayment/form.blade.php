{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','amount','form-control','','',$errors,'',$read,'Amount']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','year','form-control','dated7','',$errors,'',$read,'Year']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','start_date','form-control','dated3','',$errors,'',$read,'Start Date']) !!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['collection_id', 'false','' ,"form-control","",DBSELOPTION::get_all_collections(),$errors,$read,'Collection ID',null])!!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','end_date','form-control','dated','',$errors,'',$read,'End Date']) !!}



@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
