@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!! 'Admin Profile' !!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Admin Profile</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin Profile</li>
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
            <?php // print_r($profile); ?>
            <div class="col-xs-12">
                <div class="box">
                    @if(isset($profile))
                        {!! Form::model($profile, ['route' => array('profile.update', $profile->id),'method' => 'PATCH', 'id' => 'profile-form', 'files' => true]) !!}
                   @endif
                    
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?php echo $profile->id; ?>" >
                        <div class="form-group has-feedback">
                            {!! Form::label('firstname', 'First Name') !!}
                            {!! Form::text('firstname', old('firstname'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('lastname', 'Last Name') !!}
                            {!! Form::text('lastname', old('lastname'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', old('email'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span id="loader" class="help-block"></span>
                        </div>
                       
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                         <a href="{!! URL('admin') !!}" class="btn btn-default">Cancel</a> 
                   </div>
                    
                    {!! Form::close() !!}
                </div>  
            </div>  
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop