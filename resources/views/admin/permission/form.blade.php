

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','name','form-control','','',$errors,'',$read,'Module Name']) !!}
        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','label','form-control','','',$errors,'',$read,'Label Name',(!empty($data->module)?$data->module->aliases:null)]) !!}
        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['group_name', 'false','' ,"form-control","",Permissions::get_all_group(),$errors,$read,'Group Name',(!empty($data->module)?$data->module->group_type_id:null)])!!}
        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','path_name','form-control','','',$errors,'',$read,'Path Name',(!empty($data->module)?$data->module->path_name:null)]) !!}

        {!! Permissions::get_all_in_event_permissions((!empty($data->module)? Permissions::get_all_actions($data->parent_id):(!empty(old('events')[0])?old('events'):array()))) !!}
        @include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
