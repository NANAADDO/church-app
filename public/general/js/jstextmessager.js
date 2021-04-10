  $(document).ready(function () {
      //alert('ljj');
      var cond = true;
      smsmessagecalculation();
      birthday_notification();



      /************************VIEW SMS DETAILS*******************/

      $('#show_sms_details').on('click',function(){
          usedsms=parseInt($('#usedsms').html());
          $('#sms_detail_char').html($('#display_count').html());
          $('#sms_detail_unit_cost').html(usedsms);
          $('#sms_detail_content').html($('#charactno').val());
          if($('#newtag').val().length==0) {

              $('#sms_detail_subject').html($("#sendtagname option:selected").text());
          }
          else{
              $('#sms_detail_subject').html($("#newtag").val());
          }
          totalcont = parseInt($('#totalCountContact').html());
          $('#sms_detail_contact').html(totalcont);
          $('#sms_detail_cost').html(totalcont * usedsms);
      });

      /****************DISPLAY SHOW TAG BOX***********/
      $('#showtagbox').on('click',function(){
          if(cond==true){
              $('.new-tag').fadeIn("fast");
              $('#showtagbox').text("HIDE CREATE SENDERTAG FIELD");
              cond = false;
          }
          else{
              $('.new-tag').fadeOut("fast");
              $('#newtag').val('');
              $('#showtagbox').text("CREATE NEW SENDERTAG");
              cond = true;;
          }

      });

      /****************DISPLAY EXISTING MESSAGE FOR EDIT***********/

      $("body").on("change","#messagepop",function(){

          message =$("#messagepop option:selected").val();

          $("#charactno").fadeIn("slow").val(message);
         $('#display_count').html(message.length);
          $('#usedsms').html(Math.ceil(message.length/150));
      });
      $("#messagepoped").on("change",function(){

          messvalue =$(this).val();
          marked = "#message-" + messvalue;
          result =$(marked).html();
          $(".display-selected_text").html(result);
          //alert(result);
      });

/*************************************************:ALL PROCESSABLE EVENT IN HERE****************************************/

$("#charactno").keyup(function(){

   smsmessagecalculation();

});




      $('.notification').change(function() {
;          if ($(this).prop('checked')) {
              $(".notification_setting").fadeIn("slow");
          }
          else {
              $(".notification_setting").fadeOut("slow");
          }
      });



      $("#messagepoped").on("change",function(){

          messvalue =$(this).val();
          marked = "#message-" + messvalue;
          result =$(marked).html();
          $(".display-selected_text").html(result);

      });

      /***********************GLOBAL VARIABLES HERE*************************************************/
      var contact_identifier = ".delete-";

      /*********************************CONTROLLING CONTACT SELECTION*********************************************************/
      $(".selectcheck").change(function(){
          var sum = 0;
          idcheck =$(this).attr('id');
          selected= idcheck.split("-");
          id = selected[1];
          marked = contact_identifier + id;
          var cloned_data = ".clonedata-"+ id;
          var selectedOpts = $(".show_selected_members");
          var  selectedParticipantsArray =  [];
          var totalchecked = $(".total-select");
          var show_selected_but = $('#show_selected_but');
          $('.selectcheck:checked').each(function() {
              selectedParticipantsArray.push($(this).val());
          });
          $("#ids").html(selectedParticipantsArray);
          if ($(this).prop('checked')) {
              $(marked).addClass("marked_back_red");
              //console.log($(marked).html());
              $(selectedOpts).append('<tr class="delete_from_selected_tray_' + id + '">' +  $(marked).html() + '<td><td><a href="javascript:void(0);" id="'+ id +'" class="btn btn-danger btn-xs selected_tray_item" title="remove Contact">' +
                  '<i class="glyphicon glyphicon-trash"></i></a></td></td></tr>');
              $(marked).fadeOut('slow');
          }
          else {

              $(this).attr("checked", "false");
              $(marked).removeClass("marked_back_red");
          }

          var totalselect = $(".selectcheck:checked").length;
           display_view_selection_button()

      });

      /**************************TRAY ITEM DELETION FUNCTION**************************************/
      $('body').on('click','.selected_tray_item',function () {

          tray_id =$(this).attr('id');
          deleting_tray_item = $('.delete_from_selected_tray_' + tray_id);
          $(deleting_tray_item).addClass("marked_back_red");
          $(deleting_tray_item).remove();
          $(contact_identifier + tray_id).fadeIn('slow');
          $(contact_identifier + tray_id).removeClass('marked_back_red');

      });

/******************************************************* ALL REUSABLE FUNCTIONS IN HERE***********************/


function checkinternetconnection(){

    var ifConnected = window.navigator.onLine;
    if (ifConnected) {
       return true
    } else {
        return false
    }

}
function checkdataconnection(){

    jQuery.ajaxSetup({async:false});
    re="";
    r=Math.round(Math.random() * 1000);
    $.get("https://www.google.com/search?q=user+icon+png&tbm=isch&ved=2ahUKEwjrjfn2tNftAhUZKhoKHRYxA0QQ2-cCegQIABAA&oq=user+i&gs_lcp=CgNpbWcQARgBMgQIABBDMgQIABBDMgQIABBDMgQIABBDMgQIABBDMgIIADICCAAyAggAMgIIADICCAA6BAgjECc6BQgAELEDOggIABCxAxCDAToHCAAQsQMQQ1CH7wFYgfYBYNiEAmgAcAB4AIABwAKIAZYMkgEFMi01LjGYAQCgAQGqAQtnd3Mtd2l6LWltZ8ABAQ&sclient=img&ei=sZDcX6vxNZnUaJbijKAE&bih=689&biw=1280#imgrc=NNdulOl7XJ_upM",
        {subins:r},function(d){
        re=true;
    }).error(function(error){
        console.log(error);
        re=false;
    });
    return re;
}


function getsmsfilterparams(){

    formData = {
        'message' : $('#charactno').val(),
        'tag' : $('#sms_detail_subject').html(),
        'welfare_state' : $('select[name=welfare_state]').val(),
        'gender':$('select[name=gender]').val(),
        'by_age' : $('input[name=by_age]').val(),
        'marital_status' : $('select[name=marital_status]').val(),
        '_token' : $('input[name=_token]').val(),
        'profession' : $('select[name=profession]').val(),
        'hometown' : $('select[name=hometown]').val(),
        'churchgroup' : $('select[name=church_group]').val(),
        'locality' : $('select[name=locality]').val()

    }

    return formData;
}
function responseprocess(displayLocation,data){

    $(displayLocation).html(data).fadeIn('fast');


}

      function responseprocessor(displayLocation,data){

          if(displayLocation===1) {
              $("#depends_response_success").fadeIn('slow');
              $('#res_success').html(data.status);
              $('#res_success').removeClass("text-danger").addClass('text-success');
              $('#res_message').html(data.message);
              $('#res_message').removeClass("text-danger").addClass('text-success');
              if (data.status === 'error') {
                  $('#res_success').removeClass("text-success").addClass('text-danger');
                  $('#res_message').removeClass("text-success").addClass('text-danger');
                  $("#depends_response_success").fadeOut('fast');
              } else {

                  $('#res_sent').html(data.total_sent);
                  $('#res_rejected').html(data.total_rejected);

              }
          }



      }


      function tmajaxcall(formData,Http_verb,URLLocation,type,prompt,redirect){
          var cond;
          if(prompt ===0) {
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
              responseprocess(type,data);


              $("#cover-spin").fadeOut('slow');

          }).fail(function(response) {

              // log data to the console so we can see
              console.log(response.responseText);
              return false;

          });

      }


      function tmajaxcall2(formData,Http_verb,URLLocation,type,prompt,redirect){
          var cond;
          if(prompt ===0) {
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
              responseprocessor(type,data);


              $("#cover-spin").fadeOut('slow');

          }).fail(function(response) {

              // log data to the console so we can see
              console.log(response.responseText);
              return false;

          });

      }


      function tmjaxcallwithurl(Http_verb,URLLocation,type){

          $.ajax({
              type        : Http_verb, // define the type of HTTP verb we want to use (POST for our form)
              url         :  URLLocation, // the url where we want to POST
              beforeSend: function() {

                  $("#cover-spin").fadeIn('slow');
              }
          }).done(function(data) {
              console.log(data);
              responseprocess(type,data);


              $("#cover-spin").fadeOut('slow');

          }).fail(function(response) {

              // log data to the console so we can see
              console.log(response.responseText);
              return false;

          });

      }



      /*********************************NON REUSABLE FUNCTIONS******************************/
function smsmessagecalculation() {

    if ($("#charactno").length > 0) {

        var len = $("#charactno").val().length;
        $("#display_count").html(len);
        res = len / 150;
        smsused = Math.ceil(res);
        $("#usedsms").html(smsused);
        $("#smscount").val(smsused);
        $("#characters").val(len);

    }
}

function birthday_notification() {
    if ($(".notification").length > 0) {

        if ($('.notification').prop('checked')) {
            $(".notification_setting").fadeIn("slow");
        }
        else {
            $(".notification_setting").fadeOut("slow");
        }


        messvalue =$('#messagepoped').val();
        marked = "#message-" + messvalue;
        result =$(marked).html();
        $(".display-selected_text").html(result);

    }
}

      function display_view_selection_button(totalchecked,totalselect){

          $(totalchecked).html(totalselect);

          if(totalselect > 0){
              $(show_selected_but).fadeIn('slow');
          }
          else{
              $(show_selected_but).fadeOut('slow');

          }
      }




/**************************ALL CALLS TO AJAX IN HERE**************************************/
$('#fetchTextMessageFilter').on('click',function(){

    formData = getsmsfilterparams();


    urlRoute = $('#get_search_endpoint').text();

    tmajaxcall(formData,'post',urlRoute,'#display_sms_filter_list',1,'');

  });


/*********************PROCESSING THE SMS TO BE SENT**************************/

      $('body').on('click','#process_sms',function () {

          if(checkinternetconnection()===true){

              formData = getsmsfilterparams();

              urlRoute = $('#get_process_endpoint').text();

              tmajaxcall2(formData,'post',urlRoute,1,0,'');

          }
          else{
              alert('Opps!! No Internet connection detected')

          }



      });


      /*********************PROCESSING SCHEDULE BIRTHDAY MESSAGES TO BE SENT**************************/

      $('body').on('click','#process_birthday_sms',function () {

          if(checkinternetconnection()===true){

              formData = getsmsfilterparams();

              urlRoute = $('#get_process_endpoint').text();

              tmajaxcall2(formData,'post',urlRoute,1,0,'');

          }
          else{
              alert('Opps!! No Internet connection detected')

          }



      });


  });
