<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{!! (Request::is('admin/dashboard') ? 'active' : '') !!}">
                <a href="{!!URL::to('admin')!!}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{!! (Request::is('admin/active') ? ' active' : '') !!}">
                <a href="{!!URL::to('admin/active')!!}">
                    <i class="fa fa-check"></i> <span>Active Request List</span>
                </a>
            </li>
            <li class="{!! (Request::is('admin/flagged') ? ' active' : '') !!}">
                <a href="{!!URL::to('admin/flagged')!!}">
                    <i class="fa fa-send-o"></i> <span>Flagged Requests</span>
                </a>
            </li>
            <li class="{!! (Request::is('admin/closed') ? ' active' : '') !!}">
                <a href="{!!URL::to('admin/closed')!!}">
                    <i class="fa fa-remove"></i> <span>Closed Request List</span>
                </a>
            </li>
            <li class="{!! (Request::is('admin/praise') ? ' active' : '') !!}">
                <a href="{!!URL::to('admin/praise')!!}">
                    <i class="fa fa-clock-o"></i> <span>Praise Reports</span>
                </a>
            </li>
            <li class="{!! (Request::is('admin/banned') ? ' active' : '') !!}">
                <a href="{!!URL::to('admin/banned')!!}">
                    <i class="fa fa-question-circle"></i> <span>Banned IPs</span>
                </a>
            </li>
            
            <li class="treeview {!! (Request::is('admin/pages*') ? ' active' : '') !!}">
                <a href="javascript:;">
                    <i class="fa fa-file-text"></i>
                    <span>Page Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! (Request::is('admin/pages/create') ? 'active' : '') !!}"><a href="{!!URL::to('admin/pages/create')!!}"><i class="fa fa-angle-double-right"></i>Add Page</a></li>
                    <li class="{!! (Request::is('admin/pages') ? 'active' : '') !!}"><a href="{!!URL::to('admin/pages')!!}"><i class="fa fa-angle-double-right"></i>Page List</a></li>
                </ul>
            </li>
           
            <li class="treeview {!! (Request::is('admin/metadata*') ? ' active' : '') !!}">
                <a href="javascript:;">
                    <i class="fa fa-pencil-square"></i>
                    <span>Metadata</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! (Request::is('admin/metadata/create') ? 'active' : '') !!}"><a href="{!!URL::to('admin/metadata/create')!!}"><i class="fa fa-angle-double-right"></i>Add Metadata</a></li>
                    <li class="{!! (Request::is('admin/metadata') ? 'active' : '') !!}"><a href="{!!URL::to('admin/metadata')!!}"><i class="fa fa-angle-double-right"></i>Metadata List</a></li>
                </ul>
            </li>
            
            <li class="treeview {!! (Request::is('admin/sliders*') ? ' active' : '') !!}">
                <a href="javascript:;">
                    <i class="fa fa-image"></i>
                    <span>Slider Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! (Request::is('admin/sliders/create') ? 'active' : '') !!}"><a href="{!!URL::to('admin/sliders/create')!!}"><i class="fa fa-angle-double-right"></i>Add Slider</a></li>
                    <li class="{!! (Request::is('admin/sliders') ? 'active' : '') !!}"><a href="{!!URL::to('admin/sliders')!!}"><i class="fa fa-angle-double-right"></i>Slider List</a></li>
                </ul>
            </li>

            <li class="treeview {!! (Request::is('admin/settings*') || Request::is('admin/password/change') ? ' active' : '') !!}">
                <a href="javascript:;">
                    <i class="fa fa-wrench"></i>
                    <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! (Request::is('admin/settings') ? 'active' : '') !!}"><a href="{!!URL::to('admin/settings')!!}"><i class="fa fa-angle-double-right"></i>Setting</a></li>
                    <li class="{!! (Request::is('admin/password/change') ? 'active' : '') !!}"><a href="{!!URL::to('admin/password/change')!!}"><i class="fa fa-angle-double-right"></i>Change Password</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>