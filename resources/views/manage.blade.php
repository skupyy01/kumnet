@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-2">
        <div class="panel panel-default">
          <div class="panel-heading">:: Control Panel ::</div>
          <div class="panel-body">
            <div class="list-group">
                <a href="#" id="btn-information" class="list-group-item">Information</a>
                <a href="#" id="btn-authentication" class="list-group-item">Authentication</a>
                <a href="#" id="btn-tcpip" class="list-group-item">TCP/IP</a>
                <a href="#" id="btn-ssid" class="list-group-item">SSID</a>
            </div>
          </div>
        </div>
      </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">:: Access Point :: <strong>{{ $access_point->alias }}</strong></div>
                <div class="panel-body access_point_list">
                  <div id="information">
                    <div class="col-md-4">
                      <img src="http://www.tplink.com/res/images/products/M5250_un_V1_default_20150702887.jpg" alt="">
                  	</div>
                    <div class="col-md-8">
                      <p><b>Access Point Name:</b> {{$access_point->alias}}</p>
                      <p><b>Vendor:</b> {{$machine}}</p>
                      <p><b>Model:</b> {{$model}}</p>
                      <p><b>Mac Address:</b> {{$access_point->mac}}</p>
                      <p><b>Public Ip:</b> {{$public_ip}}</p>
                      <p><b>Private Ip:</b> {{$private_ip}}</p>
                    </div>
                  </div>
                  <div id="authentication">
                    <div class="col-md-6 col-md-offset-3" style="text-align:center;">
                      {!! Form::open(['url' => 'set_root_pass']) !!}
                      {!! Form::hidden('mac', $access_point->mac) !!}
                      <div class="form-group">
                          {!! Form::text('user', 'root', ['class' => 'form-control', 'disabled' => 'true']) !!}
                      </div>
                      <div class="form-group">
                          {!! Form::text('pass', null, ['class' => 'form-control','placeholder' => 'Root Password']) !!}
                      </div>
                          {!! Form::submit('Set Password',['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                    </div>
                  </div>
                  <div id="tcpip">
                    <div class="col-md-6 col-md-offset-3">
                      {!! Form::open(['url' => 'set_ip']) !!}
                      {!! Form::hidden('mac', $access_point->mac) !!}
                      <div class="form-group">
                        <label for="protocol">Protocol</label>
                        <select name="protocol" class="form-control">
                          <option value="dhcp">DHCP</option>
                          <option value="static">Static</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="privateip">Private Ip</label>
                          {!! Form::text('privateip', $private_ip, ['class' => 'form-control','placeholder' => 'Private Ip']) !!}
                      </div>
                      <div class="form-group">
                        <label for="mask">Subnet Mask</label>
                          {!! Form::text('mask', $subnet_mask, ['class' => 'form-control','placeholder' => 'Subnet Mask']) !!}
                      </div>
                      <div class="form-group">
                        <label for="mask">Gateway</label>
                          {!! Form::text('gateway', $gateway, ['class' => 'form-control','placeholder' => 'Subnet Mask']) !!}
                      </div>
                      <div class="form-group">
                        <label for="mask">DNS</label>
                          {!! Form::text('dns1', null, ['class' => 'form-control','placeholder' => 'DNS1']) !!}
                          {!! Form::text('dns2', null, ['class' => 'form-control','placeholder' => 'DNS2']) !!}
                      </div>
                          {!! Form::submit('Apply',['class' => 'btn btn-success']) !!}
                      {!! Form::close() !!}
                    </div>
                  </div>
                  <div id="ssid">
                    <div class="col-md-6 col-md-offset-3">
                      SSID
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
