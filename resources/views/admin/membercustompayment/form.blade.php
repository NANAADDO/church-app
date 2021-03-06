{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','amount','form-control','','',$errors,'',$read,'Amount']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','year','form-control','dated7','',$errors,'',$read,'Payment.php']) !!}

{!! HtmlEntities::get_dynamic_form_complete_collective_input(['number','amount_paid','form-control','','',$errors,'',true,'Amount Paid']) !!}

{!! HtmlEntities::get_dynamic_form_complete_select_collective(['collection_id', 'false','' ,"form-control","",DBSELOPTION::get_all_collections(),$errors,$read,'collection Type',null])!!}

<div class="form-group-inner">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label name="collection Type" class="login2"> Member ID</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="form-group  {{ $errors->has('member_id') ? ' has-error' : '' }}">
                    <select class="form-control form-control-user chosen-select"  tabindex="-1"  style="font-size: 1.0rem;height:50px; border-radius:2px; display: none;" size="" id=""
                            name="member_id">
                        <option selected="selected" value="">

                            select option.. </option>

                        @foreach(DBSELOPTION::get_all_memberID() as $dat )
                            <option value="{{$dat->id}}" {{(empty($data) && @$data->member_id==$dat->id || old('member_id')==$dat->id ? 'selected' : '')}}>{{$dat->surname.' '. $dat->other_names.'['.$dat->new_member_id.']'}}</option>



@endforeach
                    </select>
                    @if ($errors->has('member_id'))
                        <span class="text-danger">
                                        <strong>{{ $errors->first('member_id') }}</strong>
                                    </span>
                    @endif

            </div>
        </div>
    </div>
</div>
</div>




@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])
