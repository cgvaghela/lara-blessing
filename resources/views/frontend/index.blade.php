@extends('frontend.layouts.default')

@section('content')
<!-- Header Carousel -->
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    
    <ol class="carousel-indicators">
        @foreach ($sliders as $key => $slider)
        <li data-target="#myCarousel" data-slide-to="{!! $key !!}" class="{!! $key==0 ? 'active' : '' !!}"></li>
        @endforeach
    </ol>
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach ($sliders as $key => $slider)
        <div class="item {!! $key==0 ? 'active' : '' !!}">
            <div class="fill" style="background-image:url('{!! SLIDER_IMAGE_ROOT.$slider->imgPath !!}');"></div>
        </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>
<!-- Page Content -->
<div class="container">
    {!! $page->content !!}
    @include('frontend.includes.footer')
</div>
<!-- /.container -->
@stop
