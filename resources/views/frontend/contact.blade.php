@extends('frontend.layouts.default')

@section('content')
<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Contact
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!!URL::to('/')!!}">Home</a>
                </li>
                <li class="active">Contact</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
        <!-- Map Column -->
        <div class="col-md-8">
            <!-- Embedded Google Map -->
            
            @if(config('settings.map') !="")
                {!! config('settings.map') !!}
            @else
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
            @endif
        </div>
        <!-- Contact Details Column -->
        <div class="col-md-4">
            <h3>Contact Details</h3>
            <p>
                @if(config('settings.address') !="")
                    {!! config('settings.address') !!}<br>
                @endif
            </p>
            <p>
                @if(config('settings.email') !="")
                <i class="fa fa-envelope-o"></i> 
                <a href="{!! 'mailto:'.config('settings.email') !!}">{!! config('settings.email') !!}</a>
                @endif
            </p>
            <p>
                @if(config('settings.phone') !="")
                <i class="fa fa-phone"></i> 
                {!! config('settings.phone') !!}
                @endif
            </p>
            
            <ul class="list-unstyled list-inline list-social-icons">
                @if(config('settings.facebook') !="")
                    <li><a href="{!! config('settings.facebook') !!}" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a></li>
                @endif
                @if(config('settings.linkedin') !="")
                    <li><a href="{!! config('settings.linkedin') !!}" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
                @endif
                @if(config('settings.twitter') !="")
                <li><a href="{!! config('settings.twitter') !!}" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a></li>
                @endif
                @if(config('settings.googleplus') !="")
                    <li><a href="{!! config('settings.googleplus') !!}" target="_blank"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <!-- Contact Form -->
    <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <div class="row">
        <div class="col-md-8 mrgn_30t">
            <!-- Notifications -->
            @include('frontend.includes.notifications')
            <!-- ./ notifications -->
            <h3>Send us a Message</h3>
            {!! Form::open(array('route' => 'contact', 'class' => 'form', 'id'=>'contact-form', 'novalidate' => 'novalidate')) !!}
            <div class="form-group has-feedback">
                <label>Full Name: </label>
                {!! Form::text('fullname', old('fullname'), array('required', 'class'=>'form-control', 'placeholder'=>'Your name')) !!}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
                <label>E-mail </label>
                {!! Form::text('email', old('email'),array('required', 'class'=>'form-control', 'placeholder'=>'Your e-mail address')) !!}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            
            <div class="form-group has-feedback">
                <label>Subject </label>
                {!! Form::text('subject', old('subject'),array('required', 'class'=>'form-control', 'placeholder'=>'Your subject')) !!}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            
            <div class="form-group has-feedback">
                <label>Message</label>
                {!! Form::textarea('message', old('message'), array('required', 'class'=>'form-control', 'placeholder'=>'Your message', 'rows' => '10', 'cols' => '100')) !!}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
                {!! Form::submit('Send Message', array('class'=>'btn btn-success', 'id'=>'contact-form-submit')) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.row -->

    <!-- Footer -->
    @include('frontend.includes.footer')

</div>
<!-- /.container -->
@stop