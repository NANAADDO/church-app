@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">

                           @include('crud.top',['routename'=>'admin/churchgroup','modulename'=>'Church group'])
  @if ($data->count())
                    <div class="table-full-width">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th><th>Description</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>

                                        <td>{{ $item->name }}</td><td>{{ $item->description }}</td>
                                       <td class="td-actions">
                                 @include('crud.down',['route'=>'admin/churchgroup','id'=>$item->id])

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
