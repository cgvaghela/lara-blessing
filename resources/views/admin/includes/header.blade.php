<header class="main-header">
    <!-- Logo -->
    <a href="{!! URL::to('admin') !!}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">AP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{!! config('settings.sitename') !!} </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{!! Auth::guard('admin')->user()->username  !!} <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! URL('admin/profile') !!}" class="btn btn-primary btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! URL('admin/logout') !!}" class="btn btn-danger btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>