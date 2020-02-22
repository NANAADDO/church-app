<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class Dashboard {

    protected static $table = '';




    public static function get_payment_details($id)
    {
        $stdata = '';
        $data = Payment::get_daily_payment_details_by_user($id);
        if(count($data) > 0) {

            foreach ($data as $row) {
                $stdata .= '<tr><td>' . $row->member->surname . ' ' . $row->member->other_name . '</td><td>' . $row->amount_paid . '</td><td>' . $row->collection->name . '</td></td>
<td>' . $row->date_paid . '</td></tr>';

            }
        }
        else{

          $stdata = '<tr><td></td><td></td><td><P style="color: red; text-align: center; margin-top: 50px;">No data found..</P></td><td></td></tr>';
        }


        return $stdata;
    }
    public static function get_active_funeral_details()
    {
        $fdata = '';

        foreach (Funeral::get_active_funeral() as $fun){
            $total = $fun->expected_amount;
            $tfull = Payment::get_payment_total_based_on_type_only($fun->id,$fun->amount);
            $tful = Payment::get_payment_total_commited_based_on_type_only($fun->id,$fun->amount);
            $tpaid=$tful[0]->tamount;
            //dd($tful);
            $percentcolor = self::get_colors(self::get_colors_based__on_percent($total,$tpaid),'B');
            $percentcalc = self::get_percent_calc($total,$tpaid);
            $fdata.='<div  style="background:#d3d3d347; padding: 10px; margin-bottom: 10px;">
                    <h5 class="text-info" style="text-transform: uppercase;">'.$fun->member->surname.' '. $fun->member->other_names .'</h5>
                    <hr/>
                    <div style="padding-bottom: 20px;">
                    <div class="pull-left"><small><b>Members Expected</b> :<span style="color: red;"><b>'.$fun->expected_people.'</b></span></small></div>
                    <div class="pull-right"><small><b>Amount Expected :</b><span style="color: red;">GHC</span> <b>'.$total.'</b></small></div>
                    </div>
                    <div style="padding-bottom: 20px;">
                    <div class="pull-left"><small><b>Members Committed</b> :<span style="color: red;"><b>'.$tful[0]->comi.'</b></span></small></div>
                    <div class="pull-right"><small><b>Member Fully Paid :</b> <b CLASS="text-success">'.$tfull[0]->total.'</b></small></div>
                    </div>
                    <div style="clear: both;padding-bottom: 20px;">
                            <small><span style="color: red;">GHC</span> <b>'.$tpaid.'</b> Out of <span style="color: red;">GHC</span> <b>'.$total.'</b> paid</small>
                        <div class="pull-right">'.$percentcalc.' %<i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar '.$percentcolor.' ctn-vs-3" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentcalc.'%;"> <span class="sr-only">'.$percentcalc.'% Complete</span></div>
                        </div>
                        </div>
                        ';

        }


        return $fdata;
    }




    public static function get_staff_details()
    {
        $stdata = '';

        foreach (Staff::get_staff() as $staff){
            $stdata.='<tr><td>'.$staff->name.'</td><td>'.Roles::get_staff_role($staff->id).'</td><td>'.$staff->phone_number.'</td></td></tr>';

        }


        return $stdata;
    }



    public static function get_card_simple($data=[])
    {
        $title = $data[0];
        $total = $data[1];
        $fonticon = $data[2];
        $pref = $data[3];
        $where = $data[4];
        $color = self::get_colors($pref,'T');
        $border = self::get_border_colors($pref,$where);

        return '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 '.$border.' shadow" style="margin-bottom: 20px; min-height:142px; ">
                    <div class="analytics-content">
                        <h5 class=" font-weight-bold">'.$title.'</h5>
                        <h2><span class="counter">'.$total.'</span> <span class="tuition-fees"><i class="'.$fonticon.' fa-2x '.$color.'"></i></span></h2>
                       
                        </div>
                </div>
            </div>';

    }


    public static function get_card_simple_desc($data=[])
    {
        $title = $data[0];
        $total = $data[1];
        $fonticon = $data[2];
        $pref = $data[3];
        $where = $data[4];
        $color = self::get_colors($pref,'T');
        $border = self::get_border_colors($pref,$where);

        return '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 '.$border.' shadow" style="margin-bottom: 20px;">
                    <div class="analytics-content">
                     <small class="text-center" style="text-align: center;font-size:x-small;">DAILY COLLECTION TOTAL</small>
                    <hr/>
                        <h5 class=" font-weight-bold">'.$title.'</h5>
                        <h2><small style="color: red;">GHC:</small> <span class="counter">'.number_format($total,2).'</span> <span class="tuition-fees"><i class="'.$fonticon.' fa-2x '.$color.'"></i></span></h2>
                       
                        </div>
                </div>
            </div>';

    }

    public static function get_card_with_bar($data=[])
    {
          $title = $data[0];
        $total = $data[1];
        $fonticon = $data[2];
        $pref = $data[3];
        $where = $data[4];
        $tmemb = @$data[5];

        $color = self::get_colors(self::get_colors_based__on_percent($tmemb,$total),'T');
        $border = self::get_border_colors($pref,$where);
        $percentcolor = self::get_colors(self::get_colors_based__on_percent($tmemb,$total),'B');
        $percentcalc = self::get_percent_calc($tmemb,$total);

return '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30  shadow" style="margin-bottom: 20px;">
                    <div class="analytics-content">
                  
                        <h5 class=" font-weight-bold">'.$title.'</h5>
                        <h2><span class="counter">'.$total.'</span> <span class="tuition-fees"><i class="'.$fonticon.' fa-2x '.$color.'"></i></span></h2>
                      <div style="padding-top:20px;">
                       <div class="pull-left"><small>'.$total.' Out of '.$tmemb.'</small></div>
                        <div class="pull-right">
                        <span class="text-success">'.$percentcalc.'%</span>
                        </div>
                        </div>
                        <div class="progress m-b-0" style="clear: both" style="padding-top: 20px;">
                            <div class="progress-bar '.$percentcolor.'" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentcalc.'%;"> <span class="sr-only">'.$percentcalc.'% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>';
    }



    public static function get_card_tray_detail($data=[]){
        $name = @$data[0];
        $btn_color =self::get_btn_colors(@$data[1]);
        $butdispplayoption = @$data[2];
        $action = '';
        $db = @$data[5];
        if($db==1){
            $show = '<P style="color: red; text-align: center; margin-top: 50px;">No data found..</P>';
        }
        else{
            $show = @$data[5];
        }


        $div = 'col-lg-6 col-md-12 col-sm-12 col-xs-12';
        if(@$data[3]==1){
            $div = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }
        $link = @$data[4];

        if($butdispplayoption==1){
            $action = '<a href="'.$link.'" role-="button" class="btn btn-md  '.$btn_color.'  btn-rounded" style="border-radius: 17px;"><i class="fa fa-plus-circle"></i> Create '.$name.'</a> ';
        }



        return '<div class="'.$div.'">
                <div class="product-sales-chart shadow" style="margin-bottom: 5px; height:300px; overflow: scroll;">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style=" ">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>'.$name.' Details</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="actions graph-rp graph-rp-dl">
                                    <p> 
                                    '.$action.'
                                    </p>
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                            '.$show.'
                </div>
            </div>';

    }

    public static function get_card_tray_detail_pan($data=[]){
        $name = @$data[0];
        $btn_color =self::get_btn_colors(@$data[1]);
        $butdispplayoption = @$data[2];
        $action = '';
        $th='';
        $db = @$data[5];
        if($db==1){
            $show = '<P style="color: red; text-align: center; margin-top: 50px;">No data found..</P>';
        }
        else{
            $show = @$data[5];
        }


        $div = 'col-lg-6 col-md-12 col-sm-12 col-xs-12';
        if(@$data[3]==1){
            $div = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }
        $link = @$data[4];

        if($butdispplayoption==1){
            $action = '<a href="'.$link.'" role-="button" class="btn btn-md  '.$btn_color.'  btn-rounded" style="border-radius: 17px;"><i class="fa fa-plus-circle"></i> Create '.$name.'</a> ';
        }
    foreach($data[6] as $key=>$thd){
       $th.= '<th>'.$thd.'</th>';

        }


        return '<div class="'.$div.'">
                <div class="product-sales-chart shadow" style="margin-bottom: 5px; height:300px; overflow: scroll;">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style=" ">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>'.$name.' Details</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="actions graph-rp graph-rp-dl">
                                    <p> 
                                    '.$action.'
                                    </p>
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                       '.$show.'
                </div>
            </div>';

    }


    public static function get_card_tray_detail_raw($data=[]){
        $name = @$data[0];
        $btn_color =self::get_btn_colors(@$data[1]);
        $butdispplayoption = @$data[2];
        $action = '';
        $th='';
        $db = @$data[5];
        if($db==1){
            $show = '<P style="color: red; text-align: center; margin-top: 50px;">No data found..</P>';
        }
        else{
            $show = @$data[5];
        }


        $div = 'col-lg-6 col-md-12 col-sm-12 col-xs-12';
        if(@$data[3]==1){
            $div = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }
        $link = @$data[4];

        if($butdispplayoption==1){
            $action = '<a href="'.$link.'" role-="button" class="btn btn-md  '.$btn_color.'  btn-rounded" style="border-radius: 17px;"><i class="fa fa-plus-circle"></i> Create '.$name.'</a> ';
        }
        foreach($data[6] as $key=>$thd){
            $th.= '<th>'.$thd.'</th>';

        }


        return '<div class="'.$div.'">
                <div class="product-sales-chart shadow" style="margin-bottom: 5px; height:300px; overflow: scroll;">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style=" ">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>'.$name.' Details</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="actions graph-rp graph-rp-dl">
                                    <p> 
                                    '.$action.'
                                    </p>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="table-responsive"><table class="table border-table">
       <thead><tr>'.$th.'</tr></thead><tbody> </tbody>
                    
                            '.$show.'
                          </table>
                          </div>  
                </div>
            </div>';

    }

    public static function get_percent_calc($total,$subtotal)
    {
		if($total==0){
			return number_format(($total),2);
		}
        return  number_format(($subtotal / $total) * 100,2);

    }

        public static function get_colors_based__on_percent($total,$subtotal)
    {
		
		if($total==0){
			$percent =0;
		}
		else{
			
 $percent = ($subtotal/$total) * 100;
		}
 if($percent ==0){

    $color = 3;
 }
 else if($percent > 0 && $percent <= 25){

     $color = 5;
 }


 else if($percent > 25 && $percent <= 50){

     $color = 2;
 }

 else if($percent > 50 && $percent <=75){

     $color = 4;
 }

 else if($percent > 75 && $percent <=89){

     $color = 4;
 }

 else{


     $color = 1;
 }

 return $color;
    }




    public static function get_colors($data,$type)
    {
        if($type=='B'){
         $spec ='progress-bar';
        }
        else if($type=='T'){
            $spec ='texta';
        }
$color = '';
        if($data==1){

            $color = $spec.'-success';
        }
        else if($data==2){

            $color =$spec.'-primary';
        }

        else if($data==3){

            $color =$spec.'-danger';
        }
        else if($data==4){

            $color =$spec.'-info';
        }

        else if($data==5){

            $color =$spec.'-warning';
        }
        else {
            $color =$spec.'-default';
        }

        return $color;
    }


    public static function get_border_colors($data,$where)
    {
        $location ='';

        if($where =='B'){
            $location ='bottom';
        }

        if($where =='L'){
            $location ='left';
        }
        $color = '';
        if($data==1){

            $color ='border-'.$location.'-success';
        }
        else if($data==2){

            $color ='border-'.$location.'-primary';
        }

        else if($data==3){

            $color ='border-'.$location.'-danger';
        }
        else if($data==4){

            $color ='border-'.$location.'-info';
        }

        else if($data==5){

            $color ='border-'.$location.'-warning';
        }
        else if($data==6){

            $color ='border-'.$location.'-dark';
        }
        else {
            $color ='border-'.$location.'-light';
        }
        return $color;
    }



    public static function get_btn_colors($data)
    {

        $color = '';
        if($data==1){

            $color ='btn-success';
        }
        else if($data==2){

            $color ='btn-primary';
        }

        else if($data==3){

            $color ='btn-danger';
        }
        else if($data==4){

            $color ='btn-info';
        }

        else if($data==5){

            $color ='btn-warning';
        }

        return $color;
    }




}
