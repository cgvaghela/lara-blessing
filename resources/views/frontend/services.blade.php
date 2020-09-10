@extends('frontend.layouts.default')

@section('content')
<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Services
                <small>What you will get from us</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/">Home</a>
                </li>
                <li class="active">Services</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Service Panels -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Services Panels</h2>
        </div>
        @if($services)
        @foreach($services as $key => $service)
        <div class="col-md-3 col-sm-6">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    <span class="fa-stack fa-5x">
                        <img class="img-responsive" src="{!! $service->image !='' ? SERVICE_IMAGE_ROOT.$service->image : SERVICE_IMAGE_ROOT.'default.png' !!}" alt="{!! $service->title !!}" title="{!! $service->title !!}" height="200">
                    </span>
                </div>
                <div class="panel-body">
                    <h4>{!! $service->title !!}</h4>
                    <p>{!! \App\Helpers\Common::shorteningString($service->description,50) !!}</p>
                    <a href="javascript:;" class="btn btn-primary learn-more" id="{!! $service->id !!}">Learn More</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    @if($services)
    @foreach($services as $key => $service)
    <div class="row service-details" id="service-{!! $service->id !!}">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>{!! $service->title !!}</h4>
                    <p>{!! $service->description !!}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <!-- /.row -->

    <!-- Footer -->
    @include('frontend.includes.footer')

</div>
<!-- /.container -->
@stop
{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.service-details').hide();
        $(".learn-more").click(function(){
           var serviceId = $(this).attr('id');
           var detailDiv = '#service-'+serviceId;
           $('.service-details:not('+detailDiv+')').hide();
           if(!$(detailDiv).is(':visible')){
               $(detailDiv).slideDown();
           }
        });
    });
</script>
@stop