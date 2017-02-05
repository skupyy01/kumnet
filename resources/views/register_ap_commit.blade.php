@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">:: Add New Access Point ::</div>

                <div class="panel-body access_point_list">
                	<div class="col-md-12">
                        <h3>Found Access Point</h3>
                        <h5>Mac Address: {{ $access_point }}</h5>
                	</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
