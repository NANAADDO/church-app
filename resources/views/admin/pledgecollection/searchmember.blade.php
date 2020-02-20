
@if (!empty($data) && $data->count())
    @foreach($data  as $row)

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 " style="margin-bottom: 30px;">
            <div class="hpanel widget-int-shape responsive-mg-b-30 shadow" style="padding-top: 10px; padding-bottom: 20px;border: solid 1px #C7C7C7; border-radius: 5px;">
                <div class="panel-body">
                    <div class="panel-title text-center" >
                        <p><small><b >PLEDGE YEAR  <span style="color: red;">{{$row->ryear}}</span></b></small></p>
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
                    <div style="padding-top: 30px;">


                        <?php
                        $pe = $row->totalm/$row->mleft;
                        $per = $pe * 100;

                        ?>



                        <small>{{$row->totalm}} Out of <span id="divi_{{$row->pmember_id.'_'.$row->ryear}}">{{$row->mleft}}</span> months paid</small>
                        <div class="pull-right">{{round($per)}} %<i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning ctn-vs-3" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:{{$per}}%;"> <span class="sr-only">{{$per}}% Complete</span></div>
                        </div>

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
                    <button type="button" class="btn btn-xs btn-success  shadow-sm make_payment_general {{$row->pmember_id.'_'.$row->ryear}}" id="{{$row->pmember_id.'_'.$row->amount.'_'.$row->ryear.'_'.$row->totalm}}_{{$row->date_joined}}_{{$row->point_sub_id}}" style="border-radius:10px;" data-toggle="modal" data-target="#WarningModalalert">Make Payment</button>
                    <button type="button" class="btn btn-xs btn-info  shadow-sm show_member_payment_history" id="{{$row->pmember_id.'_'.$row->ryear}}" data-toggle="modal" data-target="#PrimaryModalhdbgcl" style="border-radius: 10px;">View History</button>
                    <div class="years_{{$row->pmember_id}}" style="display: none">
                        <option value="{{$row->pmember_id.'_'.$row->ryear}}">{{$row->ryear}}</option>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    <div class="col-md-12">
        <div class="pagination-wrapper pagination_display"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>
@else
    <p class="text-danger" style="padding: 20px;color:red;">There are no records</p>
@endif
