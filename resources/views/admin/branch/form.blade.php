

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','name','form-control','','',$errors,'',$read,'Branch Name']) !!}


{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','location','form-control','','',$errors,'',$read,'Branch Location']) !!}
{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','address','form-control','','',$errors,'',$read,'Branch Address']) !!}
{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','phone_numbers','form-control','','',$errors,'',$read,'Phone Numbers']) !!}
{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','branch_code','form-control','','',$errors,'',$read,'Branch code']) !!}
{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','branch_size','form-control','','',$errors,'',$read,'Branch size']) !!}
{!! HtmlEntities::get_dynamic_form_complete_select_collective(['region_id', 'false','' ,"form-control","",DBSELOPTION::get_all_regions(),$errors,$read,'Branch Region',(!empty($data)?$data->Region->id:null)])!!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['country_id', 'false','' ,"form-control","",DBSELOPTION::get_all_countries(),$errors,$read,'Branch Country',(!empty($data)?$data->Country->id:null)])!!}
@include('crud.button',['formMode'=>$formMode,'url'=>'/admin/branch','urledit'=>!empty($data)?'/admin/branch/'.$data->id.'/edit':'#'])
