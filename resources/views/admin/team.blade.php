@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!! 'Team' !!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Team</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Team</li>
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
                    @if(isset($team))
                        {!! Form::model($team, array('route' => array('team.update', $team->id), 'method' => 'PATCH', 'id' => 'team-form', 'files' => true )) !!}
                    @else
                        {!! Form::open(array('route' => 'team.store', 'id' => 'team-form', 'files' => true)) !!}
                    @endif
                    <div class="box-body">
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
                            {!! Form::label('role', 'Role') !!}
                            {!! Form::text('role', old('role'),array('class'=>'form-control')) !!}
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
                            {!! Form::label('googleplus', 'Googleplus') !!}
                            {!! Form::text('googleplus', old('googleplus'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('stackoverflow', 'Stackoverflow') !!}
                            {!! Form::text('stackoverflow', old('stackoverflow'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', old('description'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image', array('class'=>'form-control','style'=>'height:auto;')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        @if(isset($team))
                        <div class="form-group">
                            <?php $photo = $team->image !="" ? TEAM_IMAGE_ROOT.$team->image : TEAM_IMAGE_ROOT.'default.png' ?>
                            <img src="{!! $photo !!}" width="150">
                        </div>
                        @endif
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::route('team.index') !!}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close()!!}
                </div> <!-- /.box -->
            </div> <!-- /.col-xs-12 -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop
{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    CKEDITOR.replace('description', {
        toolbar: 'BlogToolbar',
    });
</script>
@stop