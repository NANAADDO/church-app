  $(document).ready(function () {
     //alert('s ');
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
      let startMonth = $('select[name=start_month]');
      let endMonth = $('select[name=end_month]');
      $('#search_form').on('click', function(e) {

          stYr = $(startYear).val();
          enYr =  $(endYear).val();
          stMt = $(startMonth).val();
          enMt =  $(endMonth).val();

          if( stYr !=="" &&  enYr !==""){
              $(endMonth).prop('selectedIndex', 0);
              $(startMonth).prop('selectedIndex', 0);
             if(parseInt(enYr) <= parseInt(stYr)){
               alert('Opps!! End Year Must Be Greater than the Start Year.');
                 $(endYear).focus();
               return false;
             }
          }

          if( stMt !=="" ||  enMt !=="") {
              if (stMt === "") {
                  alert('Opps!! Start Month Not Specify');
                  $(startMonth).focus();
                  return false;
              }
          }
          if( stMt !=="" &&  enMt !==""){
              if(parseInt(enMt) <= parseInt(stMt)){
                  alert('Opps!! End Month Must Be Greater than the Start Month.');
                  $(endMonth).focus();
                  return false;
              }
           if(stYr ==="")  {

               alert('Opps!! Filter between Months requires Start Year.');

           }
          }

          if(parseInt($('select[name=fetch_type]').val())===4){
              if( stYr ==="" ||  enYr ===""){

                  alert('Opps!! Both Start and End Year must be specify..');
                  $(endYear).focus();
                  return false;
              }
          }

          $('#td_title').html('');
          $('#td_body').html('');
          var json_data =reportcol(getcoltype);

          console.log(json_data);

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
            {data: "id", title: "#"},
            {data: "name", title: "Name"},
            {data: "new_member_id", title: "Member ID"},
            {data: "oldID", title: "OLD Member ID"},
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
        console.log(true);

        res = [

            {data: "name", title: "Name"},
            {data: "member_id", title: "Member ID"},
            {data: "oldID", title: "OLD Member ID"},
            {data: "descrip", title: "Transport Description"},
            {data: "tamount", title: "Total"},
            {data: "tpaid", title: "Amount Paid"},
            {data: "tbal", title: "Balance"},
            {data: "ryear", title: "Year"}


        ];

    }

    if(type===2 || type===3) {

        if(parseInt($('#type_collection').val())===6){
            if(fetchValue===fetchID || fetchValue===4) {

                res =reusableReportColum(2);
            }
else {
                res = [
                    {data: "name", title: "Name"},
                    {data: "member_id", title: "Member ID"},
                    {data: "oldID", title: "OLD Member ID"},
                    {data: "colname", title: "Collection Type"},
                    {data: "tamount", title: "Amount"},
                    {data: "tpaid", title: "Amount Paid"},
                    {data: "tbal", title: "Balance"},
                    {data: "ryear", title: "Year"},
                    {data: "date_paid", title: "Date Paid"}
                ];
            }
        }
        else {
              if(fetchValue===fetchID || fetchValue===4) {

                  res =reusableReportColum(1);
              }


              else {
                  res = [
                      {data: "name", title: "Name"},
                      {data: "member_id", title: "Member ID"},
                      {data: "oldID", title: "OLD Member ID"},
                      {data: "mname", title: "Month"},
                      {data: "tpaid", title: "Amount Paid"},
                      {data: "ryear", title: "Year"},
                      {data: "date_paid", title: "Date Paid"}
                  ];
              }
        }
    }

    if(type===4) {
        if(fetchValue===fetchID || fetchValue===4) {

            res =reusableReportColum(2);
        }
        else {
            res = [
                {data: "name", title: "Name"},
                {data: "member_id", title: "Member ID"},
                {data: "oldID", title: "OLD Member ID"},
                {data: "colname", title: "Collection Type"},
                {data: "tamount", title: "Amount"},
                {data: "tpaid", title: "Amount Paid"},
                {data: "tbal", title: "Balanced Left"},
                {data: "ryear", title: "Year"},
                {data: "date_paid", title: "Date Paid"}
            ];
        }
        }


    if(type===5) {
        if(fetchValue===fetchID || fetchValue===4){
            console.log(true);

            res =reusableReportColum(1);

        }
        else {

            res = [
                {data: "name", title: "Name"},
                {data: "member_id", title: "Member ID"},
                {data: "oldID", title: "OLD Member ID"},
                {data: "mname", title: "Month"},
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
                {data: "oldID", title: "OLD Member ID"},
                {data: "colname", title: "Collection Type"},
                {data: "descrip", title: "Transport Description"},
                {data: "tmonth", title: "Duration - Months"},
                {data: "tpaidmonth", title: "No: of Months Paid"},
                {data: "tamount", title: "Amount Due"},
                {data: "tpaid", title: "Amount Paid"},
                {data: "tbal", title: "Balance"},
                {data: "ryear", title: "Year"}
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
                    d.end_month = $('select[name=end_month]').val();
                    d.start_month = $('select[name=start_month]').val();
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
                    messageTop: 'Report Generated Based On Filter Below'
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
    if(id===1) {

        colRes = [
            {data: "name", title: "Name"},
            {data: "member_id", title: "Member ID"},
            {data: "oldID", title: "OLD Member ID"},
            {data: "totalpaidmonth", title: "No: of Months Paid"},
            {data: "totalmonth", title: "Duration - Months"},
            {data: "totalpaid", title: "Amount Paid"},
            {data: "ryear", title: "Year"}
        ];
    }
        if(id===2){

            colRes =  [
                {data: "name", title: "Name"},
                {data: "member_id", title: "Member ID"},
                {data: "oldID", title: "OLD Member ID"},
                {data: "colname", title: "Collection Type"},
                {data: "tamount", title: "Amount"},
                {data: "tpaid", title: "Amount Paid"},
                {data: "tbal", title: "Balance"},
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
