@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!! 'Pages' !!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Pages</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pages</li>
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
                    @if(isset($page))
                        {!! Form::model($page, array('route' => array('pages.update', $page->id), 'method' => 'PATCH', 'id' => 'page-form', 'files' => true )) !!}
                    @else
                        {!! Form::open(array('route' => 'pages.store', 'id' => 'page-form', 'files' => true)) !!}
                    @endif
                    <div class="box-body">
                        {{--<div class="form-group has-feedback">
                            {!! Form::label('slug', 'Page Slug') !!}
                            {!! Form::text('slug', old('slug'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>--}}
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('title', 'Page Title') !!}
                            {!! Form::text('title', old('title'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
                            {!! Form::label('content', 'Page Content') !!}
                            {!! Form::textarea('content', old('content'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::route('pages.index') !!}" class="btn btn-default">Cancel</a>
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
    CKEDITOR.replace('content', {
        //uiColor:"#532F12",
        //toolbar: 'BlogToolbar',
        toolbar: 'MyToolbar',
    });
</script>
@stop