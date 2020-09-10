@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!! 'Slider' !!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Slider header) -->
    <section class="content-header">
        <h1>Sliders</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sliders</li>
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
                    @if(isset($slider))
                    {!! Form::model($slider, array('route' => array('sliders.update', $slider->id), 'method' => 'PATCH', 'id' => 'slider-form', 'files' => true )) !!}
                    @else
                    {!! Form::open(array('route' => 'sliders.store', 'id' => 'slider-form', 'files' => true)) !!}
                    @endif
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('image_name', 'Slider Name') !!}
                            {!! Form::text('image_name', old('image_name'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('link', 'Slider Link') !!}
                            {!! Form::text('link', old('link'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('imgPath', 'Slider Image') !!}
                            {!! Form::file('imgPath', array('class'=>'form-control','style'=>'height:auto;')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    @if(isset($slider) && $slider->imgPath!="")
                    <div class="form-group">
                        <?php $image = SLIDER_IMAGE_ROOT . $slider->imgPath ?>
                        <img src="{!! $image !!}" width="150">
                    </div>
                    @endif
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::route('sliders.index') !!}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close()!!}
                </div> <!-- /.box -->
            </div> <!-- /.col-xs-12 -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop