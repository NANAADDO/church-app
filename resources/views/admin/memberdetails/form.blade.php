
                   <?PHP
                       //  qdd($data);
                   $qoption = DBSELOPTION::get_all_options();
                   $block = 'style="display: block;"';
                   $none = 'style="display: none;"';
                   $re = "<span style='color:red; font-weight: bold; font-size: 1.0em;'> * </span>";
                   $df = "<span style='color:green; font-weight: bold; font-size: 0.7em; '> [YYYY-MM-DD] </span>";
                 //dd($data->relatives[0])
                   ?>
                    <div class="product-payment-inner-st">
                        <ul id="myTabedu1" class="tab-review-design">
                            <li class="active"><a href="#description">Personal Details</a></li>
                            <li><a href="#reviews"> Educational Details</a></li>
                            <li><a href="#INFORMATION">Employment Details</a></li>
                            <li><a href="#family">Family Details</a></li>
                            <li><a href="#marital">Marital Details</a></li>
                            <li><a href="#religion">Religious Details</a></li>
                        </ul>

                        <h5 style="text-align: center"><b><span style="">All Field marked</span> <span style="color: red;">[ * ]</span> <span style="">are required field</span></b></h5>

                     @include('errors.messages')
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div id="dropzone1" class="pro-ad addcoursepro">
                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['status_id', 'false','memberStatus' ,"form-control","",DBSELOPTION::get_all_status(),$errors,$read,'Member Status '.$re,null])!!}
                                                <div id="date_died_show" style="display: {{(old('status_id') ==3 ?  'block;':'none;')}}">
                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','date_died','form-control','dated5','',$errors,'Date Died',$read,'']) !!}
                                                </div>

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','surname','form-control','','',$errors,'',$read,'Surname '.$re]) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','other_names','form-control','','',$errors,'',$read,'Other Names '.$re]) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','birth_place','form-control','','',$errors,'',$read,'Birth Place']) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','old_member_id','form-control','','',$errors,'',$read,'Old MemberID']) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','new_member_id','form-control','','',$errors,'','true','New MemberID']) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','date_of_birth','form-control','dated','',$errors,'',$read,'Date of Birth '.$df]) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['nationality_id', 'false','' ,"form-control","",DBSELOPTION::get_all_countries(),$errors,$read,'Nationality '.$re,null])!!}

                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['title_id', 'false','' ,"form-control","",DBSELOPTION::get_all_titles(),$errors,$read,'Title '.$re,null])!!}

                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['hometown_id', 'false','hometown' ,"form-control other_specify","",DBSELOPTION::get_all_hometowns() + ['false'=>'Other Specify'],$errors,$read,'Hometown '.$re,null])!!}

                                                <div id="hometown_show" style="display: {{(old('hometown_id')=='false'?  'block;':'none;')}}">
                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','hometown_others','form-control','','',$errors,'Specify Hometown',$read,'']) !!}
                                                </div>

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','address','form-control','','',$errors,'',$read,'Address '.$re]) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','house_number','form-control','','',$errors,'',$read,'House Number '.$re]) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','street_name','form-control','','',$errors,'',$read,'Street Name']) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['locality_id', 'false','locality' ,"form-control other_specify","",DBSELOPTION::get_all_localities()+ ['false'=>'Other Specify'],$errors,$read,'Locality '.$re,null])!!}

                                                <div id="locality_show" style="display: {{(old('locality_id')=='false'?  'block;':'none;')}}">
                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','personal_locality_others','form-control','','',$errors,'Specify Locality',$read,'']) !!}
                                                </div>
                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['gender_id', 'false','' ,"form-control","",DBSELOPTION::get_all_genders(),$errors,$read,'Gender '.$re,null])!!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','phone_numbers','form-control','','',$errors,'',$read,'Phone Number '.$re]) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','email','form-control','','',$errors,'',$read,'Email']) !!}

                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['does_member_have_identification_id', 'false','idtype' ,"form-control other_quest","",$qoption,$errors,$read,'Does Member have Identification ID ? '.$re,null])!!}

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="idtype_show" style="display: {{(old('does_member_have_identification_id')=='2' || @$data->does_member_have_identification_id==2 ?  'block;':'none;')}}">
                                                    <p style="color: red; display: block; text-align: center;"><strong>Provide Identification Details <i class="fa fa-arrow-circle-down"></i></strong></p>
                                                    {!! HtmlEntities::get_dynamic_form_complete_select_collective(['id_type_id', 'false','id_type_id' ,"form-control","",DBSELOPTION::get_all_id_type(),$errors,$read,'Select Identification Type '.$re,null])!!}

                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','id_number','form-control','','',$errors,'',$read,'Provide ID Number '.$re,null]) !!}




                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                   echo  \App\Helpers\HTMLHelpers::create_next_member_button('Educational Details','reviews')

                                    ?>



                                </div>
                            </div>

                            <div class="product-tab-list tab-pane fade" id="reviews">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    {!! HtmlEntities::get_dynamic_form_complete_select_collective(['are_you_a_literate', 'false','literate' ,"form-control other_quest","",$qoption,$errors,$read,'IS Member a literate ? '.$re,null])!!}

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="literate_show" style="display: {{(old('are_you_a_literate')=='2' || @$data->are_you_a_literate==2 ?  'block;':'none;')}}">
                                                        <p style="color: red; display: block; text-align: center;"><strong>Provide Educational Details <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                        {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','school_name','form-control','','',$errors,'',$read,'Last School Attended ',(!empty($data->Education)?$data->Education->school_name:null)]) !!}

                                                        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['qualification_id', 'false','qualification' ,"form-control other_specify","",DBSELOPTION::get_all_qualification() + ['false'=>'Other Specify'],$errors,$read,'Qualification '.$re,(!empty($data->Education)?$data->Education->qualification_id:null)])!!}

                                                        <div id="qualification_show" style="display:{{(old('qualification_id')=='false'?  'block;':'none;')}}">
                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','qualification_others','form-control','','',$errors,'Specify Profession',$read,'']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    echo  \App\Helpers\HTMLHelpers::create_next_member_button('Employment Details','INFORMATION')

                                    ?>
                                </div>
                            </div>



                            <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="devit-card-custom">
                                                        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['profession_id', 'false','profession' ,"form-control other_specify","",DBSELOPTION::get_all_profession() + ['false'=>'Other Specify'],$errors,$read,'Profession '.$re,null])!!}

                                                        <div id="profession_show" style="display: {{(old('profession_id')=='false'?  'block;':'none;')}}">
                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','profession_others','form-control','','',$errors,'Specify Profession',$read,'']) !!}
                                                        </div>
                                                        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['are_you_employed', 'false','employment' ,"form-control other_quest","",$qoption,$errors,$read,'IS Member Employed ? '.$re,null])!!}

                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="employment_show" style="display: {{(old('are_you_employed')=='2' || @$data->are_you_employed==2 ?  'block;':'none;')}}">
                                                            <p style="color: red; display: block; text-align: center;"><strong>Provide Employment Details <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','employer_name','form-control','','',$errors,'',$read,'Employer Name '.$re,(!empty($data->Employment)?$data->Employment->name:null)]) !!}

                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','employer_phone_number','form-control','','',$errors,'',$read,'Employer Phone Number '.$re,(!empty($data->Employment)?$data->Employment->phone_number:null)]) !!}

                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','employer_address','form-control','','',$errors,'',$read,'Employer Address '.$re,(!empty($data->Employment)?$data->Employment->address:null)]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    echo  \App\Helpers\HTMLHelpers::create_next_member_button('Family Details','family');
                                    ?>
                                </div>
                            </div>






                            <div class="product-tab-list tab-pane fade" id="family">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="devit-card-custom">
                                                        <fieldset style="border: 1px solid #cce5ff;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 70px; padding: 7px; border-radius: 10px 10px 0px 0px;">CHILDREN</legend>
                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['does_member_have_kids', 'false','child' ,"form-control other_quest","",$qoption,$errors,$read,'Does Member Have Kids ? '.$re,(!empty($data)?$data->does_member_have_kids:null)])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="child_show" style="display: {{(old('does_member_have_kids')=='2' || @$data->does_member_have_kids==2 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide Children Details <i class="fa fa-arrow-circle-down"></i></strong></p>
                                                                <p style="text-align:center;">{!! HtmlEntities::get_dynamic_form_type_button(['button','btn btn-primary add_fields','Add More','fdd'])!!}</p>

                                                                <div class="col-md-12">
                                                                    <legend style="font-size: 14px; background-color:#555;color: white; max-width: 70px; padding: 7px; border-radius: 10px 10px 0px 0px;">CHILD 1</legend>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">

                                                                        {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','child_name[]','form-control','','',$errors,'',$read,'Child Name '.$re,(!empty($data->kids[0])?@$data->kids[0]->name:old('child_name')[0])]) !!}

                                                                        {!! HtmlEntities::get_dynamic_form_complete_select_c4_case(['child_relationship_id[]', 'false','' ,"form-control","",DBSELOPTION::get_dynamic_relationship(1,[15,16]),$errors,$read,'Relationship Type '.$re,(!empty($data->kids[0])?$data->kids[0]->relationship_id:old('child_relationship_id')[0])])!!}

                                                                        {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['number','child_church_id[]','form-control','','',$errors,'',$read,'Church ID IF Applicable',(!empty($data->kids[0])?$data->kids[0]->church_id:old('child_church_id')[0])]) !!}

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="wrapper_family">
                                                                <?php

                                                                $arr = '';
                                                                $child_na = old('child_name');
                                                                $var = (isset($data->kids)?@$data->kids:old('child_name'));
                                                                $kiddy = (!empty($data)?@$data->kids:[]);
                                                                (!empty($data->kids)?$arr = @$data->kids:$arr = old('child_relationship_id'))
                                                                ?>
                                                                @if(isset($child_na) && count($child_na) > 1 || isset($data->kids) && sizeof($kiddy) > 1)
                                                                    <?php
                                                                    $to_ =count($var) - 1;
                                                                        //dd($arr);
                                                                    unset($arr[0]);


                                                                    ?>
                                                                    <script>
                                                                        var d ="{{$to_}}";
                                                                    </script>
                                                                    @foreach($arr as $key=>$value)


                                                                        <div class="row" style="margin-bottom:20px;" id="record_{{$key}}"> <div class="col-md-12 ">
                                                                                <legend style="font-size: 14px; background-color:#555;color: white; max-width: 70px; padding: 7px; border-radius: 10px 10px 0px 0px;">CHILD {{$key + 1}}</legend>
                                                                                <p ><a class="btn btn-danger btn-user remove_child" href="javascript:void(0);" role="button" id="{{$key}}" >REMOVE CHILD {{$key + 1}} </a></p></div>

                                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','child_name[]','form-control','','',$errors,'',$read,'Child Name',(!empty($data)?$data->kids[$key]->name:old('child_name')[$key])]) !!}

                                                                            {!! HtmlEntities::get_dynamic_form_complete_select_c4_case(['child_relationship_id[]', 'false','' ,"form-control","",DBSELOPTION::get_dynamic_relationship(1,[15,16]),$errors,$read,'Relationship Type',(!empty($data)?$data->kids[$key]->relationship_id:old('child_relationship_id')[$key])])!!}

                                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['number','child_church_id[]','form-control','','',$errors,'',$read,'Church ID IF Applicable',(!empty($data)?$data->kids[$key]->church_id:old('child_church_id')[$key])]) !!}

                                                                        </div>



                                                                    @endforeach

                                                                @else
                                                                    <script>
                                                                        var d =0;

                                                                    </script>
                                                                @endif


                                                            </div>
                                                        </fieldset>

                                                    </div>



                                                    <div class="devit-card-custom">
                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 140px; padding: 7px; border-radius: 10px 10px 0px 0px;">BLOOD RELATION</legend>

                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['does_member_have_relation_in_accra', 'false','relation' ,"form-control other_quest","",$qoption,$errors,$read,'Does Member Have Relation in Accra ? '.$re,(!empty($data)?null:null)])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="relation_show" style="display: {{(old('does_member_have_relation_in_accra')=='2' ||  @$data->does_member_have_relation_in_accra==2 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide relation in Accra Details <i class="fa fa-arrow-circle-down"></i></strong></p>
                                                                <p style="text-align:center;">{!! HtmlEntities::get_dynamic_form_type_button(['button','btn btn-primary add_field_relation','Add More','fdd'])!!}</p>

                                                                <div class="col-md-12 ">
                                                                    <legend style="font-size: 14px; background-color:#555;color: white; max-width: 100px; padding: 7px; border-radius: 10px 10px 0px 0px;">RELATION 1</legend>
                                                                </div>

                                                                <section id="sec_relation">
                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_name[]','form-control','','',$errors,'',$read,'Relation Name '.$re,(!empty(@$data->relatives)?@$data->relatives[0]->name:old('relation_name')[0])]) !!}
                                                                    {!! HtmlEntities::get_dynamic_form_complete_select_c4_case(['relation_relationship_id[]', 'false','' ,"form-control","",DBSELOPTION::get_dynamic_relationship(0,[22,15,16]),$errors,$read,'Relationship Type '.$re,(!empty(@$data->relatives)?@$data->relatives[0]->relationship_id:old('relation_relationship_id')[0])])!!}

                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_address[]','form-control','','',$errors,'',$read,'Relation Address ',(!empty(@$data->relatives)?@$data->relatives[0]->address:old('relation_address')[0])]) !!}

                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_phone_number[]','form-control','','',$errors,'',$read,'Relation Phone Number '.$re,(!empty(@$data->relatives)?@$data->relatives[0]->phone_number:old('relation_phone_number')[0])]) !!}

                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_church_id[]','form-control','','',$errors,'',$read,'Relation ChurchID if Applicable ',(!empty(@$data->relatives)?@$data->relatives[0]->church_id:old('relation_church_id')[0])]) !!}

                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_office_name[]','form-control','','',$errors,'',$read,'Relation Office ',(!empty(@$data->relatives)?@$data->relatives[0]->office:old('relation_office_name')[0])]) !!}

                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_residence[]','form-control','','',$errors,'',$read,'Relation Residence ',(!empty(@$data->relatives)?@$data->relatives[0]->residence:old('relation_residence')[0])]) !!}

                                                                </section>
                                                                {!! HtmlEntities::get_dynamic_form_complete_select_c4_cases(['relation_locality_id[]', 'false','re_locality' ,"form-control other_specify idm","",DBSELOPTION::get_all_localities1(),$errors,$read,'Relation Locality '.$re,(!empty(@$data->relatives)?@$data->relatives[0]->locality_id:old('relation_locality_id')[0])])!!}

                                                                <div id="re_locality_show" style="display: {{(old('relation_locality_id')[0]=='false'?  'block;':'none;')}}">
                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_locality_others[]','form-control','','',$errors,'Specify Locality ',$read,'',(!empty($data)?null:old('relation_locality_others')[0])]) !!}
                                                                </div>
                                                                <div class="wrapper_relation">
                                                                    <?php

                                                                    $ar = '';
                                                                    $child_na = old('relation_name');
                                                                    $var = (isset($data)?@$data->relatives:old('relation_name'));
                                                                    $relative = (!empty($data)?@$data->relatives:[]);
                                                                    (!empty($data)?$ar = @$data->relatives:$ar = old('relation_name'));

                                                                    ?>

                                                                    @if(isset($child_na) && count($child_na) > 1 || isset($data) && sizeof($relative) > 1)

                                                                        <?php
                                                                        $t_ =count($var) - 1;
                                                                        unset($ar[0]);

                                                                        ?>
                                                                        <script>
                                                                            var u ="<?php echo  $t_;?>";
                                                                        </script>
                                                                        @foreach($ar as $key=>$value)


                                                                            <div class="row" style="margin-bottom:20px;" id="relation_{{$key}}"> <div class="col-md-12 "><legend style="font-size: 14px; background-color:#555;color: white; max-width: 100px; padding: 7px; border-radius: 10px 10px 0px 0px;">RELATION <?PHP echo  $key + 1; ?> </legend>
                                                                                    <p ><a class="btn btn-danger btn-user remove_relation" href="javascript:void(0);" role="button" id="{{$key}}" >REMOVE RELATION <?PHP echo $key + 1; ?> </a></p>
                                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_name[]','form-control','','',$errors,'',$read,'Relation Name',(!empty($data)?$data->relatives[$key]->name:old('relation_name')[$key])]) !!}
                                                                                    {!! HtmlEntities::get_dynamic_form_complete_select_c4_case(['relation_relationship_id[]', 'false','' ,"form-control","",DBSELOPTION::get_dynamic_relationship(0,[22,15,16]),$errors,$read,'Relationship Type',(!empty(@$data->relatives)?@$data->relatives[$key]->relationship_id:old('relation_relationship_id')[$key])])!!}

                                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_address[]','form-control','','',$errors,'',$read,'Relation Address',(!empty(@$data->relatives)?@$data->relatives[$key]->address:old('relation_address')[$key])]) !!}

                                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_phone_number[]','form-control','','',$errors,'',$read,'Relation Phone Number',(!empty(@$data->relatives)?@$data->relatives[$key]->phone_number:old('relation_phone_number')[$key])]) !!}

                                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_church_id[]','form-control','','',$errors,'',$read,'Relation ChurchID if Applicable',(!empty(@$data->relatives)?@$data->relatives[$key]->church_id:old('relation_church_id')[$key])]) !!}

                                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_office_name[]','form-control','','',$errors,'',$read,'Relation Office',(!empty(@$data->relatives)?@$data->relatives[$key]->office:old('relation_office_name')[$key])]) !!}

                                                                                    {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_residence[]','form-control','','',$errors,'',$read,'Relation Residence',(!empty(@$data->relatives)?@$data->relatives[$key]->residence:old('relation_residence')[$key])]) !!}

                                                                                    {!! HtmlEntities::get_dynamic_form_complete_select_c4_cases(['relation_locality_id[]', 'false','re_locality_'.$key ,"form-control other_specify idm","",DBSELOPTION::get_all_localities1(),$errors,$read,'Relation Locality',(!empty(@$data->relatives)?@$data->relatives[$key]->locality_id:old('relation_locality_id')[$key])])!!}

                                                                                    <div id="re_locality_{{$key}}_show" style="display: {{(old('relation_locality_id')[$key]=='false'?  'block;':'none;')}}">
                                                                                        {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','relation_locality_others[]','form-control','','',$errors,'Specify Locality ',$read,'',(!empty($data)?null:old('relation_locality_others')[$key])]) !!}
                                                                                    </div>
                                                                                </div>





                                                                                @endforeach

                                                                                @else
                                                                                    <script>
                                                                                        var u =0;

                                                                                    </script>
                                                                                @endif


                                                                            </div>
                                                                </div>
                                                        </fieldset>


                                                    </div>




                                                    <div class="devit-card-custom" style="margin-top: 40px;">
                                                        <fieldset style="border: 1px solid #cce5ff;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: fit-content; padding: 7px; border-radius: 10px 10px 0px 0px;">EMERGENCY CONTACT</legend>
                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['does_member_have_any_emergency_contact', 'false','emergency' ,"form-control other_quest","",$qoption,$errors,$read,'Does Member have any emergency contact ? '.$re,(!empty($data)?null:null)])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="emergency_show" style="display: {{(old('does_member_have_any_emergency_contact')=='2' || @$data->does_member_have_any_emergency_contact==2 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide Emergency Contact Details <i class="fa fa-arrow-circle-down"></i></strong></p>
                                                                <p style="text-align:center;">{!! HtmlEntities::get_dynamic_form_type_button(['button','btn btn-primary add_field_emergency','Add More'])!!}</p>

                                                                <div class="col-md-12">
                                                                    <legend style="font-size: 14px; background-color:#555;color: white; max-width:fit-content; padding: 7px; border-radius: 10px 10px 0px 0px;">CONTACT 1</legend>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">

                                                                        {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','emergency_contact_name[]','form-control','','',$errors,'',$read,'Emergency Contact Name '.$re,(!empty($data->Emergency[0])?@$data->Emergency[0]->name:old('emergency_contact_name')[0])]) !!}


                                                                        {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['number','emergency_contact_number[]','form-control','','',$errors,'',$read,'Emergency Contact Phone Number '.$re,(!empty($data->Emergency[0])?$data->Emergency[0]->phone_number:old('emergency_contact_number')[0])]) !!}

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="wrapper_emergency">
                                                                <?php

                                                                $arr = '';
                                                                $em_na = old('emergency_contact_name');
                                                                $var = (isset($data->Emergency)?@$data->Emergency:old('emergency_contact_name'));
                                                                $Emer = (!empty($data)?@$data->Emergency:[]);
                                                                (!empty($data->Emergency)?$arr = @$data->Emergency:$arr = old('emergency_contact_name'))
                                                                ?>
                                                                @if(isset($em_na) && count($em_na) > 1 || isset($data->Emergency) && sizeof($Emer) > 1)
                                                                    <?php
                                                                    $to_ =count($var) - 1;
                                                                    unset($arr[0]);

                                                                    ?>
                                                                    <script>
                                                                        var e ="{{$to_}}";
                                                                    </script>
                                                                    @foreach($arr as $key=>$value)


                                                                        <div class="row" style="margin-bottom:20px;" id="emergency_{{$key}}"> <div class="col-md-12 ">
                                                                                <legend style="font-size: 14px; background-color:#555;color: white; max-width:fit-content; padding: 7px; border-radius: 10px 10px 0px 0px;">EMERGENCY {{$key + 1}}</legend>
                                                                                <p ><a class="btn btn-danger btn-user remove_emergency" href="javascript:void(0);" role="button" id="{{$key}}" >EMERGENCY CONTACT {{$key + 1}} </a></p></div>

                                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['text','emergency_contact_name[]','form-control','','',$errors,'',$read,'Emergency Contact Name',(!empty($data)?$data->Emergency[$key]->name:old('emergency_contact_name')[$key])]) !!}


                                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_c4_input(['number','emergency_contact_number[]','form-control','','',$errors,'',$read,'Emergency Contact Phone Number',(!empty($data)?$data->Emergency[$key]->phone_number:old('emergency_contact_number')[$key])]) !!}

                                                                        </div>



                                                                    @endforeach

                                                                @else
                                                                    <script>
                                                                        var e =0;

                                                                    </script>
                                                                @endif


                                                            </div>
                                                        </fieldset>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    echo  \App\Helpers\HTMLHelpers::create_next_member_button('Marital Details','marital');

                                    ?>
                                </div>
                            </div>





                            <div class="product-tab-list tab-pane fade" id="marital">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="devit-card-custom">
                                                        {!! HtmlEntities::get_dynamic_form_complete_select_collective(['marital_status_id', 'false','marital_status' ,"form-control other_quest","marital_status",DBSELOPTION::get_all_marital_status(),$errors,$read,'Marital Status '.$re,(!empty($data)?@$data->marital_status_id:null)])!!}

                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="marital_status_show" style="display: {{(old('marital_status_id')=='2' || @$data->spouse[0]->marital_status_id==2 ?  'block;':'none;')}}">
                                                            <p style="color: red; display: block; text-align: center;"><strong>Provide  Details of Spouse<i class="fa fa-arrow-circle-down"></i></strong></p>

                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','spouse_name','form-control','','',$errors,'',$read,'Spouse Name '.$re,(!empty($data->spouse[0])?$data->spouse[0]->name:null)]) !!}


                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','spouse_phone_number','form-control','','',$errors,'',$read,'Spouse Phone Number '.$re,(!empty($data->spouse[0])?$data->spouse[0]->phone_number:null)]) !!}

                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['marriage_type_id', 'false','' ,"form-control","",DBSELOPTION::get_all_marriage_types(),$errors,$read,'Marriage Type '.$re,(!empty($data->spouse[0])?$data->spouse[0]->marriage_type_id:null)])!!}

                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','marriage_place','form-control','','',$errors,'',$read,'Marriage Place '.$re,(!empty($data->spouse[0])?$data->spouse[0]->marriage_place:null)]) !!}

                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','marriage_date','form-control','dated1','',$errors,'',$read,'Marriage Date '.$re . $df,(!empty($data->spouse[0])?$data->spouse[0]->date:null)]) !!}

                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','marriage_rev_minister','form-control','','',$errors,'',$read,'Rev. Minister ',(!empty($data->spouse[0])?$data->spouse[0]->rev_minister:null)]) !!}
                                                            {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','spouse_church_id','form-control','','',$errors,'',$read,'Spouse ChurchID if Applicable',(!empty($data->spouse[0])?$data->spouse[0]->church_id:null)]) !!}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    echo  \App\Helpers\HTMLHelpers::create_next_member_button('Religious Details','religion');
                                    ?>
                                </div>
                            </div>





                            <div class="product-tab-list tab-pane fade" id="religion">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="devit-card-custom">
                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width:fit-content; padding: 7px; border-radius: 10px 10px 0px 0px;">WELFARE PAYMENT CONFIRMATION</legend>

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                {!! HtmlEntities::get_dynamic_form_complete_select_collective(['does_member_want_to_join_welfare', 'false','welfare' ,"form-control other_quest","",$qoption,$errors,$read,'Does Member want to Join Welfare ? '.$re,null])!!}

                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="welfare_show" style="display: {{(old('does_member_want_to_join_welfare')=='2' || @$data->religious->does_member_want_to_join_welfare==2 ?  'block;':'none;')}}">
                                                                    <p style="color: red; display: block; text-align: center;"><strong>Provide Welfare Payment Start Date <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','date_joined_welfare','form-control','dated6','',$errors,'',$read,'Date Joined Welfare ' .$df .$re,null]) !!}
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 150px; padding: 7px; border-radius: 10px 10px 0px 0px;">BAPTISM DETAILS</legend>
                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['are_you_baptised', 'false','baptism' ,"form-control  other_quest","",$qoption,$errors,$read,'Are you baptised ? '.$re,(!empty($data->religious)?$data->religious->are_you_baptised:null)])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="baptism_show" style="display: {{(old('are_you_baptised')=='2' || @$data->religious->are_you_baptised==2 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide Baptism Details <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','baptism_place','form-control','','',$errors,'',$read,'Baptism Place '.$re,(!empty($data->religious)?$data->religious->baptism_place:null)]) !!}

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','baptism_date','form-control','dated2','',$errors,'',$read,'Baptism Date'.$df,(!empty($data->religious)?$data->religious->baptism_date:null)]) !!}

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','baptism_rev_minister','form-control','','',$errors,'',$read,'Baptism Rev. Minister ',(!empty($data->religious)?$data->religious->baptism_rev_minister:null)]) !!}
                                                            </div>
                                                        </fieldset>
                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 190px; padding: 7px; border-radius: 10px 10px 0px 0px;">CONFIRMATION DETAILS</legend>
                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['have_you_been_confirm', 'false','confirmation' ,"form-control  other_quest","",$qoption,$errors,$read,'Have you been Confirmed ? '.$re,(!empty($data->religious)?$data->religious->have_you_been_confirm:null)])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="confirmation_show" style="display: {{(old('have_you_been_confirm')=='2' || @$data->religious->have_you_been_confirm==2 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide Confirmation Details <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','confirmation_place','form-control','','',$errors,'',$read,'Confirmation Place '.$re,(!empty($data->religious)?$data->religious->confirmation_place:null)]) !!}

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','confirmation_date','form-control','dated3','',$errors,'',$read,'Confirmation Date  '.$df,(!empty($data->religious)?$data->religious->confirmation_date:null)]) !!}

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','confirmation_rev_minister','form-control','','',$errors,'',$read,'Confirmation Rev. Minister ',(!empty($data->religious)?$data->religious->confirmation_rev_minister:null)]) !!}
                                                            </div>
                                                        </fieldset>

                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 190px; padding: 7px; border-radius: 10px 10px 0px 0px;">COMMUNICANT DETAILS</legend>
                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['are_you_a_communicant', 'false','communicant' ,"form-control other_quest_no","",$qoption,$errors,$read,'Are you a Communicant ? '.$re,(!empty($data->religious)?$data->religious->are_you_a_communicant:null)])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="communicant_show" style="display: {{(old('are_you_a_communicant')=='1' || @$data->religious->are_you_a_communicant==1 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide Reason why  <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_textarea(['','reason_why_not_a_communicant','form-control','','',$errors,'',$read,'Reason why not a communicant '.$re,(!empty($data->religious)?$data->religious->reason_why_not_a_communicant:null)]) !!}

                                                            </div>
                                                        </fieldset>

                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 148px; padding: 7px; border-radius: 10px 10px 0px 0px;">CONVERT DETAILS</legend>
                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['are_you_a_convert', 'false','convert' ,"form-control other_quest","",$qoption,$errors,$read,'Are you a Convert ? '.$re,(!empty($data->religious)?$data->religious->are_you_a_convert:null)])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="convert_show" style="display: {{(old('are_you_a_convert')=='2' || @$data->religious->are_you_a_convert== 2 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide Convert Details <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','prev_religious_denomination','form-control','','',$errors,'',$read,'Prev Religious Denomination '.$re,(!empty($data->religious)?$data->religious->prev_religious_denomination:null)]) !!}

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','date_converted','form-control','dated4','',$errors,'',$read,'Date Converted  '.$df.$re,(!empty($data->religious)?$data->religious->date_converted:null)]) !!}

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['text','convert_rev_minister','form-control','','',$errors,'',$read,'Convert Rev. Minister '.$re,(!empty($data->religious)?$data->religious->convert_rev_minister:null)]) !!}
                                                            </div>
                                                        </fieldset>



                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: fit-content; padding: 7px; border-radius: 10px 10px 0px 0px;">CHURCH GROUPS</legend>
                                                            {!! HtmlEntities::get_dynamic_form_complete_select_collective(['is_member_part_of_church_groups', 'false','membercgroupp' ,"form-control other_quest","",$qoption,$errors,$read,'IS Member interested/Belong to any group ? '.$re,null])!!}

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="membercgroupp_show" style="display: {{(old('is_member_part_of_church_groups')=='2' || @$data->is_member_part_of_church_groups== 2 ?  'block;':'none;')}}">
                                                                <p style="color: red; display: block; text-align: center;"><strong>Provide Church Group belonging to Details <i class="fa fa-arrow-circle-down"></i></strong></p>

                                                                {!! Groupdata::get_all_in_event_groups((!empty($data->groups)? Groupdata::get_all_member_belong_group($data->id):(!empty(old('churchgroups')[0])?old('churchgroups'):array()))) !!}

                                                            </div>
                                                        </fieldset>






                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 190px; padding: 7px; border-radius: 10px 10px 0px 0px;">DATE JOINED CHURCH</legend>

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                {!! HtmlEntities::get_dynamic_form_complete_collective_input(['date','date_joined','form-control','dated5','',$errors,'',$read,'Date Joined Church  '.$df.$re,(!empty($data->religious)?$data->religious->date_joined:null)]) !!}

                                                            </div>
                                                        </fieldset>

                                                        <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                                                            <legend style="font-size: 14px; background-color:#076df1d4;color: white; max-width: 150px; padding: 7px; border-radius: 10px 10px 0px 0px;">PROFILE PICTURE</legend>

                                                            <div class="form-group">
                                                                {!!Form::label('','Member Profile Picture:', array('class'=>'col-md-4 control-label'))!!}

                                                                <div class="col-md-6">
                                                                    <input type="file" onChange="showImage(this);" name="img_path" id="0" accept="image/*" class="identification_picture"/>
                                                                    <span>

                        <img src="{{asset('uploads/profiles/'.@$data->img_path)}}" style="border:solid 1px #FF0; height:120px; width:200px;" id="imagepreview" />

                                                                </div>
                                                            </div>
                                                        </fieldset>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])

                                <?php
                                echo  \App\Helpers\HTMLHelpers::create_next_member_button('Marital Details','marital');
                                ?>
                                <div style="display: none;">

                                    {!! HtmlEntities::get_dynamic_form_complete_select_c4_case(['', 'false','cloned' ,"form-control","",DBSELOPTION::get_dynamic_relationship(1,[15,16]),$errors,$read,'Relationship Type',null])!!}



                                </div>
                            </div>

                            <script type="text/javascript">
                                var x = 1 + parseInt(d) ;
                                var r = 1 +  parseInt(u);
                                var em = 1 +  parseInt(e);
                            </script>
