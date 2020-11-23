@extends('layouts.admin')

@section('content')

<div class="analytics-sparkle-area">
    <div class="container-fluid">
        <div class="row">
     @csrf()
            <?php
            $permdash = \App\Helpers\Menu::get_all_sub_menu_permission();
           $tmember = Memberdata::get_total_member();
           $date=\App\Helpers\GeneralVariables::currentdate();
?>
            @if(in_array(5,$permdash))
            {!! Dashboard::get_card_simple(['Total Staff',Staffdata::get_total_staff(),'fa fa-users',2,'L']) !!}
                @endif

                @if(in_array(7,$permdash))
            {!! Dashboard::get_card_simple(['Given Types',Givendata::get_church_given_count(),'fa fa-gift',1,'L']) !!}
                @endif

                    @if(in_array(2,$permdash))
            {!! Dashboard::get_card_simple(['Church Groups',Groupdata::get_church_group_count(),'fa fa-group','4','L']) !!}

                @endif

                        @if(in_array(18,$permdash))
            {!! Dashboard::get_card_simple(['Active Funeral TXT',Funeraldata::get_total_staff(),'fa fa-car',3,'L']) !!}
                @endif



                                @if(in_array(12,$permdash))
            {!! Dashboard::get_card_with_bar(['Total Communicant',Memberdata::get_total_based_on_col('are_you_a_communicant',2),'fa fa-users',4,'B',$tmember]) !!}
            {!! Dashboard::get_card_with_bar(['Total Baptized',Memberdata::get_total_based_on_col('are_you_baptised',2),'fa fa-users',3,'B',$tmember]) !!}
            {!! Dashboard::get_card_with_bar(['Total Confirm',Memberdata::get_total_based_on_col('have_you_been_confirm',2),'fa fa-group','1','B',$tmember]) !!}
            {!! Dashboard::get_card_with_bar(['Total Convert',Memberdata::get_total_based_on_col('are_you_a_convert',2),'fa fa-users',2,'B',$tmember]) !!}
                {!! Dashboard::get_card_with_bar(['Total Welfare Members',Memberdata::get_total_based_on_col_mem('does_member_want_to_join_welfare',2),'fa fa-users',2,'B',$tmember]) !!}
                @endif
<section id="show_dynamic_date_payment">
                                    @include('includes.dash')
</section>
                <div class="col-md-3">
                <div class="analytics-sparkle-line reso-mg-b-30 border-bottom-primary shadow" style="margin-bottom: 20px;">
                    <div class="analytics-content" style="padding-bottom: 10px;">
                        <small class="text-center" style="text-align: center;font-size:x-small;">SEARCH PAYMENT SUMMARY</small>
                        <hr>
                        <div class="row">
                        <div class="col-md-10">
                        <h5 class=" font-weight-bold"><input type="text" class="form-control date_selected" id="dated">
                        </h5>
                        </div>
                        <div class="col-md-2">
                            <small style="color: red;"></small>  <span class="tuition-fees" style="cursor: pointer;" id="search_day_payment"><i class="fa fa-search fa-2x texta-success"></i></span> </div>
                        </div>

                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            @if(in_array(5,$permdash))
         {!! Dashboard::get_card_tray_detail_raw(['Staff',2,1,2,url('/'),Dashboard::get_staff_details(),['Name','Role','Phone Number']]) !!}
            @endif
                @if(in_array(18,$permdash))
            {!! Dashboard::get_card_tray_detail_pan(['Funeral TXT',3,1,2,url('/'),Dashboard::get_active_funeral_details(),['']]) !!}
                @endif


        <?Php
        $thea=['Name','Amount','Colection Type','Date Paid'];
        ?>

            @if(in_array(21,$permdash))
            {!! Dashboard::get_card_tray_detail_raw(['Welfare Payment',4,1,2,url('/'),Dashboard::get_payment_details(2),$thea]) !!}
            @endif
                @if(in_array(23,$permdash))

            {!! Dashboard::get_card_tray_detail_raw(['Tithe Payment',1,1,2,url('/'),Dashboard::get_payment_details(4),$thea]) !!}
                @endif


        @if(in_array(19,$permdash))
        {!! Dashboard::get_card_tray_detail_raw(['Transport Payment',3,1,2,url('/'),Dashboard::get_payment_details(3),$thea]) !!}
        @endif
            @if(in_array(20,$permdash))

        {!! Dashboard::get_card_tray_detail_raw(['Pledge Payment',2,1,2,url('/'),Dashboard::get_payment_details(1),$thea]) !!}
            @endif

            @if(in_array(22,$permdash))
            {!! Dashboard::get_card_tray_detail_raw(['Other Payment',5,1,1,url('/'),Dashboard::get_payment_details(5),$thea]) !!}
            @endif


        @if(in_array(7,$permdash))
        {!! Dashboard::get_card_tray_detail(['Given',1,1,2,url('/'),Givendata::get_church_given_info()]) !!}
        @endif
            @if(in_array(2,$permdash))
        {!! Dashboard::get_card_tray_detail(['Groups',4,1,2,url('/'),Groupdata::get_church_group_info()]) !!}
            @endif
    </div>
</div>


</div>

    </div>
</div>
</div>
@endsection
