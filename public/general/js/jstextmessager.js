  $(document).ready(function () {
     // alert('ljj');

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
