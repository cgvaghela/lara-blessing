@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!!'Category'!!}
@stop
@section('styles')
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Category header) -->
    <section class="content-header">
        <h1>Category</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Category</li>
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
                    @if(isset($category))
                        {!! Form::model($category, array('route' => array('category.update', $category->id), 'method' => 'PATCH', 'id' => 'category-form', 'files' => true )) !!}
                    @else
                        {!! Form::open(array('route' => 'category.store', 'id' => 'category-form', 'files' => true)) !!}
                    @endif
                    
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            {!! Form::label('name', 'Category Name') !!}
                            {!! Form::text('name', old('name'),array('class'=>'form-control')) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Submit',array('class'=>'btn btn-primary', 'id'=>'submitform')) !!}
                        <a href="{!! URL::route('category.index') !!}" class="btn btn-default">Cancel</a>
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
</script>
@stop