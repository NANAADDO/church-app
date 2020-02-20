@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <?php
        $right =  Permissions::confirm_user_permission('/admin/users');
        ?>

        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">
                @include('crud.top',['routename'=>'admin/users','modulename'=>'Users'])
                @if ($data->count())
                    <div class="table-full-width">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th> <th>User Name</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>

                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td class="td-actions">
                                            @include('crud.down',['route'=>'admin/users','id'=>$item->id])

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    {!! $data->links() !!}
                @else
                    <p class="text-danger" style="padding: 20px;">There are no records</p>
                @endif
        </div>
    </div>
@endsection
