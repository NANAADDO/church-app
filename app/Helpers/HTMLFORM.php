<?php
//app/Helpers/User.php
namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class HTMLFORM {




public static function get_label_name($name){
    $find ='_id';
    $replace = ' ';
    $takeout_id = str_replace($find,$replace,$name);
    $find_ ='_';
    $takeout_ = str_replace($find_,$replace,$takeout_id);
    return ucwords($takeout_);

}





    public static function get_dynamic_form_permission($box1name,$box2name){

      return   '<div class="col-md-2"><div class="subject-info-arrows text-center">
            <button type="button" id="'.$box1name.'" class="btn btn-outline-info btnAllRight" >>></button><br />
            <button type="button" id="'.$box1name.'"  class="btn btn-outline-info btnRight" >></button><br />
            <button type="button" id="'.$box2name.'" class="btn btn-outline-info btnLeft" ><</button><br />
            <button type="button" id="'.$box2name.'"  class="btn btn-outline-info btnAllLeft" ><<</button>
        </div></div>';
    }

/*
 *
 $data_select_input =[form_name,multiple_option,id_name,class_name,size,'forloopoption','readonlyoption']
 *
 *
 */

    public static function get_dynamic_form_complete_collective_textarea($data=[]){

        return '<div class="form-group-inner">
            <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                '.self::get_dynamic_form_textarea_collective($data).'                
        </div>
            </div>
        </div>
        </div>';
    }
    public static function get_dynamic_form_complete_collective_input($data=[]){

        return '<div class="form-group-inner">
            <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                '.self::get_dynamic_form_input_collective($data).'                
        </div>
            </div>
        </div>
        </div>';
    }



    public static function get_dynamic_form_complete_collective_c4_input($data=[]){

        return '<div class="form-group-inner">
            
            <div class="col-md-4" style="margin-bottom: 40px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_input_collective($data).'                
        
            </div>
        </div>
        </div>';
    }

    public static function get_dynamic_form_complete_collective_c3_input($data=[]){

        return '<div class="form-group-inner">
            
            <div class="col-md-3" style="margin-bottom: 40px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_input_collective($data).'                
        
            </div>
        </div>
        </div>';
    }


    public static function get_dynamic_form_complete_input($data=[]){

        return '<div class="form-group-inner">
            <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                '.self::get_dynamic_form_type_input($data).'                
        </div>
            </div>
        </div>
        </div>';
    }

    public static function get_dynamic_form_complete_select_collective($data=[]){

        return '<div class="form-group-inner">
            <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                '.self::get_dynamic_form_select_collective($data).'                
        </div>
            </div>
        </div>
        </div>';
    }



    public static function get_dynamic_form_complete_select_c4_case($data=[]){

        return '<div class="form-group-inner"> 
                <div class="col-md-4" style="margin-bottom: 40px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_input_type_select_case($data).'   
                </div>             
        </div>
        </div>';
    }

    public static function get_dynamic_form_complete_select_c4_cases($data=[]){

        return '<div class="form-group-inner"> 
                <div class="col-md-4" style="margin-bottom: 40px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_input_type_select_cases($data).'   
                </div>             
        </div>
        </div>';
    }
    public static function get_dynamic_form_complete_select_c4_collective($data=[]){

        return '<div class="form-group-inner">
           
           
                
                <div class="col-md-4" style="margin-bottom: 40px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_select_collective($data).'   
                </div>             
       
        </div>
        </div>';
    }

    public static function get_dynamic_form_complete_select_c3_collective($data=[]){

        return '<div class="form-group-inner">
           
           
                
                <div class="col-md-3" style="margin-bottom: 40px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                '.self::get_dynamic_form_select_collective($data).'   
                </div>             
       
        </div>
        </div>';
    }

    public static function get_dynamic_form_complete_select($data=[]){

        return '<div class="form-group-inner">
            <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                '.self::get_dynamic_form_label([$data[8]]).'
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                '.self::get_dynamic_form_input_type_select($data).'                
        </div>
            </div>
        </div>
        </div>';
    }

    public static function get_dynamic_form_select_collective($data=[]){
        $errors = @$data[6];
        $name = @$data[0];
        $has_err = 'has-error';
        $has_null = '';
        $css1 = "font-size: 1.0rem;-webkit-appearance:menulist-button; border-radius:2px;";
        $css2 = "font-size: 1.0rem; border-radius:2px; ";
        ( @$data[1]=="true" ? $css=$css2:$css=$css1);
        ( @$data[1]=="true" ? $typemlti='multiple':$typemlti="");
        $response = '';
        $response.='<div class="form-group ';
        $response.= (@$errors->has($name) ? $has_err  : $has_null).' ">';
        $response.=\Form::select(@$data[0],( !empty(@$data[5]) ?  @$data[5]  :[] ),@$data[9], array('class'=> @$data[3].' form-control-user','style'=>$css,
            'size'=>@$data[4],'id'=>@$data[2],'placeholder'=>'select option.. ', $typemlti=>$typemlti, ( @$data[7]=='true' ?  'readonly'  :null )  ));
        if ($errors->has($name)){
            $response.='<span class="text-danger"> <strong>'.@$errors->first($name) .'</strong> </span>';
        }
        $response.='</div>';
        return $response;

    }


    public static function get_dynamic_form_input_type_select($data=[]){
        $errors = @$data[6];
        $name = @$data[0];
        $css1 = 'style="font-size: 1.0rem; border-radius:2px; border:1px solid #cccccc;"';
        $css2 = 'style="font-size: 1.0rem;; border-radius:2px; border:1px solid #cccccc;"';
        ( @$data[1]=="true" ? $css=$css2:$css=$css1);
        ( @$data[1]=="true" ? $typemlti='multiple':$typemlti="");
      $response = '';
      if(!empty($data[5])) {
          $response.='<div class="form-group';
          $response.= @$errors->has($name) ? "has-error" : "" .'">';
          $response.=  '<select name ="' . @$data[0] .'"'.$typemlti.' id="' . @$data[2] . '" class="form-control-user ' .  @$data[3] . '" size="' . @$data[4] .'" 
          '.( @$data[7]=="true" ?  " readonly "  :null ). $css. '>';
                   foreach(@$data[5] as $data ){
                       $response.= '<option value="' . $data->id . '"';

                       if($data->id==old($name)){
                           $response.=' selected';
                           }
                       $response.='>'. $data->name . '</option>';


                   }
                   $response.='</select>';
          if ($errors->has($name)){
              $response.='<span class="text-danger"> <strong>'.@$errors->first($name) .'</strong> </span>';
      }
          $response.='</div>';
                   return $response;
        }
        else {
            $response.='<div class="form-group';
            $response.= @$errors->has($name) ? "has-error" : "" .'
            " >';

            $response.= '<select name ="' . @$data[0] .'"'.$typemlti.' id="' . @$data[2] . '" class="form-control-user '  . @$data[3] . '" size="' . @$data[4] .'" 
          '.( @$data[7]=="true" ?  " readonly "  :null ) . $css. '></select></select>';
            $response.='</div>';
            return $response;
        }
    }



    public static function get_dynamic_form_input_type_select_case($data=[]){
        $errors = @$data[6];
        $name = @$data[0];
        $oldv = @$data[9];
        $css1 = 'style="font-size: 1.0rem; border-radius:2px; border:1px solid #cccccc;"';
        $css2 = 'style="font-size: 1.0rem;; border-radius:2px; border:1px solid #cccccc;"';
        ( @$data[1]=="true" ? $css=$css2:$css=$css1);
        ( @$data[1]=="true" ? $typemlti='multiple':$typemlti="");
        $response = '';
        if(!empty($data[5])) {
            $response.='<div class="form-group';
            $response.= @$errors->has($name) ? "has-error" : "" .'">';
            $response.=  '<select name ="' . @$data[0] .'"'.$typemlti.' id="' . @$data[2] . '" class="form-control-user ' .  @$data[3] . '" size="' . @$data[4] .'" 
          '.( @$data[7]=="true" ?  " readonly "  :null ). $css. '>';
            foreach(@$data[5] as $data ){
                $response.= '<option value="' . $data->id . '"';

                if($data->id==$oldv){
                    $response.=' selected';
                }
                $response.='>'. $data->name . '</option>';


            }
            $response.='</select>';
            if ($errors->has($name)){
                $response.='<span class="text-danger"> <strong>'.@$errors->first($name) .'</strong> </span>';
            }
            $response.='</div>';
            return $response;
        }
        else {
            $response.='<div class="form-group';
            $response.= @$errors->has($name) ? "has-error" : "" .'
            " >';

            $response.= '<select name ="' . @$data[0] .'"'.$typemlti.' id="' . @$data[2] . '" class="form-control-user '  . @$data[3] . '" size="' . @$data[4] .'" 
          '.( @$data[7]=="true" ?  " readonly "  :null ) . $css. '></select></select>';
            $response.='</div>';
            return $response;
        }
    }





    public static function get_dynamic_form_input_type_select_cases($data=[]){
        $errors = @$data[6];
        $name = @$data[0];
        $oldv = @$data[9];
        $css1 = 'style="font-size: 1.0rem; border-radius:2px; border:1px solid #cccccc;"';
        $css2 = 'style="font-size: 1.0rem;; border-radius:2px; border:1px solid #cccccc;"';
        ( @$data[1]=="true" ? $css=$css2:$css=$css1);
        ( @$data[1]=="true" ? $typemlti='multiple':$typemlti="");
        $response = '';
        if(!empty($data[5])) {
            $response.='<div class="form-group';
            $response.= @$errors->has($name) ? "has-error" : "" .'">';
            $response.=  '<select name ="' . @$data[0] .'"'.$typemlti.' id="' . @$data[2] . '" class="form-control-user ' .  @$data[3] . '" size="' . @$data[4] .'" 
          '.( @$data[7]=="true" ?  " readonly "  :null ). $css. '>';
            foreach(@$data[5] as $data ){
                $response.= '<option value="' . $data->id . '"';

                if($data->id==$oldv){
                    $response.=' selected';
                }
                $response.='>'. $data->name . '</option>';


            }
            $response.='<option value="false" '.($oldv=="false"? "selected":"").'>Other Specify</option></select>';
            if ($errors->has($name)){
                $response.='<span class="text-danger"> <strong>'.@$errors->first($name) .'</strong> </span>';
            }
            $response.='</div>';
            return $response;
        }
        else {
            $response.='<div class="form-group';
            $response.= @$errors->has($name) ? "has-error" : "" .'
            " >';

            $response.= '<select name ="' . @$data[0] .'"'.$typemlti.' id="' . @$data[2] . '" class="form-control-user '  . @$data[3] . '" size="' . @$data[4] .'" 
          '.( @$data[7]=="true" ?  " readonly "  :null ) . $css. '></select></select>';
            $response.='</div>';
            return $response;
        }
    }



    public static function get_dynamic_form_label($data=[]){


        return '<label name ="'.@$data[0].'" class="login2"> '.@$data[0].'</label>';
    }


    /*
 *
     ['email','email','form-control form-control-user','exampleInputEmail','',$errors,'readonly','placeholder']
 $data_input =[type,form_name,class_name,id_name,value,$errors,readonly_option,'']
 *
 *
 */



    public static function get_dynamic_form_textarea_collective($data=[]){
        $response = '';
        $errors = @$data[5];
        $name = @$data[1];
        $placeholder = @$data[6];
        $response.='<div class="form-group ';
        $response.= (@$errors->has($name) ? " has-error" : " " ).'">';

        $response.= \Form::textarea(@$data[1],@$data[9],array('class'=> @$data[2].' form-control-user',( @$data[7]=='true' ?  'readonly'  :null ),'id'=>@$data[3],'placeholder'=>$placeholder ,'style'=>'border-radius:0px;')  );

        if ($errors->has($name)){

            $response.='<span class="text-danger"> <strong>'.@$errors->first($name) .'</strong> </span>';
        }
        $response.='</div>';

        return $response;
    }

    public static function get_dynamic_form_input_collective($data=[]){
        $response = '';
        $errors = @$data[5];
        $name = @$data[1];
        $placeholder = @$data[6];
        $value = @$data[9];
        $response.='<div class="form-group ';
        $response.= (@$errors->has($name) ? " has-error" : " " ).'">';
       if($data[0]=='password') {
           $response .= \Form::password(@$data[1], array('class' => @$data[2] . ' form-control-user', (@$data[7] == 'true' ? 'readonly' : null), 'id' => @$data[3], 'placeholder' => $placeholder));

       }
       else{

           $response .= \Form::text(@$data[1], (!empty($value) ? $value : null), array('class' => @$data[2] . ' form-control-user', (@$data[7] == 'true' ? 'readonly' : null), 'id' => @$data[3], 'placeholder' => $placeholder));

       }

        if ($errors->has($name)){

            $response.='<span class="text-danger"> <strong>'.@$errors->first($name) .'</strong> </span>';
        }
        $response.='</div>';

        return $response;
    }

    public static function get_dynamic_form_type_input($data=[]){
        $response = '';
        $errors = @$data[5];
        $name = @$data[1];
        $placeholder = @$data[6];
        $response.='<div class="form-group ';
        $response.= (@$errors->has($name) ? " has-error" : " " ).'">';
        $response.= '<input type="'.@$data[0].'" name ="'.@$data[1].'" class="form-control-user ' .@$data[2].'" id="'.@$data[3].'" value="'.old(@$data[1]).'" placeholder="'.$placeholder.'"
        '.( @$data[7]=="true" ?  "readonly"  :null ).'/>';
        if ($errors->has($name)){

            $response.='<span class="text-danger"> <strong>'.@$errors->first($name) .'</strong> </span>';
        }
        $response.='</div>';

   return $response;
    }

    public static function select_form_for_permission($data=[]){

        return '<div class="col-md-5">'.self::get_dynamic_form_input_type_select($data).'</div>';
    }

    public static function get_dynamic_form_type_button_popup($data=[]){
        $response = '';
        $response.= '<input type="'.@$data[0].'" class="'.@$data[1].'" ';
        $response.='onclick="return confirm(\'Are you sure to submit this form ?\')" id="'.@$data[2].'" value="'.@$data[2].'">';

        return $response;
    }
    public static function get_dynamic_form_type_button($data=[]){
        $response = '';
        $response.= '<input type="'.@$data[0].'" class="'.@$data[1].'" id="'.@$data[3].'" value="'.@$data[2].'">';

        return $response;
    }

    public static function get_dynamic_form_type_button_link($data=[]){

        return   '<a class="'.@$data[0].'" href="'.@$data[1].'" role="button">'.@$data[2].'</a>';
    }


    public static function get_general_form_processor($action_name,$linkpath){
        $response = '';

        $response.= '<div class="form-group">
        <label class="col-md-4 control-label" for="save"></label>
        <div class="col-md-8">';
        $response.= self::get_dynamic_form_type_button_popup(['submit','btn btn-success btn-user',$action_name]);
        $response.= self::get_dynamic_form_type_button(['reset','btn btn-warning btn-user','reset']);
        $response.=self::get_dynamic_form_type_button_link(['btn btn-danger btn-user',$linkpath,'Cancel']).'</div> </div>';

    return $response;
    }

    public static function get_general_form_process($action_name,$linkcancel,$linkedit){
        $response = '';

        $response.= '<div class="form-group">
        <label class="col-md-4 control-label" for="save"></label>
        <div class="col-md-8">';
        $response.=self::get_dynamic_form_type_button_link(['btn btn-info btn-user',$linkcancel,'Edit']);
        $response.=self::get_dynamic_form_type_button_link(['btn btn-danger btn-user',$linkedit,'Cancel']).'</div> </div>';

        return $response;
    }


    public static function show_divs_html($data = []){

$response = '';
$div = (count($data)>1 ? "col-lg-6 col-md-12 col-sm-12 col-xs-6":"col-lg-12");
        if(count($data) > 0){
           $response.= '<div class="row">';
               foreach($data as $key=>$value) {
                   $response.= '<div class="'.$div.'">
                            <div class="address-hr">
                                <p><b>' . $key . '</b><br> ' .(!empty($value)?$value:'N/A') . '</p>
                            </div>
                        </div>';
               }

            $response.= '</div>';
        }
        else{

            $response ='';
        }

        return $response;






    }
}
