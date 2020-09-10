@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!!'Change Password'!!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Change Password</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Notifications -->
                @include('admin.includes.notifications')
                <!-- ./ notifications -->
            </div>
            <div class="col-xs-12">
                <div class="box">
                        {!! Form::open(['route' => 'admin.password.change', 'id' => 'change-password-form', 'novalidate' => 'novalidate']) !!}
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('password','Old Password') !!}
                            {!! Form::password('old_password', array('class'=>'form-control','id' => 'old_password')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('password','New Password') !!}
                            {!! Form::password('password', array('class'=>'form-control','id' => 'password')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('cpassword','Confirm Password:') !!}
                            {!! Form::password('password_confirmation', array('class'=>'form-control','id' => 'password_confirmation')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Save',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::previous() !!}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close()!!}
                </div> <!-- /.box -->
            </div> <!-- /.col-xs-12 -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop