@if (!empty($item))


        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th>Name</th><th>Receipt ID</th><th>Church ID</th><th>Amount Paid</th><th>Date Paid</th><th>Date Reversed</th><th>Reversed By</th><th>Collection Type</th>
                    <th>Month Paid</th><th>Year</th><th>Transaction Status</th><th></th>
                </tr>
                </thead>
                <tbody>


                <tr>

                    <td>{{ $item->member->surname.' '.$item->member->other_names}}</td><td>{{ $item->receipt_id}}</td>
                    <td>{{ $item->member->new_member_id }}</td><td>{{ $item->amount_paid }}</td>
                    <td>{{ $item->created_at }}</td><td>{{($item->payment_state==1 ? $item->updated_at:'') }}</td><td>{{ (!empty($item->revuser)?$item->revuser->name:'') }}</td><td>{{ $item->collection->name }}</td><td>{{ (isset($item->months->name)?$item->months->name:'N/A') }}</td><td>{{ $item->year }}</td>

                    <td>

                        @if($item->payment_state==0)
                            <span class="badge badge-success">Commited</span>
                        @else
                            <span class="badge badge-danger">Reversed</span>
                        @endif
                    </td>
                    <td>
                        @if($item->payment_state==0)
                            <input type="checkbox" name="selected_receipt_id" value="{{$item->id}}" class="selected_reversal_child">
                        @endif
                    </td>

                </tr>
                </tbody>
            </table>
        </div>







    <div class="table-responsive" style="margin-top:50px;">
        <p style="font-weight: bolder; border-bottom: solid 1px ghostwhite; text-transform: uppercase; font-size:0.8em;color: red;">Related Payment Receipt</p>
        <table class="table table-borderless">

            <tbody>
            @if (!empty($related) && count($related) > 0)
                @foreach($related  as $item)

                    <tr>

                        <td>{{ $item->member->surname.' '.$item->member->other_names}}</td><td>{{ $item->receipt_id}}</td>
                        <td>{{ $item->member->new_member_id }}</td><td>{{ $item->amount_paid }}</td>
                        <td>{{ $item->created_at }}</td> <td>{{ ($item->payment_state==1 ? $item->updated_at:'') }}</td><td>{{(!empty($item->revuser)?$item->revuser->name:'') }}</td><td>{{ $item->collection->name }}</td><td>{{ (isset($item->months->name)?$item->months->name:'N/A') }}</td><td>{{ $item->year }}</td>

                        <td>

                            @if($item->payment_state==0)
                                <span class="badge badge-success">Commited</span>
                            @else
                                <span class="badge badge-danger">Reversed</span>
                            @endif
                        </td>
                        <td>
                            @if($item->payment_state==0)
                                <input type="checkbox" name="selected_receipt_id" value="{{$item->id}}" class="selected_reversal_child">
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@else
    <p class="text-danger" style="padding: 20px;color:red;">There are no related records</p>
    @endif


@else
    <p class="text-danger" style="padding: 20px;color:red;">There are no records</p>
@endif
