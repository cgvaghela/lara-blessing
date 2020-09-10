@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!! 'Metadata' !!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Metadata</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Metadata</li>
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
                    @if(isset($metadata))
                    {!! Form::model($metadata, array('route' => array('metadata.update', $metadata->id), 'method' => 'PATCH', 'id' => 'metadata-form', 'files' => true )) !!}
                    @else
                    {!! Form::open(array('route' => 'metadata.store', 'id' => 'metadata-form', 'files' => true)) !!}
                    @endif
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('url', 'Url') !!}
                            {!! Form::text('url', old('url'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', old('title'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('meta_title', 'Meta Title') !!}
                            {!! Form::text('meta_title', old('meta_title'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('meta_keywords', 'Meta Keywords') !!}
                            {!! Form::textarea('meta_keywords', old('meta_keywords'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('meta_description', 'Meta Description') !!}
                            {!! Form::textarea('meta_description', old('meta_description'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::route('metadata.index') !!}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close()!!}
                </div> <!-- /.box -->
            </div> <!-- /.col-xs-12 -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop