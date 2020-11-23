  $(document).ready(function () {
      //alert('ljj');

      smsmessagecalculation();
      birthday_notification();



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


/**************************ALL CALLS TO AJAX IN HERE**************************************/


function smsmessagecalculation() {
    if ($("#charactno").length > 0) {

    var len = $("#charactno").val().length;
    $("#display_count").html(len);
    res = len / 160;
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

      function tmajaxcall(formData,Http_verb,URLLocation,type,prompt,redirect){
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


      function tmjaxcallwithurl(Http_verb,URLLocation,type){

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
