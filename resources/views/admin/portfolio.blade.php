@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!!'Portfolio'!!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Portfolio</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Portfolio</li>
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
                    @if(isset($portfolio))
                        {!! Form::model($portfolio, array('route' => array('portfolio.update', $portfolio->id), 'method' => 'PATCH', 'id' => 'portfolio-form', 'files' => true )) !!}
                    @else
                        {!! Form::open(array('route' => 'portfolio.store', 'id' => 'portfolio-form', 'files' => true)) !!}
                    @endif
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('portfolio_category', 'Portfolio Category') !!}
                            {!! Form::select('category_id', $categoryList, old('category_id') ,array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', old('title'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('link', 'Project Link') !!}
                            {!! Form::text('link', old('link'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', old('description'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image', array('class'=>'form-control', 'style'=>'height:auto;')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        @if(isset($portfolio))
                        <div class="form-group">
                            <?php $photo = $portfolio->image !="" ? PORTFOLIO_IMAGE_ROOT.$portfolio->image : PORTFOLIO_IMAGE_ROOT.'default.png' ?>
                            <img src="{!! $photo !!}" width="150">
                        </div>
                        @endif
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::route('portfolio.index') !!}" class="btn btn-default">Cancel</a>
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