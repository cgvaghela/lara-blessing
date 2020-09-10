@extends('admin.layouts.default')
@section('title')
@parent :: {!!'Dashboard'!!}
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! URL::to('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{!! $pages !!}</h3>
                        <p>Total Static Page</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{!!URL::to('admin/pages')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{!! $sliders !!}</h3>
                        <p>Total Slider</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-images"></i>
                    </div>
                    <a href="{!!URL::to('admin/sliders')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="clearfix"></div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{!! $totalActive !!}</h3>
                        <p>Active Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{!!URL::to('admin/team')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{!! $totalArchived !!}</h3>
                        <p>Archived Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{!!URL::to('admin/portfolio')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{!! $totalClose !!}</h3>
                        <p>Close Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-settings"></i>
                    </div>
                    <a href="{!!URL::to('admin/services')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="clearfix"></div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{!! $flagged !!}</h3>
                        <p>Total Flagged</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-email-unread"></i>
                    </div>
                    <a href="{!!URL::to('admin/enquiry')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{!! $paires !!}</h3>
                        <p>Total Paires</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-email-unread"></i>
                    </div>
                    <a href="{!!URL::to('admin/enquiry')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{!! $banned !!}</h3>
                        <p>Total Banned IPs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-email-unread"></i>
                    </div>
                    <a href="{!!URL::to('admin/enquiry')!!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop
