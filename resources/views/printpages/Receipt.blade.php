
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-12" style="">
                <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1 receipt-format" style="background:white;">
                <p style="text-align:center;"><img src="{{asset('img/Logo_09.png')}}" style="position:relative; margin-top:-30px;"/></p>

	        <h4 style=" text-align:center; font-weight:bolder; text-transform:uppercase;">{{$branch->BranchName}}</h4>
           
                      	      <p style="text-align:center;"><span class="" ><b>OFFICIAL RECEIPT</b></span></p>

							@if(empty($setup))
                        <p><b>Facility Type:</b><span>{{$fac->OtherFacilityName}}</span> <span class="" style="width:auto;float:right;"><b>Date:</b>{{$data->created_at}}</span></p>

                            @else
								<p><span>{{$fac->Location}}</span> <span class="" style="width:auto;float:right;"><b>Date:</b>{{$data->created_at}}</span></p>
                                   <p style=" clear:both;"></p>
								<p><span>Ghana </span> <span class="" style="width:auto;float:right;"><b>Facility No:</b>{{$fac->FacilityNo}}</span></p>
                                     <p style=" clear:both;"></p>
								<p><span>{{$setup->PostalAddress}} </span> <span class="" style="width:auto;float:right;"><b>Tenant Code:</b>{{$ten->TenantCode}}</span></p>
                                 <p style=" clear:both;"></p>
                                <p><span>Phone {{$setup->Mobile}}  </span> <span class="" style="width:auto;float:right;"><b>Start Date:</b>{{$data->PaymentYear}}-01-01</span></p>
                                 <p style=" clear:both;"></p>
                                 <p><span><b>Bill To</b> {{$ten->TenantName}} </span> <span class="" style="width:auto;float:right;"><b>End Date:</b>{{$data->PaymentYear}}-12-31</span></p>
                                 @endif
                                  <p style=" clear:both;"></p>
                                  <div class="" style="padding-bottom:80px; text-align:center;">
                                   <table class="table table-striped"  align="center">
                                   <tr border="1px">
                                    @if(empty($setup))
                          <th>Receipt #</th> <th>Payment Type</th>  <th>Payment Made</th> <th>Paid By</th>

                                    @else
                                   <th>Receipt #</th> <th>Payment Type</th> <th>Total Amount Payable</th> <th>Payment Made</th> <th>Total Paid</th><th>{{$data->PaymentYear}} Balance</th><th>Global Balance</th>
                                   @endif
                                   </tr>
                                   <tr>
                                   <td>{{$data->InvoiceNumber}}</td> <td><b>
                                      @if($data->PaymentType==0)
                                 Cam Charge
                                 @endif
                                 
                                 @if($data->PaymentType==1)
                                 Rent Charge
                                 @endif
 @if($data->PaymentType==3)
                              Other Facility
                                 @endif
                                  @if($data->PaymentType==4)
                              OverPayment
                                 @endif
                                 @if(empty($setup))
                                  </b><td>GHC:{{number_format($data->PaymentAmount,2)}}</td><td>{{$data->PaidBy}}</td>
                                 @else
                                   </b></td><td>GHC:{{number_format($data->RentAmount,2)}}</td><td>GHC:{{number_format($data->PaymentAmount,2)}}</td>
                                   <td>GHC:{{number_format($data->TotalPaid,2)}}</td><td>GHC:{{number_format($data->Balanced,2)}}</td><td>GHC:{{number_format($paymentglobal,2)}}</td>
                                   @endif
                                   
                                   </tr>
                                   
                                </table>   
                                </div> 
                           	<p style="margin:15px 5px 15px 5px;"><span><b>Received By:</b>{{$data->user->name}} </span> <span class="" style="width:auto;float:right;"><b>Amount Paid:</b>GHC : {{number_format($data->PaymentAmount,2)}}</span></p>
	<p style="margin:25px 5px 15px 5px;"><span><b>Signature</b> ...........................................</span></p>
       
       	<p style=" text-align:center;margin:15px 5px 15px 5px; font-size:11px; font-weight:bold;"><span>P.O.BOX CT 2048 CANTONMENTS-ACCRA </span> <span class="" style="">TEL # +233302-670619/+233302-670620</span></p>                             
   </div>
   </div>
   </div>
<style type="text/css">
.receipt-format p{
	padding:0px;
	margin:0px;
	
}
.receipt-format td{
	padding:0px;
	margin:0px;
	font-size:0.8em;
	
}
table {
	margin-top:20px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 2px;
}

tr:nth-child(odd) {
    background-color: #dddddd;
}
</style>