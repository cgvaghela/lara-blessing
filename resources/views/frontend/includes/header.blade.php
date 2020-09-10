<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top header" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! url('/')!!}">
                <img src="{!! config('settings.logo') !='' ? LOGO_ROOT.config('settings.logo') : LOGO_ROOT.'default.png' !!}" class="logo">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php $pages = App\Page::active()->get();?>
                @if(isset($pages) && count($pages) > 0)
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Pages <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach($pages as $key => $page)
                            <?php 
                            if($page->slug=='home'){
                                continue;
                            }
                            ?>
                            <li class="{!!(Request::is('page/'.$page->slug) ? 'active' : '') !!}">
                                <a href="{!! url('page/'.$page->slug) !!}">{!! $page->title !!}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                <li class="{!!(Request::is('team') ? 'active' : '') !!}">
                    <a href="{!! url('team')!!}">Team</a>
                </li>
                <li class="{!!(Request::is('services') ? 'active' : '') !!}">
                    <a href="{!! url('services')!!}">Services</a>
                </li>
                <li class="{!!(Request::is('portfolio') ? 'active' : '') !!}">
                    <a href="{!! url('portfolio')!!}">Portfolio</a>
                </li>
                <li class="{!!(Request::is('contact') ? 'active' : '') !!}">
                    <a href="{!! url('contact')!!}">Contact Us</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>