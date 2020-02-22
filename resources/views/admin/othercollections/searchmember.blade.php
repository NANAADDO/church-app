
@if (!empty($data) && $data->count())
    @foreach($data  as $row)

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 " style="margin-bottom: 30px;">
            <div class="hpanel widget-int-shape responsive-mg-b-30 shadow" style="padding-top: 10px; padding-bottom: 20px;border: solid 1px #C7C7C7; border-radius: 5px;">
                <div class="panel-body">
                    <div class="panel-title text-center" >
                        <p><small><b > YEAR  <span style="color: red;">{{$row->ryear}}</span></b></small></p>
                        <div class="stats-icon" id="get_year_and_payee_info_{{$row->pmember_id}}">
                            <p><small><b>{{$row->rname}} [{{$row->pmember_ch_id}}]</b></small></p>
                        </div>
                    </div>
                    <hr/>

                    <div class="stats-title pull-left">
                        <h4>Amount</h4>
                        <h5 class="text-success" style="font-size: 1.5em;"><span id="payment_amount">{{($row->amount=='0.00'? 'N/A':'GHC'.$row->amount)}}</span></h5>
                    </div>
                    <div class="stats-icon pull-right" id="stat_profile_img_{{$row->pmember_id}}">
                        <img src="{{asset('uploads/profiles/'.$row->pimgpath)}}"  id="" style="max-height:70px; max-width: 70px; border-radius: 50%;border: solid 1px #C7C7C7;">
                    </div>

                    <div class="m-t-xl widget-cl-1" style="padding-top: 40px;">

                        <small>
                            Total paid <span class="text-danger"><b>
                                    GHC <span id="amount_paid"> {{(isset($row->tpaid) ? $row->tpaid :'0.00')}}</span>

                                                </b></span>
                        </small>


                    </div>

                </div>
                <div class="" style="padding-top: 20px; text-align: center;">
                    <small style="font-size: x-small;color: grey;">
                        Last paid date :<span class="">
                                            @if(isset($row->date_paid))
                                <?php
                                $mydate = strtotime($row->date_paid);
                                $fdate = date('F jS Y',$mydate);
                                ?>
                                {{$fdate}}

                            @else
                                {{'N/A'}}

                            @endif


                                        </span>
                    </small>
                    <hr/>
                    <button type="button" class="btn btn-xs btn-success  shadow-sm make_payment_other {{$row->pmember_id.'_'.$row->ryear}}" id="{{$row->pmember_id.'_'.$row->amount.'_'.$row->ryear.'_'.($type==5?$row->totalm:$row->tpaid)}}_{{$row->date_joined}}_{{(isset($row->point_sub_id)?$row->point_sub_id:0)}}_{{$type}}" style="border-radius:10px;" data-toggle="modal" data-target="#WarningModalalert">Make Payment</button>
                    <button type="button" class="btn btn-xs btn-info  shadow-sm show_member_payment_history" style="border-radius: 10px;" id="{{$row->pmember_id.'_'.$row->ryear}}" data-toggle="modal" data-target="#PrimaryModalhdbgcl" >View History</button>
                    <div class="years_{{$row->pmember_id}}" style="display: none">
                        <option value="{{$row->pmember_id.'_'.$row->ryear}}">{{$row->ryear}}</option>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    <div class="col-md-12">
        <div class="pagination-wrapper pagination_display"> {!! $data->appends(['search' => Request::get('search'),'type' => Request::get('type')])->render() !!} </div>
    </div>
@else
    <p class="text-danger" style="padding: 20px;color:red;">There are no records</p>
@endif
