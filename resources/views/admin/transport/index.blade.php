@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/transport');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">

                           @include('crud.top',['routename'=>'admin/transport','modulename'=>'Transport'])
  @if ($data->count())
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Name</th><th>Church ID</th>  <th>Amount</th><th>Expected Amount</th><th>Expected People</th><th>Is it Active ? </th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>

                                        <td>{{ $item->member->surname.' '.$item->member->other_names }}</td><td>{{ $item->member->new_member_id }}</td>  <td>{{ $item->amount }}</td><td>{{ $item->expected_amount }}</td><td>{{ $item->expected_people }}</td>

                                        <td><?php echo \App\Helpers\Member::get_state( $item->txt_state_id);?></td>
                                        <td class="td-actions">
                                 @include('crud.down',['route'=>'admin/transport','id'=>$item->id])

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

@endsection
