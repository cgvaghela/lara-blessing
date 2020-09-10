@extends('frontend.layouts.default')

@section('content')
<!-- Page Content -->
<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{!!$page->title!!}
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('/') !!}">Home</a>
                </li>
                <li class="active">{!!$page->title!!}</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Intro Content -->
    <div class="row">
        <div class="col-md-12">
            {!! $page->content !!}
        </div>
    </div>
    <!-- /.row -->
    @include('frontend.includes.footer')
</div>
<!-- /.container -->
@stop