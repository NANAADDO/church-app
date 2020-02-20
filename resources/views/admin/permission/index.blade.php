@extends('layouts.admin')

@section('content')

    <?php
     $right =  Permissions::confirm_user_permission('/admin/permission');
      ?>


    <div class="container-fluid">

        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">

                           @include('crud.top',['routename'=>'admin/permission','modulename'=>'Module Permission','right'=>$right])

                        @if (count($data)>0)

                                <div class="table-full-width">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Module name</th>
                                            <th>Total permission</th>
                                            <th>Permissions</th>
                                            <th class=""></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                <td>{{$row->name}}</td>
                                                <td><span class="badge badge-primary">
                                                    {{Permissions::get_total_permissions_in_module($row->parent_id)}}</span></td>
                                                <td><?php echo \App\Helpers\Event::get_event_badge($row->parent_id);?></td>
                                                <td class="td-actions">
                                                   @include('crud.down',['route'=>'/admin/permission','id'=>$row->id,'right'=>$right])

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                        @else
                            <p class="text-danger" style="padding: 20px;">There are no records</p>
                        @endif




            </div>
        </div>

    </div>
@endsection
