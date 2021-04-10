@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <?php
        $right =  Permissions::confirm_user_permission('/admin/generalsmartmessages');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">
                @csrf()
                @include('crud.top',['routename'=>'admin/generalsmartmessages','modulename'=>'General Smart Messages'])
                @if ($data->count())
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Member Name</th>
                                <th>Phone Number</th><th>message Tag</th><th>Message</th>
                                <th>State</th><th>Scheduled Date</th>
                                <th>Date Sent</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>

                                    <td>{{ $item->member->surname.' '.$item->member->other_names}}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->tag_name }}</td>
                                    <td>{{ $item->message->content }}</td>
                                    <td>{{ $item->sms_delivery_state }}</td>
                                    <td>{{ $item->date_scheduled }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="td-actions">
                                        @include('crud.downwithjs',['route'=>'admin/memberdetails','id'=>$item->id])

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                @else
                    <p class="text-danger" style="padding: 20px;">There are no records</p>
                @endif

            </div>
        </div>
    </div>


    <div id="PrimaryModalalert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog" >
        <div class="modal-dialog" style="width: 90%;text-align: match-parent;">
            <div class="modal-content">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">


                    <fieldset style="border: 1px solid #cce5ff; margin-top: 40px;">
                        <legend style="font-size: 14px; background-color:#076df1d4;color: white;font-size:1.0em;font-weight: bold;  max-width:fit-content; padding: 15px 5px 10px 5px; border-radius: 10px 10px 0px 0px;">MEMBER PROFILE DETAILS</legend>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                                    <ul id="myTabedu1" class="tab-review-design">
                                        <li class="active"><a href="#description">Education </a></li>
                                        <li><a href="#INFORMATION">Employment </a></li>
                                        <li><a href="#family">Family</a></li>
                                        <li><a href="#marital">Marital </a></li>
                                        <li><a href="#religion">Religious </a></li>
                                        <li><a href="#groups">Groups</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <section class="ajax_show_detail">

                        </section>
                    </fieldset>

                </div>

                <div class="modal-footer">
                    <a data-dismiss="modal" href="#">Cancel</a>

                </div>
            </div>
        </div>
    </div>

@endsection
