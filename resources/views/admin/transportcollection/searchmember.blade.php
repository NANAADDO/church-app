/
@if (!empty($data) && $data->count())
    @foreach($data  as $row)

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 " style="margin-bottom: 30px;">
            <div class="hpanel widget-int-shape responsive-mg-b-30 shadow" style="padding-top: 10px; padding-bottom: 20px;border: solid 1px #C7C7C7; border-radius: 5px;">
                <div class="panel-body">
                    <div class="panel-title text-center">
                        <small id="get_year_and_payee_info_{{$row->transid}}"><b>{{$row->rname}}'s collection</b></small>
                        <div class="stats-icon pull-right">
                            <img src="{{asset('uploads/profiles/'.$row->rimgpath)}}" id="rpic{{$row->pmember_id}}_{{$row->transid}}" style="max-height:30px; max-width: 30px; border-radius: 50%;border: solid 1px #C7C7C7; margin-top: -6px;">
                        </div>
                    </div>
                    <hr/>

                    <div class="stats-title pull-left">
                        <h4>Amount</h4>
                        <h5 class="text-success" style="font-size: 1.5em;">GHC<span id="payment_amount{{$row->pmember_id}}_{{$row->transid}}">{{$row->amount}}</span></h5>
                    </div>
                    <div class="stats-icon pull-right"  id="stat_profile_img_{{$row->pmember_id}}">
                        <img src="{{asset('uploads/profiles/'.$row->pimgpath)}}"  id="" style="max-height:70px; max-width: 70px; border-radius: 50%;border: solid 1px #C7C7C7;">
                    </div>

                    <div class="m-t-xl widget-cl-1" style="padding-top: 70px;">

                        <small>
                            <span id="get_payee_name_{{$row->pmember_id}}">{{$row->psurname}}</span> has paid <span class="text-danger"><b>
                                    GHC<span id="amount_paid{{$row->pmember_id}}_{{$row->transid}}">{{$row->tpaid}}</span>

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
                    <button type="button" class="btn btn-xs btn-success  shadow-sm make_payment {{$row->transid.'_'.$row->pmember_id}}" id="{{$row->transid.'-'.$row->pmember_id.'-3'}}" style="border-radius:10px;" data-toggle="modal" data-target="#WarningModalalert">Make Payment</button>
                    <button type="button" class="btn btn-xs btn-info  show_member_payment_history" id="{{$row->transid.'_'.$row->pmember_id}}" data-toggle="modal" data-target="#PrimaryModalhdbgcl" style="border-radius: 10px;">View History</button>

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

