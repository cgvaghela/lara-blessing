@extends('frontend.layouts.default')

@section('styles')
<style>
    #infscr-loading {
        position: absolute;
        text-align: center;
        bottom: 40px;
        left: 42%;
        z-index: 100;
        background: white;
        background: gray;
        padding: 20px;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
    }

    /* General style */
    .grid-gallery ul {
        list-style:none;
        margin:0;
        padding:0;
    }
    .grid-gallery figure {
        margin:0;
    }
    .grid-gallery figure img {
        display:block;
        width:100%;
    }
    .grid-gallery figcaption h3 {
        margin:0;
        padding:0 0px 0;
        color:#fff;
        font-size:17px;
        font-weight:300;
    }
    
    .grid-gallery figcaption h3 a{
        color:#fff;
    }
    
    .grid-gallery figcaption p {
        margin:0;
        font-size: 12px;
    }
    /* Grid style */
    .grid-wrap {
        margin:0 auto;
    }
    .grid {
        margin:0 auto;
    }
    .grid li {
        width:25%;
        float:left;
        cursor:pointer;
    }
    .grid figure{
        padding:15px;
        -webkit-transition:opacity 0.2s;
        transition:opacity 0.2s;
    }
    .grid li:hover figure img{
        opacity:0.7;
    }
    .grid figcaption {
        background:#333;
        padding: 25px;
        min-height: 55px;
    }
    /* Slideshow style */
    .slideshow {
        position:fixed;
        background:rgba(0,0,0,0.6);
        width:100%;
        height:100%;
        top:0;
        left:0;
        z-index:500;
        opacity:0;
        visibility:hidden;
        overflow:hidden;
        -webkit-perspective:1000px;
        perspective:1000px;
        -webkit-transition:opacity 0.5s,visibility 0s 0.5s;
        transition:opacity 0.5s,visibility 0s 0.5s;
    }
    .slideshow-open .slideshow {
        opacity:1;
        visibility:visible;
        -webkit-transition:opacity 0.5s;
        transition:opacity 0.5s;
    }
    .slideshow ul {
        width:100%;
        height:100%;
        -webkit-transform-style:preserve-3d;
        transform-style:preserve-3d;
        -webkit-transform:translate3d(0,0,150px);
        transform:translate3d(0,0,150px);
        -webkit-transition:-webkit-transform 0.5s;
        transition:transform 0.5s;
    }
    .slideshow ul.animatable li {
        -webkit-transition:-webkit-transform 0.5s;
        transition:transform 0.5s;
    }
    .slideshow-open .slideshow ul {
        -webkit-transform:translate3d(0,0,0);
        transform:translate3d(0,0,0);
    }
    .slideshow li {
        width:660px;
        height:500px;
        position:absolute;
        top:60%;
        left:50%;
        margin:-280px 0 0 -330px;
        visibility:hidden;
    }
    .slideshow li.show {
        visibility:visible;
    }
    .slideshow li:after {
        content:'';
        position:absolute;
        width:100%;
        height:100%;
        top:0;
        left:0;
        background:rgba(255,255,255,0.8);
        -webkit-transition:opacity 0.3s;
        transition:opacity 0.3s;
    }
    .slideshow li.current:after {
        visibility:hidden;
        opacity:0;
        -webkit-transition:opacity 0.3s,visibility 0s 0.3s;
        transition:opacity 0.3s,visibility 0s 0.3s;
    }
    .slideshow figure {
        width:100%;
        height:100%;
        background:#fff;
        border:20px solid #fff;
        overflow: auto;
    }

    /* Navigation */
    .slideshow nav span {
        position:fixed;
        z-index:1000;
        color:#fff;
        text-align:center;
        padding:2%;
        cursor:pointer;
        font-size:2.2em;
        background:rgba(0,0,0,0.1);
    }
    .slideshow nav span.nav-prev,.slideshow nav span.nav-next {
        top:50%;
        -webkit-transform:translateY(-50%);
        transform:translateY(-50%);
    }
    .slideshow nav span.nav-next {
        right:0;
    }
    .slideshow nav span.nav-close {
        top:90px;
        right:0px;
        padding:10px 25px;
        color:#999;
    }
    .icon:before,.icon:after {
        font-family:'fontawesome';
        speak:none;
        font-style:normal;
        font-weight:normal;
        font-variant:normal;
        text-transform:none;
        line-height:1;
        -webkit-font-smoothing:antialiased;
        -moz-osx-font-smoothing:grayscale;
    }
    span.nav-prev:before {
        content:"\f104";
    }
    span.nav-next:before {
        content:"\f105";
    }
    span.nav-close:before {
        content: "\f00d";
    }
    /* Info on arrow key navigation */
    .info-keys {
        position:fixed;
        top:10px;
        left:10px;
        width:60px;
        font-size:8px;
        padding-top:20px;
        text-transform:uppercase;
        color:#fff;
        letter-spacing:1px;
        text-align:center;
    }
    .info-keys:before,.info-keys:after {
        position:absolute;
        top:0;
        width:16px;
        height:16px;
        border:1px solid #fff;
        text-align:center;
        line-height:14px;
        font-size:12px;
    }
    .info-keys:before {
        left:10px;
        content:"\e603";
    }
    .info-keys:after {
        right:10px;
        content: "\e604";
    }
    /* Example media queries (reduce number of columns and change slideshow layout) */
    @media screen and (max-width:60em) {
        /* responsive columns;see "Element sizing" on http://masonry.desandro.com/options.html */
        .grid li {
            width:33.3%;
        }
        .slideshow li {
            width:100%;
            height:100%;
            top:0;
            left:0;
            margin:0;
        }
        .slideshow li figure img {
            width:auto;
            margin:0 auto;
            max-width:100%;
        }
        .slideshow nav span,.slideshow nav span.nav-close {
            font-size:1.8em;
            padding:0.3em;
        }
        .info-keys {
            display:none;
        }
    }
    @media screen and (max-width:35em) {
        .grid li {
            width:50%;
        }
    }
    @media screen and (max-width:24em) {
        .grid li {
            width: 100%;
        }
    }
</style>
@stop
@section('content')
<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Portfolio
                <small>What we have done</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/">Home</a>
                </li>
                <li class="active">Portfolio</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    @if($portfolioCategory)
    <div class="row">
        <div class="col-lg-12">
            <div id="nav">
                <ul class="list-inline text-center">
                    <li><a href="javascript:;" class="btn btn-info" data-filter="*">All</a></li>
                    @foreach($portfolioCategory as $key => $item)
                    <li><a href="javascript:;" class="btn btn-info" data-filter=".cat_{!!$item->id!!}">{!!$item->name!!}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!--portfolio-->
    <div class="row">
        <div id="grid-gallery" class="grid-gallery">
            <section class="grid-wrap">
                <ul class="grid">
                    <li class="grid-sizer"></li><!-- for Masonry column width -->
                    @foreach($portfolio as $key => $item)
                    <li class="grid-item cat_{!! $item->category_id!!}">
                        <figure>
                            <img class="img-responsive img-hover" src="{!! $item->image !='' ? PORTFOLIO_IMAGE_ROOT.$item->image : PORTFOLIO_IMAGE_ROOT.'default.png' !!}" alt="{!! $item->title !!}" title="{!! $item->title !!}" width="100%">
                            <figcaption>
                                <h3 class="text-center">
                                    <a href="{!! $item->link !!}" target="_blank">{!! $item->title !!}</a>
                                </h3>
                            </figcaption>
                        </figure>
                    </li>
                    @endforeach
                </ul>
            </section><!-- // end small images -->

            <section class="slideshow">
                <ul>
                    @foreach($portfolioAll as $key => $item)
                    <li class="">
                        <figure>
                            <img class="" src="{!! $item->image !='' ? PORTFOLIO_IMAGE_ROOT.$item->image : PORTFOLIO_IMAGE_ROOT.'default.png' !!}" alt="{!! $item->title !!}" title="{!! $item->title !!}" width="100%">
                            <figcaption>
                                <h2 class="text-center">
                                    <a href="{!! $item->link !!}" target="_blank">{!! $item->title !!}</a>
                                </h2>
                                <p>{!! $item->description !!}</p>
                            </figcaption>
                        </figure>
                    </li>
                    @endforeach
                </ul>
                <nav>
                    <span class="icon nav-prev"></span>
                    <span class="icon nav-next"></span>
                    <span class="icon nav-close"></span>
                </nav>
                <div class="info-keys icon">Navigate with arrow keys</div>
            </section><!-- // end slideshow -->					
        </div><!-- // grid-gallery -->
    </div>
    @if($portfolio)
    <!-- Pagination -->
    <div class="row text-center hide">
        <div class="col-lg-12">
            <ul class="pagination">
                <li>
                    {!!$portfolio->render()!!}
                </li>
            </ul>
        </div>
    </div>
    <!-- /.row -->
    @endif
    <!-- Footer -->
    @include('frontend.includes.footer')

</div>
<!-- /.container -->
@stop
{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var $grid = $('.grid');
        var transitionDuration = 500;

        //start isotope
        $grid.isotope({
            itemSelector: '.grid-item',
            filter: '*',
            animationEngine: 'best-available', //CSS3 if browser supports it, jQuery otherwise
            animationOptions: {
                duration: transitionDuration,
                easing: 'linear',
                queue: false,
            }
        });

        // layout Isotope after each image loads
        $grid.imagesLoaded().progress(function () {
            $grid.isotope('layout');
        });

        $('#nav a').click(function () {
            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $grid.isotope({
                filter: selector,
                animationEngine: 'best-available', //CSS3 if browser supports it, jQuery otherwise
                animationOptions: {
                    duration: transitionDuration,
                    easing: 'linear',
                    queue: false,
                },
            });
            return false;
        });

        $(window).resize(function () {
            $grid.isotope('layout');
        });
        //end isotope

        //start infinie scroll
        $grid.infinitescroll({
            navSelector: '.pagination li', // selector for the paged navigation 
            nextSelector: '.pagination li a', // selector for the NEXT link (to page 2)
            itemSelector: '.grid-item', // selector for all items you'll retrieve
            loading: {
                finishedMsg: 'No more item to load.',
                img: '<?php echo url('assets/images/loading.gif') ?>'
            }
        },
        // call Isotope as a callback
        function (newElements) {
            var $newElems = $(newElements).css({opacity: 0});
            $newElems.imagesLoaded(function () {
                $newElems.animate({opacity: 1});
                $grid.isotope('appended', $newElems, true);
            });
            new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
        });
        //end infinie scroll
        
    });
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>
@stop