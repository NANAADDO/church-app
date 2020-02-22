@extends('layouts.admin')

@section('content')

<div class="analytics-sparkle-area">
    <div class="container-fluid">
        <div class="row">

            <?php
            $permdash = \App\Helpers\Menu::get_all_sub_menu_permission();
           $tmember = Memberdata::get_total_member();
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

                                    @if(in_array(19,$permdash))
                {!! Dashboard::get_card_simple_desc(['Transport',Paymentdata::get_payment_total_based_collection_id(3),'fa fa-money',2,'B']) !!}
                @endif

                                        @if(in_array(21,$permdash))
                {!! Dashboard::get_card_simple_desc(['Welfare Dues',Paymentdata::get_payment_total_based_collection_id(5),'fa fa-money',1,'B']) !!}
                {!! Dashboard::get_card_simple_desc(['Welfare Levy',Paymentdata::get_payment_total_based_collection_id(6),'fa fa-money','4','B']) !!}
                @endif
                                            @if(in_array(20,$permdash))

                {!! Dashboard::get_card_simple_desc(['Pledge',Paymentdata::get_payment_total_based_collection_id(2),'fa fa-money',3,'B']) !!}
                @endif


                                                @if(in_array(22,$permdash))
                 @foreach(\App\Helpers\Given::get_church_given_based_on_group_id_only(5) as $key => $data)
         <?php
          $key=$key  + 1;
                ?>
                    {!! Dashboard::get_card_simple_desc([$data->description,Paymentdata::get_payment_total_based_collection_id($data->id),'fa fa-money',$key,'B']) !!}


                @endforeach
                @endif

                     @if(in_array(23,$permdash))

                {!! Dashboard::get_card_simple_desc(['Tithe',Paymentdata::get_payment_total_based_collection_id(1),'fa fa-money',5,'B']) !!}
                @endif

                         @if(in_array(23,$permdash) || in_array(22,$permdash) || in_array(20,$permdash) || in_array(21,$permdash) || in_array(19,$permdash))
                {!! Dashboard::get_card_simple_desc(['Total Collected',Paymentdata::get_payment_total_based_collection_id(0),'fa fa-money',2,'B']) !!}
                @endif

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
