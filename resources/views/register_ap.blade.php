@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">:: Add New Access Point ::</div>

                <div class="panel-body access_point_list">
                	<div class="col-md-12">
                        
                        {!! Form::open(['url' => 'register_ap']) !!}
                        <div class="form-group">
                            {!! Form::text('mac', null, ['class' => 'form-control', 'placeholder' => 'Mac address']) !!}
                        </div>
                            {!! Form::submit('Add New',['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                        @if(!empty($message))
                            @if($message === 'no')
                                <b>Not Found Access Point</b>
                            @endif
                            @if($message === 'not free')
                                <b>Access Point Exist</b>
                            @endif
                            @if($message === 'free')
                                <b>Add Your Access Point Success</b>
                            @endif
                        @endif
                        @if(!is_null($access_points))
                            <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mac address</th>
                                </tr>
                            </thead>
                            @foreach($access_points as $ap)
                                
                                <tr>
                                    <td>{{ $ap->alias }}</td>
                                    <td>{{ $ap->mac }}</td>
                                </tr>
                            @endforeach
                        </table>
                        @endif
                	</div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
