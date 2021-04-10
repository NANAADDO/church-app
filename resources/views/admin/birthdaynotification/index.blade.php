@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/birthdaynotification');
        ?>
    <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
        <div class="portlet-title">
            @csrf()
            @include('crud.top',['routename'=>'admin/birthdaynotification','modulename'=>'BirthDay Notification'])
            @if ($data->count())
                <div class="row">
                <div class="col-md-6" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <section style="margin-bottom:30px; ">
                            {!!	Form::select('MessageID',DBSELOPTION::get_all_textMessages(),null,array('class'=>'form-control', 'id'=>'messagepop','placeholder'=>'Select Message'  )) !!}
                        </section>
                        <p style="float:left; width:auto;">No of characters : <span id="display_count" style=" color:red;">0</span></p>
                        <p style="float:right; width:auto;">SMS Used : <span id="usedsms" style=" color:red;">0</span></p>
                    </div>
                    {!! Form::hidden('sms_qty',null, array('id'=>'smscount','class' => 'form-control') ) !!}
                    {!! Form::hidden('total_characters',null, array('id'=>'characters','class' => 'form-control') ) !!}

                    <textarea class="form-control form-control-user" id="charactno" placeholder="" style="border-radius:0px;" name="content" cols="50" rows="3"></textarea>

                </div>
                <div class="col-md-6" style="margin-bottom: 20px;">
                    <div class="col-md-12" style="">
                        {!!	Form::select('SenderTagID',DBSELOPTION::get_all_tags(),null,array('class'=>'form-control','id'=>'sendtagname','placeholder'=>'Select a SenderTag Name'  )) !!}
                    </div>

                </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Member ID</th>
                            <th>BirthDay</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->other_names.' '.$item->surname }}</td>
                                <td>{{ $item->new_member_id }}</td>
                                <td>{{ \App\Helpers\GeneralVariables::convertdateToWords($item->date_of_birth) }}</td>
                                <td class="td-actions">
                                    @include('crud.down',['route'=>'admin/messagetag','id'=>$item->id])

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
            </div>





@endsection
