  $(document).ready(function () {
      alert('gg');
      var getcoltype = parseInt($('#get_col_type').text());
    var table =  $('#example').DataTable(
          {
              dom: 'lBfrtip',
              buttons: [
                  {
                      extend: 'excelHtml5',
                      exportOptions: {
                          columns: ':visible'
                      }
                  },

                  {
                      extend: 'csvHtml5',
                      exportOptions: {
                          columns: ':visible'
                      }
                  },
                  {
                      extend: 'pdfHtml5',
                      download: 'open',
                      exportOptions: {
                          columns: ':visible'
                      },
                      title:get_title(getcoltype),
                      messageTop: 'Report Generated Based On Filter Below',

                      customize: function(doc) {
                          doc.styles.title = {
                              color: 'black',
                              fontSize: '15',
                              alignment: 'center'
                          }
                      }
                  },
                  {
                      extend: 'print',
                      exportOptions: {
                          columns: ':visible'
                      },
                      title:get_title(getcoltype),
                      messageTop: 'Report Generated Based On Filter Below :'
                  },
                  'colvis'
              ],
              "lengthMenu": [ [25, 50,100,150,200, -1], [25, 50,100,150,200, "All"] ],
              responsive: true
          });



    /*****************SEARCH MEMBER DETAILS BASED ON FILTER*******************/

    let startYear = $('select[name=year_paid]');
      let endYear = $('select[name=end_year]');
      $('#search_form').on('click', function(e) {

          stYr = $(startYear).val();
          enYr =  $(endYear).val();

          if( stYr !=="" &&  enYr !==""){
             if(parseInt(enYr) <= parseInt(stYr)){
               alert('Opps!! End Year Must Be Greater than the Start Year.')
                 $(endYear).focus();
               return false;
             }
          }

          $('#td_title').html('');
          $('#td_body').html('');
          var json_data =reportcol(getcoltype);

          //alert(getcoltype);

          var i;

          $("#tableDiv").empty();
          $("#tableDiv").append('<table id="example" class="display " style="width:100%;text-align: center;" ><thead><tr id="td_title">' +
              '</tr></thead><tbody id="td_body"></tbody></table>');

          for (i = 0; i < json_data.length; i++) {
              $('#td_title').append('<th></th>');
          }

         $('#example').DataTable().destroy();



          purl = $('#get_searcch_endpoint').text();
          //alert(purl);
         //console.log($('#type_collection').val());

          fetch_data(true,purl);

          e.preventDefault();
      });



/************************************DATATABLE'S REUSABLE FUNCTIONS HERE**********************************/

function reportcol(type){
    var res;
    let fetchValue = parseInt($('select[name=fetch_type]').val());
    let fetchID = 3;

    if(type===0) {

        res = [
            {data: "name", title: "Name"},
            {data: "new_member_id", title: "Member ID"},
            {data: "phone_numbers", title: "Phone #"},
            {data: "address", title: "Address"},
            {data: "country", title: "Country"},
            {data: "home_town", title: "Home Town"},
            {data: "gender_name", title: "Gender"},
            {data: "locality", title: "Locality"},
            {data: "profession", title: "Profession"},
            {data: "marital_status", title: "Marital Status"},
            {data: "date_joined", title: "Date Joined"}

        ];

    }

    if(type===1) {

        res = [
            {data: "rname", title: "Name"},
            {data: "rmember_id", title: "Member ID"},
            {data: "descrip", title: "Transport Description"},
            {data: "amount", title: "Total"},
            {data: "tpaid", title: "Amount Paid"},
            {data: "bal", title: "Balance"},
            {data: "date_paid", title: "Date Paid"}
        ];

    }

    if(type===2 || type===3) {


        if($('#type_collection').val()==6){
            res =  [
                {data: "name", title: "Name"},
                {data: "member_id", title: "Member ID"},
                {data: "tamount", title: "Amount"},
                {data: "tpaid", title: "Amount Paid"},
                {data: "tbal", title: "Balanced Left"},
                {data: "ryear", title: "Year"},
                {data: "date_paid", title: "Date Paid"}
            ];

        }
        else {
              if(fetchValue===fetchID) {
                  res =reusableReportColum(1);
              }

              else {
                  res = [
                      {data: "name", title: "Name"},
                      {data: "member_id", title: "Member ID"},
                      {data: "mname", title: "Month"},
                      {data: "tpaid", title: "Amount Paid"},
                      {data: "ryear", title: "Year"},
                      {data: "date_paid", title: "Date Paid"}
                  ];
              }
        }
    }

    if(type===4) {
            res =  [
                {data: "name", title: "Name"},
                {data: "new_member_id", title: "Member ID"},
                {data: "colname", title: "Collection Type"},
                {data: "tamount", title: "Amount"},
                {data: "tpaid", title: "Amount Paid"},
                {data: "tbal", title: "Balanced Left"},
                {data: "ryear", title: "Year"},
                {data: "date_paid", title: "Date Paid"}
            ];

        }


    if(type===5) {
        if(fetchValue===fetchID){

            res =reusableReportColum(1);

        }
        else {

            res = [
                {data: "name", title: "Name"},
                {data: "member_id", title: "Member ID"},
                {data: "tpaid", title: "Amount Paid"},
                {data: "ryear", title: "Year"},
                {data: "date_paid", title: "Date Paid"}
            ];

        }

    }

    if(type===6) {

        res = [
            {data: "name", title: "Name"},
            {data: "member_id", title: "Member ID"},
            {data: "col_type", title: "Collection Type"},
            {data: "total_month", title: "Total Month"},
            {data: "totalmonthpaid", title: "Total Month Paid"},
            {data: "amountpaying", title: "Amount Paying"},
            {data: "totalpaid", title: "Total Paid"},
            {data: "ryear", title: "Year"}
        ];
    }
    if(type===7) {
        res = [
            {data: "name", title: "Name"},
            {data: "new_member_id", title: "Member ID"},
            {data: "old_member_id", title: "OLD Member ID"},
            {data: "coltype", title: "Collection Type"},
            {data: "amount", title: "Amount"},
            {data: "dpaid", title: "Date Paid"},
        ];



    }


    return res

}
function fetch_data(fetchstate,endpoint) {
     $('#example').DataTable(
        {
            "processing":true,
            "serverSide":true,
            autoWidth:true,
            ajax: {
                url: BaseURL + endpoint,
                type: "post",
                data: function (d) {
                    d.payment_date = $('input[name=payment_date]').val();
                    d.col_type = $('select[name=col_type]').val();
                    d.start_date = $('input[name=start_date]').val();
                    d.end_date = $('input[name=end_date]').val();
                    d.end_year = $('select[name=end_year]').val();
                    d.welfare_state = $('select[name=welfare_state]').val();
                    d.gender = $('select[name=gender]').val();
                    d.by_age = $('input[name=by_age]').val();
                    d.marital_status = $('select[name=marital_status]').val();
                    d.member_status = $('select[name=member_status]').val();
                    d._token = $('input[name=_token]').val();
                    d.religious = get_multi_value('religious');
                    d.profession = get_multi_value('profession');
                    d.hometown = get_multi_value('hometown');
                    d.churchgroups = get_multi_value('church_groups');
                    d.locality =get_multi_value('locality');
                    d.funeral_person = $('select[name=funeral_person]').val();
                    d.member_id = $('select[name=member_id]').val();
                    d.status = $('select[name=status]').val();
                    d.type = $('select[name=type]').val();
                    d.fetch_type = $('select[name=fetch_type]').val();
                    d.year_paid = $('select[name=year_paid]').val();
                    d.group_by =get_multi_value('group_by');



                },
            },
            dom: 'lBfrtip',

            "columns":reportcol(getcoltype),
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    footer: 'true',
                    title: "title",
                    download: 'open',
                    exportOptions: {
                        columns: ':visible'
                    },
                    title: get_title(getcoltype),
                    messageTop: 'Report Generated Based On Filter Below',

                    customize: function(doc) {
                        doc.styles.title = {
                            color: 'black',
                            fontSize: '15',
                            alignment: 'center'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    },
                    title: get_title(getcoltype),
                    messageTop: 'Report Generated Based On Filter Below',
                },
                'colvis'
            ],
            "lengthMenu": [ [25, 50,100,150,200, -1], [25, 50,100,150,200, "All"] ],
            responsive: true
        });
}

function get_multi_value(name){


      var val1=[];
      $('select[name="' + name + '[]"] option:selected').each(function() {
          val1.push($(this).val());
      });
      return val1;
  }

  function reusableReportColum(id){
    let colRes;
    if(id===1){

       colRes =  [
            {data: "name", title: "Name"},
            {data: "member_id", title: "Member ID"},
            {data: "totalpaidmonth", title: "Total Paid Month"},
            {data: "totalmonth", title: "Total Month"},
            {data: "totalpaid", title: "Amount Paid"},
            {data: "ryear", title: "Year"}
        ];

    }

    return colRes;
  }

  function get_title(type){


     if(type===0) {
         return 'Membership Report';
     }

      if(type===1) {
          return 'Member Transport Report';
      }
      if(type===2) {
          return 'Member Tithe Report';
      }
      if(type===3) {

          return 'Member Welfare' +  $('#type_collection').find('option:selected').text() + ' Report';
      }
      if(type===4) {

          return 'Member ' +  $('#type_collection').find('option:selected').text() + ' Report';
      }

      if(type===5) {

          return 'Member Pledge Report';
      }

      if(type===6) {

          return 'Member Debt  Report';
      }
  }


  });



$('.name_selected').change(function () {

    ids = $(this).val().split('_');

    $('#type_collection').html('<option value="">Select option..</option>');

    if(ids[2]==1){

        $('#type_collection').append($('#show_6').html());


    }
    else{
        $('.get_all_welfar').each(function (i,obj) {

            $('#type_collection').append($(this).html());
        });

    }

})
