 {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','first_name','form-control','','',$errors,'',$read,'First Name']) !!}
    {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','surname','form-control','','',$errors,'',$read,'Surname']) !!}
    {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','other_names','form-control','','',$errors,'',$read,'Other Name']) !!}
    {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','phone_number','form-control','','',$errors,'',$read,'Phone Number']) !!}

    {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','username','form-control','','',$errors,'',$read,'User Name']) !!}

 {!! HtmlEntities::get_dynamic_form_complete_select_collective(['branch_id', 'false','' ,"form-control","",DBSELOPTION::get_all_branches(),$errors,$read,'User Branch',null])!!}

 {!! HtmlEntities::get_dynamic_form_complete_select_collective(['roles', 'false','show_role_permissions' ,"form-control","",Roles::roles(),$errors,$read,'User Role',(!empty($data)?$data->Userroles->role_id:null)])!!}



 <div class="col-md-8 col-md-offset-2">
        {!!  \App\Helpers\HTMLFORM::select_form_for_permission(['general_permission', 'true','lstBox1' ,"form-control permissions_all lstBoxm","15",(isset($user_p)?$user_p:null),$errors,$read])!!}
        {!! \App\Helpers\HTMLFORM::get_dynamic_form_permission('1','2')!!}
        {!! \App\Helpers\HTMLFORM::select_form_for_permission(['revoke[]', 'true','lstBox2' ,"form-control  lstBoxm","15",(isset($user_r)?$user_r:null),$errors,$read])!!}
    </div>

    <div class="col-md-8 col-md-offset-2">
        {!! \App\Helpers\HTMLFORM::select_form_for_permission(['general_permission', 'true','lstBox3' ,"form-control extra_permission lstBoxm","15",(isset($user_e)?$user_e:null),$errors,$read])!!}

        {!!\App\Helpers\HTMLFORM::get_dynamic_form_permission('3','4')!!}

        {!! \App\Helpers\HTMLFORM::select_form_for_permission(['invoke[]', 'true','lstBox4' ,"form-control lstBoxm","15",(isset($user_i)?$user_i:null),$errors,$read])!!}
    </div>

 @include('crud.button',['formMode'=>$formMode,'url'=>'/admin/users','urledit'=>!empty($data)?'/admin/users/'.$data->id.'/edit':'#'])






