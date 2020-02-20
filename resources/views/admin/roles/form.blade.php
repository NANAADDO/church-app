

        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','name','form-control','','',$errors,'',$read,'Role Name']) !!}

        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','label','form-control','','',$errors,'',$read,'Role Label']) !!}

        <div class="col-md-8 col-md-offset-2">
            {!!  \App\Helpers\HTMLFORM::select_form_for_permission(['general_permission', 'true','lstBox1' ,"form-control permissions_all lstBoxm","15",(!empty($data)?Permissions::get_all_not_permissions($data->id):Permissions::get_all_permissions()),$errors,$read])!!}
            {!! \App\Helpers\HTMLFORM::get_dynamic_form_permission('1','2')!!}
            {!! \App\Helpers\HTMLFORM::select_form_for_permission(['permissions[]', 'true','lstBox2' ,"form-control  lstBoxm","15",(!empty($data)?Permissions::get_all_in_permissions($data->id):[]),$errors,$read])!!}
        </div>
        @include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])

