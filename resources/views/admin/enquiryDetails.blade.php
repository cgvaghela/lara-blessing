@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: {!!'Enquiry Details'!!}
@stop
@section('styles')
<style>
    .detailBox > .row:nth-of-type(2n+1) {
        background-color: #f9f9f9;
    }
    .detailBox > .row{
        margin: 0px 0px 5px 0px !important;
    }
    .detailBox > .row{
        padding: 10px !important;
    }
</style>
@stop
{{-- Content --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Enquiry Details</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Enquiry Details</li>
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
                    <?php
                    $name = isset($enquiry) ? $enquiry->fullname : 'NA';
                    $email = isset($enquiry) ? $enquiry->email : 'NA';
                    $subject = isset($enquiry) ? $enquiry->subject : 'NA';
                    $message = isset($enquiry) ? $enquiry->message : 'NA';
                    ?>
                    <div class="box-body detailBox">
                        <div class="row">
                            <div class="col-md-2">Full Name</div>
                            <div class="col-md-10">{!! $name !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Email</div>
                            <div class="col-md-10">{!! $email !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Subject</div>
                            <div class="col-md-10">{!! $subject !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Message</div>
                            <div class="col-md-10">{!! $message !!}</div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!! URL::to('/admin/enquiry') !!}" class="btn btn-primary">Back</a>
                    </div>
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