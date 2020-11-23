
<p style="margin-bottom: 30px;">
<button type="button" class="btn btn-warning btn-round btn-users" >View Group Contact List</button>
    <span style="display: none;" id="show_selected_but" ><button type="button" data-toggle="modal" data-target="#PrimaryModalalert" class="btn btn-info btn-round btn-users">View <span class="total-select" style=""></span> Contact Selected</button></span>
</p>
{!!Form::hidden('groupid',$data->id)!!}
<p style="display: none" id="ids"></p>
<div class="table-responsive">
    <table class="table" style="border: none;">
        <tr class="active">
            <th>Contact Name</th>

            <th>Member ID</th>
            <th>Number</th>
            <th>Add Selected</th>
            <th></th>
        </tr>
        @foreach($contact as $row)

           <tr class="delete-{{$row->id}} allcontactlist">

                <td><b>{{$row->other_names }}{{$row->surname or 'DEFAULT'}}</b></td>
                <td>{{$row->member_id}}</td>
                    <td>{{$row->phone_numbers}}</td>
                <td>    <input class="form-check-input selectcheck" type="checkbox" id="select-{{$row->id}}" value="{{$row->id}}">

                </td>



                <td><a href="javascript:void(0);"
                       class="btn btn-info btn-xs" title="Add Contact">
                        Add Contact <i class="glyphicon glyphicon-plus"></i>
                    </a></td>
            </tr>

        @endforeach
    </table>
</div>
<div class="pagination-wrapper"> {!! $contact->appends(['search' => Request::get('search')])->render() !!} </div>





@include('crud.button',['formMode'=>$formMode,'url'=>$route,'urledit'=>!empty($data)?$route.'/'.$data->id.'/edit':'#'])

@include('Modals.modals')
