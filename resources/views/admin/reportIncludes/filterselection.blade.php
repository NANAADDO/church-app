<div class="col-md-3">
                    <label name="collection Type" class="login2"> Member Name</label>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select class="form-control form-control-user chosen-select name_selected"  tabindex="-1"  style="font-size: 1.0rem;height:50px; border-radius:2px; display: none;" size="" id=""
                                    name="member_id">
                                <option selected="selected" value="">

    select option.. </option>

@foreach(DBSELOPTION::get_all_memberID() as $dat )
    <option value="{{$dat->id}}_{{$dat->date_joined}}_{{$dat->does_member_want_to_join_welfare}}_{{$dat->date_joined_welfare}}" >{{$dat->surname.' '. $dat->other_names.'['.$dat->new_member_id.']'}}</option>



    @endforeach
    </select>
    </div>
    </div>
    </div>


{!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['year_paid', 'false','3' ,"form-control","",DBSELOPTION::get_all_years(),$errors,$read,'  Start Year ?',null])!!}
{!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['end_year', 'false','3' ,"form-control","",DBSELOPTION::get_all_years(),$errors,$read,'   End Year?',null])!!}

{!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['start_month', 'false','2' ,"form-control","",DBSELOPTION::get_all_month(),$errors,$read,'  Start Month ?',null])!!}
{!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['end_month', 'false','2' ,"form-control","",DBSELOPTION::get_all_month(),$errors,$read,'  End Month ?',null])!!}

{!! HtmlEntities::get_dynamic_form_complete_select_c3_collective(['fetch_type', 'false','19' ,"form-control","",['1'=>'None paid month','2'=>'paid month','3'=>'group by year','4'=>'group by year range'],$errors,$read,' Filter By?',null])!!}


    <div>
        <button type="button" class="btn-block btn btn-info" id="search_form">Search</button>
    </div>
    </div>
