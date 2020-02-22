

        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','name','form-control','','',$errors,'',$read,'Collection Name']) !!}

        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','description','form-control','','',$errors,'',$read,'Description']) !!}

        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['groups_id', 'false','Collection Group' ,"form-control","",DBSELOPTION::get_all_payment_groups() ,$errors,$read,'Collection Group',null])!!}
        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['payment_types_id', 'false','Collection Group' ,"form-control","",DBSELOPTION::get_all_payment_type() ,$errors,$read,'Payment.php',null])!!}



        @include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
