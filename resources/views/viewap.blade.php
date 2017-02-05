@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">:: Access Point ::</div>

                <div class="panel-body access_point_list">
                	<div class="col-md-12">
                		@if(!is_null($access_point))
                		<table class="table table-bordered table-hover table-striped">
                			<thead>
                				<tr>
                					<th>Name</th>
                					<th>Mac address</th>
                          <th>Manage</th>
                				</tr>
                			</thead>
		                    @foreach($access_point as $ap)

		                    	<tr>
		                    		<td>{{ $ap->alias }}</td>
		                    		<td>{{ $ap->mac }}</td>
                            <td><a href="{{ url('/manage/'.$ap->mac) }}" class="btn btn-info"><i class="fa fa-wrench" aria-hidden="true"></i> Manage</a></td>
		                    	</tr>
		                    @endforeach
		                </table>
		                <a href="{{ url('/register_ap') }}" class="btn btn-warning">Add</a>
		                @else
		                <div class="row">

		                	<p>You don't have an Access Point</p>
		                	<a href="{{ url('/register_ap') }}" class="btn btn-warning">Add</a>
		                </div>

		                @endif
                	</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
