
<div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
    <div class="portlet-title">
        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','name','form-control','','',$errors,'',$read,'Group Name']) !!}

        {!! HtmlEntities::get_dynamic_form_complete_input(['text','description','form-control','','',$errors,'',$read,'Description']) !!}


        {!! HtmlEntities::get_general_form_processor($formMode,url('/admin/churchgroup')) !!}

    </div>
</div>
