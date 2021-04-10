@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
<?php
        $right =  Permissions::confirm_user_permission('/admin/groupcontact');
        ?>
        <div class="product-sales-chart shadow" style="margin-bottom: 5px; min-height: 300px;">
            <div class="portlet-title">
                <?php
                $routename='admin/groupcontact';
                $modulename='Group contact';

                ?>
                <h4 class="card-title">{{$modulename}}
                </h4>
                {!! Form::open(array('method' => 'GET','url' => '/'.$routename,'class'=>'user')) !!}
                {!! Form::label('search', 'Quick Search:') !!}
                {!! Form::text('search',null,array('class' => '')) !!}

                {!! Form::submit('Search', array('class' => 'btn btn-success btn-round btn-users')) !!}

                {!! Form::close() !!}
                <p style="margin-top: 30px;">

                    <a class="btn btn-info btn-users" href="{{ url('/'.$routename) }}" role="button">Show All</a>

                </p>
                <p class="card-category">{{$modulename}} List</p>

  @if ($data->count())
                        <<table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Name</th><th>Total Contact</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>

                                    <td>{{ $item->name }}</td>
                                    <td>0</td>

                                       <td class="td-actions">
                                 @include('crud.down',['route'=>'admin/groupcontact','id'=>$item->id])

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
