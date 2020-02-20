<h4 class="card-title">{{$modulename}}
</h4>
{!! Form::open(array('method' => 'GET','url' => '/'.$routename,'class'=>'user')) !!}
{!! Form::label('search', 'Quick Search:') !!}
{!! Form::text('search',null,array('class' => '')) !!}

{!! Form::submit('Search', array('class' => 'btn btn-success btn-round btn-users')) !!}

{!! Form::close() !!}
<p style="margin-top: 30px;">
    @if(in_array(1,$right))
    <a class="btn btn-default btn-users" href="{{ url('/'.$routename.'/create') }}" role="button">Add new data</a>
@endif
    <a class="btn btn-info btn-users" href="{{ url('/'.$routename) }}" role="button">Show All</a>

</p>
<p class="card-category">{{$modulename}} List</p>
