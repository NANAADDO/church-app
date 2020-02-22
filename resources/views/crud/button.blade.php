@if($formMode=='create' || $formMode=='update' || $formMode=='Change Password' || $formMode=='Submit')
{!! HtmlEntities::get_general_form_processor($formMode,url($url)) !!}
@endif

@if($formMode=='edit')
    {!! HtmlEntities::get_general_form_process($formMode,url($urledit),url($url)) !!}
@endif
