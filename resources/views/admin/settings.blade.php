@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!!'Settings'!!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Settings</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
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
                    @if(isset($setting))
                        {!! Form::model($setting, array('route' => array('settings.update', $setting->id), 'method' => 'PATCH', 'id' => 'setting-form', 'files' => true )) !!}
                        
                    @else
                        {!! Form::open(array('route' => 'settings.store', 'id' => 'setting-form', 'files' => true)) !!}
                    @endif
                    {!! Form::hidden('setting_id', isset($setting) ? $setting->id : 0 ,array('class'=>'form-control', 'id' => 'setting_id')) !!}
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('site_title', 'Site Title') !!}
                            {!! Form::text('site_title', old('site_title'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('Address', 'Address') !!}
                            {!! Form::textarea('address', old('address'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('map', 'Embed Map Iframe') !!}
                            {!! Form::text('map', old('map'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', old('email'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('phone', 'Phone No') !!}
                            {!! Form::text('phone', old('phone'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('facebook', 'Facebook') !!}
                            {!! Form::text('facebook', old('facebook'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('twitter', 'Twitter') !!}
                            {!! Form::text('twitter', old('twitter'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('linkedin', 'Linkedin') !!}
                            {!! Form::text('linkedin', old('linkedin'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('googleplus', 'Google Plus') !!}
                            {!! Form::text('googleplus', old('googleplus'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('logo', 'Logo') !!}
                            {!! Form::file('logo', array('class'=>'form-control','style'=>'height:auto;')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        @if(isset($setting))
                        <div class="form-group">
                            @if($setting->logo)
                                <img src="{!! LOGO_ROOT.$setting->logo !!}" width="150">
                            @endif
                        </div>
                        @endif
                        
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::route('settings.index') !!}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close()!!}
                </div> <!-- /.box -->
            </div> <!-- /.col-xs-12 -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop