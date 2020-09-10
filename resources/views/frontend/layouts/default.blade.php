<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="{!! config('settings.metaTitle') !!}" />
        <meta name="description" content="{!! config('settings.metaDescription') !!}" />
        <meta name="keywords" content="{!! config('settings.metaKeywords') !!}" />
            <title>
                @section('title')
                {!! config('settings.title') !!}
                @show
            </title>
            
            <link rel="shortcut icon" href="{!! asset('assets/images/favicon.png') !!}" >
            
            <!-- Bootstrap Core CSS -->
            <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet">
            
            <!-- Fornt-awesome Fonts -->
            <link href="{!!asset('assets/font-awesome/css/font-awesome.min.css')!!}" rel="stylesheet" type="text/css">
            
            <!-- Custom CSS -->
            <link href="{!!asset('assets/css/modern-business.css')!!}" rel="stylesheet">
            <link href="{!!asset('assets/css/grid.css')!!}" rel="stylesheet">
            <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet">
    </head>

    <body>
        <!-- Navigation -->
        
        @include('frontend.includes.header')
        @yield('styles')
        @yield('content')
        
         <!-- jQuery -->
        <script src="{!!asset('assets/js/jquery-2.1.1.min.js')!!}"></script>
        <script src="{!!asset('assets/js/jquery-migrate-1.2.1.js')!!}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>
        
        <!-- jQuery Validation js -->
        <script src="{!!asset('assets/js/validation/jquery.validate.min.js')!!}" type="text/javascript"></script>
        <script src="{!!asset('assets/js/validation/additional-methods.js')!!}" type="text/javascript"></script>
        
        <!-- jQuery isotope js -->
        <script src="{!!asset('assets/js/isotope/dist/isotope.pkgd.min.js')!!}" type="text/javascript"></script>
        
        <!-- jQuery imageloaded js -->
        <script src="{!!asset('assets/js/isotope/imagesloaded.pkgd.min.js')!!}" type="text/javascript"></script>
        
        <!-- jQuery infinitescroll js -->
        <script src="{!!asset('assets/js/infinitescroll/jquery.infinitescroll.min.js')!!}" type="text/javascript"></script>
        
        <!-- jQuery popup for portfolio js -->
        <script src="{!!asset('assets/js/GridGallery/modernizr.custom.js')!!}" type="text/javascript"></script>
        <script src="{!!asset('assets/js/GridGallery/classie.js')!!}" type="text/javascript"></script>
        <script src="{!!asset('assets/js/GridGallery/cbpGridGallery.js')!!}" type="text/javascript"></script>
        <!-- end popup js -->
        
        <!-- jQuery slim scroll js -->
        <script src="{!!asset('assets/js/slimScroll/jquery.slimscroll.min.js')!!}" type="text/javascript"></script>
        
        <script src="{!!asset('assets/js/common.js')!!}" type="text/javascript"></script>
        
        {{-- custom --}}
        <script src="{!!asset('assets/js/custom.js')!!}" type="text/javascript"></script>

        @yield('scripts')

    </body>
    </html>
