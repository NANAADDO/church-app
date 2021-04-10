<td class="td-actions">
    <div class="">
        @if(in_array(2,$right))
        <a href="{{ url($route.'/'.$id) }}">
            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-info" data-original-title="View data">
                <i class="fa fa-eye" style="font-size:16px; color: #5bc0de;"></i>
            </button>
        </a>
@endif
            @if(in_array(3,$right))
        <a href="{{  url($route.'/'.$id.'/edit') }}">
            <button type="button" data-toggle="tooltip" title="" class="btn btn-link <btn-simple-primary" data-original-title="Edit data">
                <i class="fa fa-edit" style="font-size:16px;"></i>
            </button>
        </a>
@endif

            @if(in_array(4,$right))
        {!! Form::open(['method' => 'DELETE','url' => [$route, $id],'style' => 'display:inline']) !!}


            <button type="submit" onclick="return confirm('Are you sure to delete this item?')" data-toggle="tooltip" title="" class="btn btn-link <btn-simple-primary" data-original-title="Delete data">
                <i class="fa fa-times" style="font-size:16px;color:red;"></i>
            </button>
                {!! Form::close() !!}
            @endif


            @if($route =='admin/smsgroups')
                <a href="" role="button" class="btn btn-xs  btn-primary"><i class="fa fa-user"></i>Manage group contact</a>
            @endif
            @if($route =='admin/users')
                <a href="{{url('admin/user/resetpasword/'.$id)}}" role="button" class="btn btn-xs  btn-primary" onclick="return confirm('Are you sure you want to reset user password?')"><i class="fa fa-user-secret"></i>Reset Password</a>
            @endif

    </div>



</td>
