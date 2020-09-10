@extends('frontend.layouts.default')

@section('content')
<!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Team
                    <small>our team behind success</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active">Team</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Team Members -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Our Team</h2>
            </div>
            @if($team)
            @foreach($team as $key => $tm)
            <div class="col-md-4 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" src="{!! $tm->image !='' ? TEAM_IMAGE_ROOT.$tm->image : TEAM_IMAGE_ROOT.'default.png' !!}" alt="{!! $tm->firstname!!} {!! $tm->lastname!!}" title="{!! $tm->firstname!!} {!! $tm->lastname!!}" height="400">
                    <div class="caption">
                        <h3>{!! $tm->firstname !!} {!! $tm->lastname !!}<br>
                            <small>{!! $tm->role !!}</small>
                        </h3>
                        <p>{!! $tm->description !!}</p>
                        <ul class="list-inline">
                            @if($tm->facebook !="")
                            <li><a href="{!! $tm->facebook !!}" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a></li>
                            @endif
                            @if($tm->linkedin !="")
                            <li><a href="{!! $tm->linkedin !!}" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a></li>
                            @endif
                            @if($tm->twitter !="")
                            <li><a href="{!! $tm->twitter !!}" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a></li>
                            @endif
                            @if($tm->googleplus !="")
                            <li><a href="{!! $tm->googleplus !!}" target="_blank"><i class="fa fa-2x fa-google-plus-square"></i></a></li>
                            @endif
                            @if($tm->stackoverflow !="")
                            <li><a href="{!! $tm->stackoverflow !!}" target="_blank"><i class="fa fa-2x fa-stack-overflow"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <!-- /.row -->

        <!-- Footer -->
        @include('frontend.includes.footer')

    </div>
    <!-- /.container -->
@stop