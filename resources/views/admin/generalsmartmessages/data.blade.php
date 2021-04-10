<div class="table-responsive">
    @if (!empty($data))

        <p style="display: none" id="totalCountContact">{{$count}}</p>
        <table class="table table-borderless">

            <thead>
            <tr id="td_title">

                <th>Name</th>
                <th>Phone #</th>
                <th>Home Town</th>
                <th>Gender</th>
                <th>Profession</th>
                <th>Locality</th>
                <th>Marital Status</th>
                <th>Total Numbers</th>
            </tr>
            </thead>
            <tbody id="td_body">

            @foreach($data as $key=>$item)
                <tr>
                    <td>{{ $item->surname.' '.$item->other_names}}</td>
                    <td>{{ $item->phone_numbers }}</td>
                    <td>{{ $item->home_town }}</td>
                    <td>{{ $item->gender_name }}</td>
                    <td>{{ (isset($item->profession)?$item->profession:'N/A') }}</td>
                    <td>{{ $item->locality }}</td>
                    <td>{{ $item->marital_status }}</td>
                    <th><span class="badge badge-info">{{ count(explode('/',$item->phone_numbers)) }}</span></th>

                </tr>
            @endforeach

            </tbody>


        </table>


    @else
        <p class="text-danger" style="padding: 20px;color:red;">There are no records</p>
    @endif
</div>
