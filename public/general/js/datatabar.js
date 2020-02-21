  $(document).ready(function () {
      var getcoltype = $('#get_col_type').text();
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
              "lengthMenu": [ [10, 25, 50,100,150,200, -1], [10, 25, 50,100,150,200, "All"] ],
              responsive: true
          });



    /*****************SEARCH MEMBER DETAILS BASED ON FILTER*******************/

      $('#search_form').on('click', function(e) {


          $('#td_title').html('');
          $('#td_body').html('');
          var json_data =reportcol(getcoltype);

          var i;

          $("#tableDiv").empty();
          $("#tableDiv").append('<table id="example" class="display " style="width:100%;text-align: center;" ><thead><tr id="td_title">' +
              '</tr></thead><tbody id="td_body"></tbody></table>');

          for (i = 0; i < json_data.length; i++) {
              $('#td_title').append('<th></th>');
          }

         $('#example').DataTable().destroy();



          purl = $('#get_searcch_endpoint').text();
          alert(purl);
         //console.log($('#type_collection').val());

          fetch_data(true,purl);

          e.preventDefault();
      });



/************************************DATATABLE'S REUSABLE FUNCTIONS HERE**********************************/

function reportcol(type){
    var res

    if(type==0) {

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

    if(type==1) {

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

    if(type==2 || type==3) {


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

    if(type==4) {
            res =  [
                {data: "name", title: "Name"},
                {data: "member_id", title: "Member ID"},
                {data: "tamount", title: "Amount"},
                {data: "colname", title: "Collection Type"},
                {data: "tpaid", title: "Amount Paid"},
                {data: "tbal", title: "Balanced Left"},
                {data: "ryear", title: "Year"},
                {data: "date_paid", title: "Date Paid"}
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
                    d.start_date = $('input[name=start_date]').val();
                    d.end_date = $('input[name=end_date]').val();
                    d.welfare_state = $('select[name=welfare_state]').val();
                    d.gender = $('select[name=gender]').val();
                    d.by_age = $('input[name=by_age]').val();
                    d.marital_status = $('select[name=marital_status]').val();
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
            "lengthMenu": [ [10, 25, 50,100,150,200, -1], [10, 25, 50,100,150,200, "All"] ],
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


  function get_title(type){


     if(type==0) {
         return 'Church member Report';
     }

      if(type==1) {
          return 'Member Transport Report';
      }
      if(type==2) {
          return 'Member Tithe Report';
      }
      if(type==3) {

          return 'Member Welfare' +  $('#type_collection').find('option:selected').text() + ' Report';
      }
      if(type==4) {

          return 'Member ' +  $('#type_collection').find('option:selected').text() + ' Report';
      }
  }


  });
