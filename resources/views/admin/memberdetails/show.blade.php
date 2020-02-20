

            <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: -60px;">
            <div class="profile-info-inner">
                <div class="profile-img" style="text-align: center;"  align="center" >
                    <img src="{{asset('uploads/profiles/'.(!empty($data->img_path)?$data->img_path:'defpic.jpg'))}}" style="max-width: 200px; max-height: 220px; border-radius: 50%;" />
                </div>
                <div class="profile-details-hr">
                    <?php echo  HtmlEntities::show_divs_html(['Full Name'=>$data->surname.' '.$data->other_names,'Church ID'=>$data->new_member_id]).

                        HtmlEntities::show_divs_html(['Phone #'=>$data->phone_numbers,'Email'=>$data->email]).

                        HtmlEntities::show_divs_html(['Country '=>$data->country->name,'Hometown'=>$data->hometown->name]).

                        HtmlEntities::show_divs_html(['Birth Place'=>$data->birth_place,'Street Name'=>$data->street_name]).

                        HtmlEntities::show_divs_html(['Gender'=>$data->gender->name,'Locality'=>$data->locality->name]).
                        HtmlEntities::show_divs_html(['Identification Type'=>(isset($data->idtype)?$data->idtype->name:'N/A'),'Identification #'=>$data->id_number]).

                        HtmlEntities::show_divs_html(['Address'=>$data->address]);

                    ?>



                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div id="myTabContent" class="tab-content custom-product-edit">
                    <div class="product-tab-list tab-pane fade active in" id="description">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                    <div class="chat-discussion" style="height: auto">

                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/education.png')}}">
                                            </div>
                                            <p> <b> IS Member Literate ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->are_you_a_literate);?></span></p>

                                            <div class="message">
                                                <a class="message-author" href="#"> Education Details </a>
                                                <HR/>

                                                <span class="message-content">
                                                    <?php echo

                                                        HtmlEntities::show_divs_html(['School Name'=>(isset($data->Education)?$data->Education->school_name:''),'Qualification'=>(isset($data->Education)?$data->Education->qualification->name:'')]);

                                                    ?>

                                                </span>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab-list tab-pane fade" id="INFORMATION">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                    <div class="chat-discussion" style="height: auto">

                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/employ.jpg')}}">
                                            </div>
                                            <p> <b> IS Member Employed ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->are_you_employed);?></span></p>

                                            @if($data->are_you_employed==2)
                                            <div class="message">
                                                <a class="message-author" href="#"> Employment Details </a>
                                                <HR/>

                                                <span class="message-content">

                                                    <?php echo

                                                    HtmlEntities::show_divs_html(['Employer Name'=>$data->Employment->name,'Employer Phone Number'=>$data->Employment->phone_number]).
                                                    HtmlEntities::show_divs_html(['Employer Address'=>$data->Employment->address]);

                                                    ?>
                                                </span>
                                            </div>
                                                @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="product-tab-list tab-pane fade" id="family">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                    <div class="row">
                                        <div class="chat-discussion" style="height: auto">
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                    <img class="message-avatar" src="{{asset('general/img/icons/kids.png')}}">
                                                </div>
                                                <p> <b> Does member have Children ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->does_member_have_kids);?></span></p>

                                                @if($data->does_member_have_kids==2)
                                                <div class="message">
                                                    <a class="message-author" href="#"> Children Details </a>
                                                    <span  class="pull-right badge badge-success">Total kids: {{count($data->kids)}}</span>
                                                    <HR/>

                                                    <span class="message-content">
                                                    <?php

                                                        foreach($data->kids as $key=>$kid){

                                                            $key = $key + 1;
                                                            echo

                                                                '<p><span class="badge badge-info">CHILD : '.$key.'</span></p>'.

                                                            HtmlEntities::show_divs_html(['Child Name'=>$kid->name,'Relationship Type'=>$kid->relationship->name]).
                                                            HtmlEntities::show_divs_html(['Church ID'=>(!empty($kid->church_id)?$kid->church_id:'N/A')]);

                                                            }

                                                        ?>
                                                </span>
                                                </div>
                                                    @endif

                                            </div>
                                        </div>



                                        <div class="chat-discussion" style="height: auto; margin-top: 100px;">
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                    <img class="message-avatar" src="{{asset('general/img/icons/relative.jpg')}}">
                                                </div>
                                                <p> <b> Does member have Relation in Accra ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->does_member_have_relation_in_accra);?></span></p>

                                                @if($data->does_member_have_relation_in_accra==2)
                                                <div class="message">
                                                    <a class="message-author" href="#"> Relatives Details </a>
                                                    <span  class="pull-right badge badge-success">Total Relatives: {{count($data->relatives)}}</span>
                                                    <HR/>

                                                    <span class="message-content">
                                                    <?php

                                                        foreach($data->relatives as $key=>$rel){

                                                            $key = $key + 1;
                                                            echo

                                                                '<p><span class="badge badge-info">RELATIVE : '.$key.'</span></p>'.

                                                                HtmlEntities::show_divs_html(['Name'=>$rel->name,'Relationship Type'=>$rel->relationship->name]).
                                                                HtmlEntities::show_divs_html(['Address'=>$rel->address,'Phone #'=>$rel->phone_number]).
                                                                HtmlEntities::show_divs_html(['Office'=>$rel->offcie,'Locality'=>$rel->locality->name]).
                                                                HtmlEntities::show_divs_html(['CHURCH ID'=>(!empty($rel->church_id)?$rel->church_id:'N/A')]);

                                                        }

                                                        ?>
                                                </span>
                                                </div>
                                                    @endif

                                            </div>



                                        </div>

                                        <div class="chat-discussion" style="height: auto; margin-top: 100px;">
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                    <img class="message-avatar" src="{{asset('general/img/icons/relative.jpg')}}">
                                                </div>
                                                <p> <b> Does member have Emergency Contact ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->does_member_have_any_emergency_contact);?></span></p>

                                                @if($data->does_member_have_any_emergency_contact==2)
                                                    <div class="message">
                                                        <a class="message-author" href="#"> Emergency Details </a>
                                                        <span  class="pull-right badge badge-success">Total Contact: {{count($data->Emergency)}}</span>
                                                        <HR/>

                                                        <span class="message-content">
                                                    <?php

                                                            foreach($data->Emergency as $key=>$rel){

                                                                $key = $key + 1;
                                                                echo

                                                                    '<p><span class="badge badge-info">Contact : '.$key.'</span></p>'.

                                                                    HtmlEntities::show_divs_html(['Name'=>$rel->name,'Phone #'=>$rel->phone_number]);



                                                            }

                                                            ?>
                                                </span>
                                                    </div>
                                                @endif

                                            </div>



                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="product-tab-list tab-pane fade" id="marital">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                    <div class="chat-discussion" style="height: auto">

                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/married.png')}}">
                                            </div>
                                            <p> <b> IS Member Married ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->marital_status_id);?></span></p>

                                           @if($data->marital_status_id==2)
                                            <div class="message">
                                                <a class="message-author" href="#"> Marital Details </a>
                                                <HR/>

                                                <span class="message-content">
                                                    <?php echo

                                                    HtmlEntities::show_divs_html(['Name'=>$data->spouse[0]->name,'Phone #'=>$data->spouse[0]->phone_number]).
                                                    HtmlEntities::show_divs_html(['Marriage Type'=>$data->spouse[0]->marriagetype->name,'Marriage Place'=>$data->spouse[0]->marriage_place]).
                                                    HtmlEntities::show_divs_html(['Marriage Date'=>$data->spouse[0]->date,'Rev. Minister'=>$data->spouse[0]->rev_minister]).
                                                    HtmlEntities::show_divs_html(['CHURCH ID'=>$data->spouse[0]->church_id])

                                                    ?>

                                                </span>

                                            </div>
                                               @endif
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="product-tab-list tab-pane fade" id="religion">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">



                                    <div class="chat-discussion" style="height: auto">
                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/baptised.png')}}">
                                            </div>
                                            <p> <b> Is Member part of Welfare ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->does_member_want_to_join_welfare);?></span></p>

                                            @if($data->does_member_want_to_join_welfare==2)
                                                <div class="message">
                                                    <a class="message-author" href="#"> Welfare Details </a>
                                                    <HR/>

                                                    <span class="message-content">
                                                    <?php echo

                                                            HtmlEntities::show_divs_html(['Date joined Welfare'=>$data->date_joined_welfare])

                                                        ?>

                                                </span>

                                                </div>
                                        </div>
                                    </div>
                                    @endif


                                    <div class="chat-discussion" style="height: auto">
                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/baptised.png')}}">
                                            </div>
                                            <p> <b> Are you Baptised ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->religious->are_you_baptised);?></span></p>

                                            @if($data->religious->are_you_baptised==2)
                                            <div class="message">
                                                <a class="message-author" href="#"> Baptism Details </a>
                                                <HR/>

                                                <span class="message-content">
                                                    <?php echo

                                                        HtmlEntities::show_divs_html(['Baptism Place'=>$data->religious->baptism_place,'Baptism Date'=>$data->religious->baptism_date]).


                                                        HtmlEntities::show_divs_html(['Baptism Rev. Minister'=>$data->religious->baptism_rev_minister])

                                                    ?>

                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                    <div class="chat-discussion" style="height: auto">


                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/baptised.png')}}">
                                            </div>
                                            <p> <b> Are you a communicant ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->religious->are_you_a_communicant);?></span></p>

                                            @if($data->religious->are_you_a_communicant==2)
                                            <div class="message">
                                                <a class="message-author" href="#"> Comunicant Details </a>
                                                <HR/>

                                                <span class="message-content">
                                                    <?php echo

                                                        HtmlEntities::show_divs_html(['Reason why not a communicant'=>$data->religious->reason_why_not_a_communicant])

                                                    ?>

                                                </span>

                                            </div>
                                                @endif
                                        </div>
                                    </div>




                                    <div class="chat-discussion" style="height: auto">
                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/confirmed.png')}}">
                                            </div>
                                            <p> <b> Have you been Confirmed ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->religious->have_you_been_confirm);?></span></p>

                                            @if($data->religious->have_you_been_confirm==2)
                                            <div class="message">
                                                <a class="message-author" href="#"> Confirmation Details </a>
                                                <HR/>

                                                <span class="message-content">
                                                    <?php echo

                                                        HtmlEntities::show_divs_html(['Confirmation Place'=>$data->religious->confirmation_place,'Confirmation Date'=>$data->religious->confirmation_date]).

                                                        HtmlEntities::show_divs_html(['Confirmation Rev. Minister'=>$data->religious->confirmation_rev_minister])
                                                    ?>
                                                </span>

                                            </div>
                                                @endif
                                        </div>
                                    </div>




                                    <div class="chat-discussion" style="height: auto">
                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/convert.jpg')}}">
                                            </div>
                                            <p> <b> Are you a Convert ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->religious->are_you_a_convert);?></span></p>

                                            @if($data->religious->are_you_a_convert==2)
                                            <div class="message">
                                                <a class="message-author" href="#"> Convert Details </a>
                                                <HR/>

                                                <span class="message-content">
                                                    <?php echo

                                                        HtmlEntities::show_divs_html(['Prev Religious Denomination'=>$data->religious->prev_religious_denomination,'Converted Date'=>$data->religious->date_converted]).


                                                        HtmlEntities::show_divs_html(['Convert Rev. Minister'=>$data->religious->convert_rev_minister])

                                                    ?>

                                                </span>

                                            </div>
                                                @endif
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="product-tab-list tab-pane fade" id="groups">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                    <div class="chat-discussion" style="height: auto">

                                        <div class="chat-message">
                                            <div class="profile-hdtc">
                                                <img class="message-avatar" src="{{asset('general/img/icons/group.png')}}">
                                            </div>
                                            <p> <b>Does Member belong to any church Group ? </b><span style="padding-left: 50px;"><?php echo \App\Helpers\Member::get_state($data->is_member_part_of_church_groups);?></span></p>

                                            <div class="message">
                                                <a class="message-author" href="#"> Group Details </a>
                                                <span  class="pull-right badge badge-success">Total Groups: {{count($data->groups)}}</span>
                                                <HR/>

                                                <span class="message-content">
                                                    <?php

                                                    foreach($data->groups as $key=>$gro){


                                                        $keys = $key + 1;
                                                        echo

                                                            ' <span class="badge badge-info" style="margin-left: 20px; font-size: 1.0em; padding: 7px;">'.$gro->groupname->name.'</span>';


                                                    }

                                                    ?>

                                                </span>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

        </div>
            </div>

















