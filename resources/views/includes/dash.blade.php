@if(in_array(19,$permdash))
    {!! Dashboard::get_card_simple_desc(['Transport',Paymentdata::get_payment_total_based_collection_id_and_date(3,$date),'fa fa-money',2,'B']) !!}
@endif

@if(in_array(21,$permdash))
    {!! Dashboard::get_card_simple_desc(['Welfare Dues',Paymentdata::get_payment_total_based_collection_id_and_date(5,$date),'fa fa-money',1,'B']) !!}
    {!! Dashboard::get_card_simple_desc(['Welfare Levy',Paymentdata::get_payment_total_based_collection_id_and_date(6,$date),'fa fa-money','4','B']) !!}
@endif
@if(in_array(20,$permdash))

    {!! Dashboard::get_card_simple_desc(['Pledge',Paymentdata::get_payment_total_based_collection_id_and_date(2,$date),'fa fa-money',3,'B']) !!}
@endif


@if(in_array(22,$permdash))
    @foreach(\App\Helpers\Given::get_church_given_based_on_group_id_only(5) as $key => $data)
        <?php
        $key=$key  + 1;
        ?>
        {!! Dashboard::get_card_simple_desc([$data->description,Paymentdata::get_payment_total_based_collection_id_and_date($data->id,$date),'fa fa-money',$key,'B']) !!}


    @endforeach
@endif

@if(in_array(23,$permdash))

    {!! Dashboard::get_card_simple_desc(['Tithe',Paymentdata::get_payment_total_based_collection_id_and_date(1,$date),'fa fa-money',5,'B']) !!}
@endif

@if(in_array(23,$permdash) || in_array(22,$permdash) || in_array(20,$permdash) || in_array(21,$permdash) || in_array(19,$permdash))
    {!! Dashboard::get_card_simple_desc(['Total Collected',Paymentdata::get_payment_total_based_collection_id_and_date(0,$date),'fa fa-money',2,'B']) !!}
@endif
