  $(document).ready(function () {
      //alert('ljj');
      $(window).load(function() {
          // Animate loader off screen
          $("#cover-spin").fadeOut("slow");

      });

      var max_fields = 10; //Maximum allowed input fields
      var wrapper    = $(".wrapper_family"); //Input fields wrapper
      var wrapper_r    = $(".wrapper_relation"); //Input fields wrapper
      var wrapper_emer    = $(".wrapper_emergency"); //Input fields wrapper
      var add_button = $(".add_fields"); //Add button class or ID
      var add_button_relation = $(".add_field_relation");
      var add_button_emer = $(".add_field_emergency");
      var intRegex = /^\d+$/;
      var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

      var data_child = $("#cloned");
      $(add_button).click(function(e){


         //Initial input field is set to 1
          e.preventDefault();
          //Check maximum allowed input fields
          if(x < max_fields){
              x++; //input field increment
              //add input field

             var data = $(data_child).html();

              $(wrapper).append('<div class="row" style="margin-bottom:20px;" id="record_' + x + '"> <div class="col-md-12 "><legend style="font-size: 14px; background-color:#555;color: white; max-width: 70px; padding: 7px; border-radius: 10px 10px 0px 0px;">CHILD ' + x + ' </legend>' +
                  '<p ><a class="btn btn-danger btn-user remove_child" href="javascript:void(0);" role="button" id="' + x +'" >REMOVE CHILD ' + x + '</a></p></div><div class="col-md-4" style="margin-bottom: 40px;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' + '<label name="Child Name" class="login2"> Child Name</label></div>' +
                  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' +
                  '<div class="form-group  "><input class="form-control form-control-user" id="" placeholder="" name="child_name[]" type="text"></div></div></div><div class="col-md-4" style="margin-bottom: 40px;"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><label name="Relationship Type" class="login2"> Relationship Type</label>\n' +
                  '                </div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' +
                  '<div class="form-group  "><select class="form-control form-control-user" style="font-size: 1.0rem;height:40px; border-radius:2px;" size="" id="" name="child_relationship_id[]">'+ data + '</select></div></div></div><div class="col-md-4" style="margin-bottom: 40px;">' +
                  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><label name="Church ID IF Applicable" class="login2"> Church ID IF Applicable</label></div>' +
                  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="form-group  "><input class="form-control form-control-user" id="" placeholder="" name="child_church_id[]" type="text"></div></div></div></div>');

          }
          else{
              alert('Oops!! Exceed Limit');
          }
      });

      $('body').on('click','.remove_child',function (e) {

          var loca ='#record_' + $(this).attr('id');

          $(loca).remove();
          x--
      })


      $(add_button_relation).click(function(e){
          e.preventDefault();
          //Check maximum allowed input fields
          if(r < max_fields){
              r++; //input field increment
              //add input field
             var  idm =$(".idm").html();
              var data = $('#sec_relation').html();

              $(wrapper_r).append('<div class="row" style="margin-bottom:20px;" id="relation_' + r + '"> <div class="col-md-12 "><legend style="font-size: 14px; background-color:#555;color: white; max-width: 100px; padding: 7px; border-radius: 10px 10px 0px 0px;">RELATION ' + r + ' </legend>' +
                  '<p ><a class="btn btn-danger btn-user remove_relation" href="javascript:void(0);" role="button" id="' + r +'" >REMOVE RELATION ' + r + '</a></p></div>' + data + '<div class="col-md-4" style="margin-bottom: 40px;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><label name="Relation Locality" class="login2"> Relation Locality</label></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">\n' +
                  '  <div class="form-group  "><select class="form-control other_specify idm form-control-user" style="font-size: 1.0rem;height:40px; border-radius:2px;" size="" id="re_locality_' + r +'" name="relation_locality_id[]">' + idm +'</select></div></div></div><div id="re_locality_'+ r +'_show" style="margin-top: -100px; display: none;">' +
                  ' <div class="form-group-inner"><div class="col-md-4" style="margin-bottom: 40px;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><label name="" class="login2"> </label></div>' +
                  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="form-group  "><input class="form-control form-control-user" id="" placeholder="Specify Locality" name="relation_locality_others[]" type="text"></div>' +
                  '</div></div></div></div></div>');

          }
      });

      $('body').on('click','.remove_relation',function (e) {

          var loca ='#relation_' + $(this).attr('id');

          $(loca).remove();
          r--
      })


      $(add_button_emer).click(function(e){
          e.preventDefault();
          if(em < max_fields){
              em++;
              $(wrapper_emer).append('<div class="row" style="margin-bottom:20px;" id="emergency_' + em + '"> <div class="col-md-12 "><legend style="font-size: 14px; background-color:#555;color: white; max-width:fit-content; padding: 7px; border-radius: 10px 10px 0px 0px;">CONTACT ' + em + ' </legend>' +
                  '<p><a class="btn btn-danger btn-user remove_emergency" href="javascript:void(0);" role="button" id="' + em +'" >REMOVE CONTACT ' + em + '</a></p></div>' +
                  '<div class="form-group-inner"><div class="col-md-4" style="margin-bottom: 40px;"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><label name="Emergency Contact Name" class="login2"> Emergency Contact Name</label></div>' +
                  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="form-group  ">' +
                  '<input class="form-control form-control-user" id="" placeholder="" name="emergency_contact_name[]" type="text"></div></div></div>' +
                  '<div class="form-group-inner"><div class="col-md-4" style="margin-bottom: 40px;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' +
                  '<label name="Emergency Contact Phone Number" class="login2"> Emergency Contact Phone Number</label>' +
                  '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><input class="form-control form-control-user" id="" placeholder="" name="emergency_contact_number[]" type="text"></div>'
                 + '</div></div></div></div>');

          }
      });

      $('body').on('click','.remove_emergency',function (e) {

          var loca ='#emergency_' + $(this).attr('id');

          $(loca).remove();
          r--
      })


      $('.btnRight').click(function (e) {
      id = $(this).attr('id');
      nameid = "#lstBox" + id;
      fid = parseInt(id) + 1;
      nameid2 = "#lstBox" + fid;
      var selectedOpts = $(nameid  + ' option:selected');
          if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
          }
          $(nameid2).append($(selectedOpts).clone());
           $(nameid2 + " > option").prop("selected","selected");
           $(nameid2).trigger("change");
          $(selectedOpts).remove();
          e.preventDefault();
        });

        $('.btnAllRight').click(function (e) {
            id = $(this).attr('id');
            nameid = "#lstBox" + id;
            fid = parseInt(id) + 1;
            nameid2 = "#lstBox" + fid;
          var selectedOpts = $(nameid + ' option');
          if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
          }
          $(nameid2).append($(selectedOpts).clone());
          $(nameid2 + "  > option").prop("selected","selected");
          $(nameid2).trigger("change");
          $(selectedOpts).remove();
          e.preventDefault();
        });

        $('.btnLeft').click(function (e) {
            id = $(this).attr('id');
            nameid = "#lstBox" + id;
            fid = parseInt(id) - 1;
            nameid2 = "#lstBox" + fid;
          var selectedOpts = $(nameid + ' option:selected');
          if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
          }

          $(nameid2).append($(selectedOpts).clone());
          $(nameid +  " > option").prop("selected","selected");
                     $(nameid).trigger("change");
          $(selectedOpts).remove();
          e.preventDefault();
        });

        $('.btnAllLeft').click(function (e) {

            id = $(this).attr('id');
            nameid = "#lstBox" + id;
            fid = parseInt(id) - 1;
            nameid2 = "#lstBox" + fid;
          var selectedOpts = $(nameid + ' option');
          if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
          }

          $(nameid2).append($(selectedOpts).clone());
          $(selectedOpts).remove();
          e.preventDefault();
        });


      $('body').on('change','.other_specify',function (e) {

         var loca ='#' + $(this).attr('id') + '_show';
            if($(this).val()==='false'){
             $(loca).show('slow');

            }
            else{
                $(loca).hide('fast');
      }

      })

      $('body').on('change','.other_quest',function (e) {

          var loca ='#' + $(this).attr('id') + '_show';
          if($(this).val()=== "2"){
              $(loca).show('fast');

          }
          else{
              $(loca).hide('fast');
          }

      })

      $('.other_quest_no').change(function (e) {

          var loca ='#' + $(this).attr('id') + '_show';
          if($(this).val()=== "1"){
              $(loca).show('fast');

          }
          else{
              $(loca).hide('fast');
          }

      })


        $('#show_role_permissions').change(function (e) {
            var selectedOpts = $('.lstBoxm option:selected');
            var selectedOpt = $('.lstBoxm option');

            $(selectedOpts).remove();
            $(selectedOpt).remove();
            var formData = {
                'id'  : $(this).val(),
                '_token'    :  $('input[name=_token]').val()
            };
            ajaxcall(formData,'post','get_all_permissions',1,1 +
            '','');


        });



      $('.preview_info').click(function (e) {
          urledn = $(this).attr('id');
console.log(urledn);
          var formData = {
              '_token'    :  $('input[name=_token]').val()
          };
          ajaxcall(formData,'get',urledn,3,1 +
              '','');


      });



      $('#get_additional_right').change(function (e) {
          var selectedParticipantsArray = [];
          var selectedOpt = $('.extra_permission option');
          $(selectedOpt).remove();
          $('#get_additional_right option:selected').each(function() {
              selectedParticipantsArray.push($(this).val());
          });
          var formData = {
              '_token'    :  $('input[name=_token]').val()
          };

         ajaxcall(formData,'post','get_all_extra_permissions',2,1 +
              '','');


      })

      var typingTimer;
      var donetypingint=1000;
      $('.search_to_pay').on('keyup',function () {
$(path_to_cal).html(0);
          clearTimeout(typingTimer);

          typingTimer=setTimeout(search_member,donetypingint);

      });

      $('.search_to_pay').on('keydown',function () {
          clearTimeout(typingTimer)

      });


/*************************************************:ALL PROCESSABLE EVENT IN HERE****************************************/
     var multi_sel_input = $('.search_to_pay_multiple_select');
      var pam =$('#p_amount_paying');
      var yval =  $('select[name="years_all_selected"]');
       var yera = $('#show_pledge_year');
      var type_name = $('#welare_type');
      var path_to_cal = $('#path_to_call');
      var search_to_reverse_receipt = $('.search_to_reverse_receipt');




      /*****************SHOW PAYMENT BY RECEIPT SEARCHED*****************************/
      $('body').on('click','#click_to_search',function (e) {
          search_reverse_ticket();

      });



      /*****************SHOW REVERSE COMMENT BOX WHEN CLICKED*****************************/
      $('body').on('change','input[name=selected_receipt_id]',function (e) {
          var msel = [];
          $.each($('input[name=selected_receipt_id]:checked'), function () {
              msel.push($(this).val())
          })
          mtotal = msel.length;
$('#total_rece_selected').html(mtotal);
          if (mtotal > 0) {
            $('#show_reverse_reason').fadeIn('fast');

          }
          else {
              $('#show_reverse_reason').fadeOut('fast');
          }

      });

      $('body').on('click','#reverse_transaction',function (e) {
          var msel = [];
         cment =  $('.get_comment').val();
         if(cment.length===0){
             alert('Please provide comment..');
             return false;
         }
          $.each($('input[name=selected_receipt_id]:checked'), function () {
              msel.push($(this).val())
          })

          var formData = {
              'm_selected':msel,
              'comment':cment,
              '_token'    :  $('input[name=_token]').val()
          };


          ajaxcall(formData,'post',$(search_to_reverse_receipt).attr('id'),8,0 + '','');


      });



      /*************************************************:SEARCH PAYMENT PROCESS MANUALLY****************************************/
      $('.search_member_payment_manual').click(function () {


          if($(multi_sel_input).val().length==0){
              alert('Please specify member ID/name..');
              return false;
          }
          if($('#welare_type').val()===''){
              alert('Please specify search type..');
              return false;
          }
          search_member_multiple();

      })
      /******************DISPLAY PAGINATION RECORD SET*****************************/
      $('body').on('click','.pagination_display  a',function (event) {
          event.preventDefault();
          urle = $(this).attr('href');
          pagination_call(urle);


      });
      /******************WIPE PAYMENT CALCULATIONS*****************************/
      $('body').on('keydown','#p_amount_paying',function () {

          $('input[name=indicate_annual_amount]').val('');
      });

      $('body').on('keydown','input[name=indicate_annual_amount]',function () {

          $('#p_paid').val(0);

          $('#p_amount_paying').val('');
      })


      /******************GET MEMBER PAYMENT HISTORY*****************************/
      $('body').on('click','.show_member_payment_history',function (e) {
         get_pdetails =  $(this).attr('id');

        p_route = $('#route_path_payment_history').text();
        p_d = $('.' + get_pdetails).attr('id');

          sp_d = p_d.split('_');

          c_type = $('#col_type_ids').text();
          if(c_type==0){
              c_type = $(type_name).val();
          }
          if(c_type== 2){
              if(sp_d[5]==0){

                  c_type = 4;
              }

          }
          var formData = {
              'p_details':p_d,
              'type':c_type,
              '_token'    :  $('input[name=_token]').val()
          };
          ajaxcall(formData,'get',p_route,7,1 + '','');



      });

          /******************GET MULTIPLE  PAYMENT DETAILS BY YEAR SELECTED[OTHER COLLECTION]*****************************/
      $('body').on('click','.make_payment_other',function (e) {
          clear_payment_fields();
          id= $(this).attr('id');
          ids = id.split('_');
          ident = ids[0];
          get_all_years(ident);

              $('#show_header_title').html($(type_name).find('option:selected').text().toUpperCase());
          dynamic_populate_payment_multi(id);

      });



      /******************PROCESS WELFARE PAYMENT*****************************/
      $('#pay_for_welfare').click(function () {
          var mpaymonths = [];
          reids = $(yval).val();



          sp = reids.split('_');
          yr = $(yera).html();
          payment_details= $('.'+ sp[0] + '_' + yr).attr('id');
          spi = payment_details.split('_');
          amp = parseFloat($(pam).val());
          pbal = parseFloat(spi[1]) - parseFloat(spi[3]);

          if(spi[6]==5) {

              $.each($('input[name=mnames]:checked'), function () {
                  mpaymonths.push($(this).val())
              })
              mtotal = mpaymonths.length;
              if (mtotal <= 0) {
                  alert('Opps!! Please select months paying ')
                  return false;
              }
          }
          else{
              resp =  validate_code(parseFloat($(pam).val()),pbal );
              if(parseInt(resp) > 0){
                  validate_message(parseInt(resp));
                  return false;
              }
          }
          path =$('#route_path').text();
          var formData = {
              'p_details':payment_details,
              'amount_paid':amp,
              'm_selected':mpaymonths,
              '_token'    :  $('input[name=_token]').val()
          };
          console.log(formData);

          ajaxcall(formData,'post',path,6,0 + '','');



      });




      /******************PROCESS WELFARE MEMBER DETAILS*****************************/
      $(multi_sel_input).on('keyup',function () {


          if($('#welare_type').val()==''){

              alert('Select search type')
              return false;
          }

          clearTimeout(typingTimer);

          typingTimer=setTimeout(search_member_multiple,donetypingint);

      });

      $(multi_sel_input).on('keydown',function () {
          clearTimeout(typingTimer)

      });

      /******************PROCESS DYNAMIC PAYMENT[TITHE,PLEDGE]*****************************/
      $('#pay_for_general').click(function () {
          var mpaymonths = [];
          iam = $('input[name=indicate_annual_amount]').val();
          yval =  $('select[name="years_all_selected"]').val().split('_');
          payment_details= $('.'+ yval[0] + '_'  + $('#show_pledge_year').text()).attr('id');
          pam =$('#p_amount_paying');
          paam =parseFloat(iam);
          pdueamount =parseFloat($('#p_amount').val());
          pbal = 450000000;
          amp = parseFloat($(pam).val());

          $.each($('input[name=mnames]:checked'), function () {
             mpaymonths.push($(this).val())
          })
            mtotal = mpaymonths.length;
          if(mtotal <=0){
            alert('Opps!! Please select months paying ')
          return false;
          }

          if(iam.length > 0) {
              console.log(iam.length);
              resp =  validate_code(paam,pbal);
              if(parseInt(resp) > 0){
                  validate_message(parseInt(resp));

                  return false;

              }
          }
          resp =  validate_code(amp,pbal);
          if(parseInt(resp) > 0){
              validate_message(parseInt(resp));
              return false;
          }
          path =$('#route_path').text();
          var formData = {
              'p_details':payment_details,
              'amount_paid':amp,
              'm_selected':mpaymonths,
              'defined_amount':iam,
              '_token'    :  $('input[name=_token]').val()
          };
          console.log(formData);


          ajaxcall(formData,'post',path,4,0 + '','');



      });






      /******************GET TRANSPORT PROCESS DETAILS****************************/
      $('body').on('click','.make_payment',function (e) {
          clear_payment_fields();
          id= $(this).attr('id');
          populate_payment(id);

      });




/******************PROCESS TRANSPORT PAYMENT*****************************/
      $('#pay_for_transport').click(function () {
          pam =$('#p_amount_paying');
          pbal = $('#p_bal').val();
          amp = $(pam).val();
          console.log(amp);
         resp =  validate_code(amp,pbal);
         if(parseInt(resp) > 0){
             validate_message(parseInt(resp));

             return false;

         }
          rou = $('#payment_details').text();
          ids = rou.split('-');
          path =$('#route_path').text();
          var formData = {
              'collection_id':ids[2],
              'amount_paid':amp,
              'point_sub_id':ids[0],
              'member_id':ids[1],
              '_token'    :  $('input[name=_token]').val()
          };
          console.log(formData);

          ajaxcall(formData,'post',path,4,0 + '','');



      });



      /******************GET MULTIPLE  PAYMENT DETAILS BY YEAR SELECTED*****************************/
      var cal_change =$('#path_cal_function');
      $('body').on('click','.make_payment_welfare',function (e) {
          id= $(this).attr('id');
          ids = id.split('_');
          ident = ids[0];

         get_all_years(ident);
          if(parseInt($('#welare_type').val())==5){
              $(cal_change).html(3);

              $('#show_header_title').html('WELFARE DUES YEAR')


          }
          else{
              $(cal_change).html(2);
              $('#show_header_title').html('WELFARE LEVY YEAR')

          }
          dynamic_populate_payment_multi(id);
          var formData = {
              'id'  : id,
              '_token'    :  $('input[name=_token]').val()
          };
          console.log(formData);
          if(ids[6]==5) {
              ajaxcall(formData, 'post', 'get_welfare_payment_details', 5, 1 +
                  '', '');
          }


      });

      /******************GET DYNAMIC PAYMENT DETAILS BY YEAR SELECTED[PLEDGE,TITHE]*****************************/
      $('body').on('click','.make_payment_general',function (e) {
          clear_payment_fields();
          id= $(this).attr('id');
          console.log(id);
          ids = id.split('_');
          ident = ids[0];
          get_all_years(ident);
          urlend = $('#route_path_show_month').text();

          dynamic_populate_payment(id);
          var formData = {
              'id'  : id,
              '_token'    :  $('input[name=_token]').val()
          };
          console.log(formData);
          ajaxcall(formData,'post',urlend,5,1 +
              '','');


      });


      /******************GET DYNAMIC PAYMENT DETAILS BY YEAR SELECTED ON CHANGE[TITHE,PLEDGE]*****************************/

      $('select[name="years_all_selected"]').on('change',function (e) {
          vald = $(this).val();
          changedmemberyearpaymentdetails(vald);

      });


      /*****************CALCULATE DUES AMOUNT PAYABLE BASED ON MONTH SELECTION*****************************/
      $('body').on('change','input[name=mnames]',function (e) {
          var mpaymonths = [];
          pam =$('#p_amount_paying');
          pamt =parseFloat($('#p_amount').val());
          mtb = $('select[name="years_all_selected"]').val().split('_');
          divinum =  $('#divi_' + mtb[0] + '_' + $('#show_pledge_year').text()).text();

          paam =parseFloat($('input[name=indicate_annual_amount]').val());
          pdueamount =parseFloat($('#p_paid').val());
          pcal = parseInt($("#path_cal_function").text());

          $.each($('input[name=mnames]:checked'), function () {
              mpaymonths.push($(this).val())
          })
          mtotal = mpaymonths.length;

          if (pdueamount > 0 && pamt > 0) {
              $(pam).val(pdueamount * mtotal);

          }
          if(pcal==3) {
              if (pdueamount > 0) {
                  $(pam).val(pdueamount * mtotal);

              }
          }

          if (paam > 0 && pamt ===0) {
              $(pam).val((paam/divinum) * mtotal);

          }

          if (pamt ==0  ) {
              $('#p_paid').val(parseFloat($(pam).val())/ mtotal);

          }


      });





      /******************SHOW DEFINE PLEDGE INPUT *****************************/
      $('body').on('click','#show_annual_box_option',function (e) {
          $('#show_annual_box').fadeIn();
      });


/******************************************************* ALL REUSABLE FUNCTIONS IN HERE***********************/


      /******************PROCESS REVERSED RECEIPT SEARCH *****************************/
      function search_reverse_ticket() {
          if($(search_to_reverse_receipt).val().length==0){
              alert('Please specify Receipt ID..');
              return false;
          }

              search = $(search_to_reverse_receipt).val();
              urledn =  $(search_to_reverse_receipt).attr('id');




              var formData = {
                  'search': search,
                  '_token': $('input[name=_token]').val()
              };
              console.log(formData);
              ajaxcall(formData, 'get', urledn, 3, 1 + '', '');

      }



      /******************PAGINATION FUNCTION DISPLAY CALL *****************************/
function pagination_call(urle){

    $(path_to_cal).html(urle);

    ajaxcallwithurl('get',urle,3 );
}


      function resetreversedpayment(){
          $('#show_reverse_reason').fadeOut('fast');
          $('.get_comment').val('');

          setTimeout(function() {
              $('.result_show').html('')

          }, 6000);

      }

function resettransportpaymentdetails(){

    setTimeout(function() {
        pamtr = $('#payment_details').text();
        populate_payment(pamtr);
        if($('#'+ pamtr).length == 0){
            $("#WarningModalalert").modal("hide");
            return false;
        }

    }, 500);

    setTimeout(function() {
        $('.result_show').html('')

    }, 4000);

}

function resetpaymentdetails(){
    setTimeout(function() {
    mtb = $('select[name="years_all_selected"]').val().split('_');
    vid =   mtb[0] + '_' + $('#show_pledge_year').text();
    changedmemberyearpaymentdetails(vid);

    }, 500);

    setTimeout(function() {
$('.result_show').html('')

    }, 4000);

}





      /******************PROCESS MEMBER SEARCH*****************************/
      function search_member() {
          if($('.search_to_pay').val().length==0){
              alert('Please specify member ID/name..');
              return false;
          }
          ptc = $(path_to_cal).text();
          if(ptc==0){
              search = $('.search_to_pay').val();
              urledn =  $('.search_to_pay').attr('id');
          }

          if(ptc==0) {

              var formData = {
                  'search': search,
                  '_token': $('input[name=_token]').val()
              };
              console.log(formData);
              ajaxcall(formData, 'get', urledn, 3, 1 + '', '');
          }
          else{

              ajaxcallwithurl('get',ptc,3)
          }

      }

      /******************PROCESS MEMBER SEARCH MULTIPLE SELECT OPTION*****************************/
      function search_member_multiple() {
          if($(multi_sel_input).val().length==0){
              alert('Please specify member ID/name..');
              return false;
          }
          if($('#welare_type').val()===''){
              alert('Please specify search type..');
              return false;
          }
          ptc = $(path_to_cal).text();
          if(ptc==0) {
              search = $(multi_sel_input).val();
              search_type = $('#welare_type').val();
              urledn = $(multi_sel_input).attr('id');
              var formData = {
                  'search': search,
                  'type': search_type,
                  '_token': $('input[name=_token]').val()
              };
              console.log(formData);
              ajaxcall(formData, 'get', urledn, 3, 1 + '', '');

          }
          else{
              ajaxcallwithurl('get',ptc,3)
          }

      }

      /******************CHANGED PAYMENT INFO BASED ON YEAR SELECTED*****************************/

      function changedmemberyearpaymentdetails(vald){


          urlend = $('#route_path_show_month').text();
          if($('.'+ vald).length == 0){
              $("#WarningModalalert").modal("hide");
              return false;
          }
          id= $('.'+ vald).attr('id');

          console.log('current id:' + id);
          pcf =$('#path_cal_function').text();
          $('#p_amount_paying').val('');
          $('input[name=indicate_annual_amount]').val('');
          if(pcf==2 || pcf==3){
              dynamic_populate_payment_multi(id)
          }

          else if(pcf==1 ) {
              dynamic_populate_payment(id);
          }
          if(pcf !=2) {
              var formData = {
                  'id': id,
                  '_token': $('input[name=_token]').val()
              };
              console.log(formData);
              ajaxcall(formData, 'post', urlend, 5, 1 +
                  '', '');
          }
      }

      /******************POPULATE ALL POSSIBLE PAYMENT YEARS[TITHE,OTHER COLLECTION]*****************************/
function get_all_years(ident){
          $('.show_all_years').html('');
    $('.years_' + ident).each(function (i,obj) {
        $('.show_all_years').append($(this).html());
    });
}
      /******************POPULATE PAYMENT INFO DYNAMIC MULTIPLE SELECT[WELFARE]*****************************/
       var dppm_spa = $('#show_p_amount');
      function dynamic_populate_payment_multi(id){
          sabo = $('#show_annual_box_option');
          ids = id.split('_');
          ident = ids[0];
          $('.p_amount').val(ids[1]);
          $('#show_payee_info_hear').html($('#get_year_and_payee_info_'+ ident).html());
          $('#stat_icon').html($('#stat_profile_img_' + ident).html());
          $('#show_pledge_year').html(ids[2]);


          if(ids[6]==5){
              $(dppm_spa).fadeOut('fast');
              $('#month_left_unpaid').fadeIn('fast');
              $('#p_amount_paying').attr('readonly',true);

          }
          else{
              $('#total_paid').val(parseFloat(ids[3]));
              $(dppm_spa).fadeIn('fast');
              $('#month_left_unpaid').fadeOut('fast');
              $('#p_amount_paying').attr('readonly',false);

          }

          if(parseInt(id[3]) ==0){
              $(sabo).fadeIn();

          }
          else{
              $(sabo).fadeOut();
              $('#show_annual_box').fadeOut();

          }
      }

      /*****************VALIDATE PAYMENT FIGURES ENTERED*****************************/

      function validate_code(amp,pbal){



          if(amp === ''){


              return 1;
          }
          if(!floatRegex.test(amp)) {
              return 2
          }
          if(parseFloat(amp) > parseFloat(pbal)) {

              return 3;
          }
      }
      function validate_message(code){



          if(code === 1){

              alert('Oops!! specify payment amount');
          }
          if(code === 2) {
              alert('Oops!! Only numerical characters accepted');
          }
          if(code === 3) {
              alert('Oops!! amount paying is greater than balance left');
          }
      }


      /******************POPULATE PAYMENT INFO DYNAMIC*****************************/
      function dynamic_populate_payment(id){
        sabo = $('#show_annual_box_option');
          ids = id.split('_');
          ident = ids[0];
          divinum =  $('#divi_' + ident + '_' + ids[2]).text();

          $('#p_amount').val(ids[1]);
          pm = parseFloat(ids[1]) / parseFloat(divinum);
          $('#p_paid').val(pm);
     console.log('result:' + id);

          $('#show_payee_info_hear').html($('#get_year_and_payee_info_'+ ident).html());
          $('#stat_icon').html($('#stat_profile_img_' + ident).html());
          $('#show_pledge_year').html(ids[2]);
          if(pm <=0){
              $('#p_amount_paying').attr('readonly',false);

          }
          else{
              $('#p_amount_paying').attr('readonly',true);

          }

          if(parseInt(ids[3]) ==0){
              $(sabo).fadeIn();

          }
          else{
              $(sabo).fadeOut();
              $('#show_annual_box').fadeOut();

          }
      }





      /******************POPULATE TRANSPORT PAYMENT INFO*****************************/
      function populate_payment(id){
clear_payment_fields();
          $('#payment_details').html(id);
          ids = id.split('-');

          ident = ids[1]+'_'+ids[0];
          $('#show_payee_info_hear').html($('#get_year_and_payee_info_'+ ids[1]).html());
          $('#stat_icon').html($('#stat_profile_img_' + ids[1]).html());
          ap = $('#amount_paid' + ident).text();
          $('#p_paid').val(ap);
          pa = $('#payment_amount' + ident).text();
          $('#p_amount').val(pa);
          bal = parseFloat(pa) - parseFloat(ap);
          $('#p_bal').val(parseFloat(bal));

      }

      /******************CLEAR PAYMENT FIELDS*****************************/
      function clear_payment_fields(){
          $('#amount_paid').val('');
          $('#p_paid').val('');
          $('#payment_amount').val();
          $('#p_amount_paying').val('');
          $('#p_amount').val('');
          $('#p_bal').val('');
          $('input[name=indicate_annual_amount]').val('')

      }






      function responseprocess(data, type) {
    if (type == 1) {
        var selectedOpt = $('.roles_all option');
        $(selectedOpt).remove();
        option_types(data.perm,'.permissions_all',1);
        option_types(data.extraperm,'.extra_permission',1);
}
    if (type == 2) {
        option_types(data.perm,'.extra_permission',2);

    }
    if (type == 3) {
        console.log(data);
        option_types(data,'.ajax_show_detail',3);

    }

    if (type == 4) {
        option_types(data.data,'.result_show',4);

    }
    if (type == 5) {
        option_types(data.data,'.show_non_paid_month',5);

    }


    if (type == 6) {
        option_types(data.data,'.result_show',6);

    }
    if (type == 7) {

        option_types(data,'#show_payment_history_data',7);

    }
          if (type == 8) {

              option_types(data.data,'.result_show',8);

          }
}

function option_types(data,displayname,type){

            if(type==1) {
                $.each(data, function (index, data) {

                    $(displayname).append('<option value="' + data.id + '">' + data.name + '</option>')
                    //console.log(data.name);
                })
            }
            if(type==2){
                $.each(data, function (index, data) {
                    $(displayname).append('<option value="' + data.id + '">' + data.name + '</option>');
                   // console.log(data.pername);
                })

            }

    if(type==3){
            $(displayname).html(data);
    }

    if(type==4){

        $(displayname).html(data);
        search_member();
        if($('#path_cal_function').text()==4){
            resettransportpaymentdetails();
        }
        else {
            resetpaymentdetails();
        }
    }

    if(type==5){
        $(displayname).html(' ');
        $.each(data, function (index, data) {
            $(displayname).append('<label style="margin-top: 10px;"><input name="mnames" value="' + data.ident +'" class="pull-left radio-checked" type="checkbox"><strong style="padding-right: 20px;">' + data.name + '</strong></label>');


        })

    }

    if(type==6){
        search_member_multiple();
        $(displayname).html(data);
        resetpaymentdetails();
    }

    if(type==7){
        $(displayname).html(data);
    }
    if(type==8){
        search_reverse_ticket();
        $(displayname).html(data);
        resetreversedpayment();

    }

}
/**************************ALL CALLS TO AJAX IN HERE**************************************/

      function ajaxcall(formData,Http_verb,URLLocation,type,prompt,redirect){
          var cond;
          if(prompt ==0) {
              if (!confirm('Are you sure you want to perform this action')) {

                  return false;

              }
          }

          $.ajax({
              type        : Http_verb, // define the type of HTTP verb we want to use (POST for our form)
              url         : BaseURL + '/' + URLLocation, // the url where we want to POST
              data        : formData, // our data
              beforeSend: function() {

                  $("#cover-spin").fadeIn('slow');
              }
          }).done(function(data) {
              console.log(data);
              responseprocess(data,type);


              $("#cover-spin").fadeOut('slow');

              }).fail(function(response) {

              // log data to the console so we can see
              console.log(response.responseText);
              return false;

          });

      }


      function ajaxcallwithurl(Http_verb,URLLocation,type){

          $.ajax({
              type        : Http_verb, // define the type of HTTP verb we want to use (POST for our form)
              url         :  URLLocation, // the url where we want to POST
              beforeSend: function() {

                  $("#cover-spin").fadeIn('slow');
              }
          }).done(function(data) {
              console.log(data);
              responseprocess(data,type);


              $("#cover-spin").fadeOut('slow');

          }).fail(function(response) {

              // log data to the console so we can see
              console.log(response.responseText);
              return false;

          });

      }





  });
