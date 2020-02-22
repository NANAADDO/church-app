@if ($data->count())
<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Name</th><th>Receipt ID</th><th>Church ID</th><th>Amount Paid</th><th>Date Paid</th><th>Collection Type</th>
            <th>Month Paid</th><th>Year</th><th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
        <tr>

            <td>{{ $item->member->surname.' '.$item->member->other_names}}</td><td>{{ $item->receipt_id }}</td><td>{{ $item->member->new_member_id }}</td><td>{{ $item->amount_paid }}</td>
            <td>{{ $item->date_paid }}</td><td>{{ $item->collection->name }}</td><td>{{ (isset($item->months->name)?$item->months->name:'N/A') }}</td><td>{{ $item->year }}</td>
            @include('crud.print',['id'=>$item->id])
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
</div>

@else
<p class="text-danger" style="padding: 20px;">There are no records</p>
@endif
