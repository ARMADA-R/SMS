<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-info">
    <!-- Brand icon -->
    <a href="#" class="brand-link navbar-info">
        <img src="{{ (settings('icon')!= null) ? Storage::url(settings('icon') ) :'' }}" class=" brand-image img-circle elevation-3" style="opacity: .9; width: 33px; background-color: #ffffffeb;">
        <span class="brand-text font-weight-light"> SMS </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style=" (strtolower(langDirection()) == 'rtl')? ' padding-right: 10px;': '' }}">
            <div class="image">
                <?php
                $words = explode(" ", Auth::guard('admin')->user()->name);
                $acronym = "";

                foreach ($words as $w) {
                    $acronym .= ucwords($w[0]);
                }
                ?>
                <div class="txt-img">
                    {{ $acronym }}
                </div>

                <!-- <img data-src="{{url('design/images/sms-logo.jpg') }}" class="img-circle  elevation-2 lazyload" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="route('admin.UsersAccountEdit', Auth::guard('admin')->user()->id) }}" class="d-block">
                    {{Auth::guard('admin')->user()->name}}
                </a>
            </div>

        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href=" route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{trans('app.dashboard')}}
                        </p>
                    </a>
                </li>

                @can('viewAny', App\Models\User::class)
                <li class="nav-item menu {{ (Request::is('manager/users/*') || Request::is('manager/users') || Request::is('manager/student') || Request::is('manager/students') || Request::is('manager/students/*') || Request::is('manager/user/*') || Request::is('manager/teachers/*') || Request::is('manager/teachers') || Request::is('manager/teacher/*') ? 'menu-is-opening menu-open' : '') }}">
                    <a href="#" class="nav-link {{ (Request::is('manager/users/*') || Request::is('manager/users') || Request::is('manager/student') || Request::is('manager/students') || Request::is('manager/students/*') ||Request::is('manager/user/*') || Request::is('manager/teachers/*') || Request::is('manager/teachers') || Request::is('manager/teacher/*') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans('app.users.users')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('admin.Users')}}" class="nav-link {{ (Request::is('manager/users/*') || Request::is('manager/users') || Request::is('manager/user/*') ? 'active' : '') }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>{{trans('app.accountsManagement')}}</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('admin.Students')}}" class="nav-link {{ (Request::is('manager/students/*') || Request::is('manager/students') || Request::is('manager/student/*') ? 'active' : '') }}">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>{{trans('app.students.students')}}</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('admin.Teachers')}}" class="nav-link {{ (Request::is('manager/teachers/*') || Request::is('manager/teachers') || Request::is('manager/teacher/*') ? 'active' : '') }}">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>{{trans('app.teachers.teachers')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('viewAny', App\Models\Role::class)
                <li class="nav-item">
                    <a href="{{ route('admin.showRoles') }}" class="nav-link {{ (Request::is('manager/roles') || Request::is('manager/roles/*') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>
                            {{trans('app.roles')}}
                        </p>
                    </a>
                </li>
                @endcan
                @can('viewAny', App\Models\Settings::class)
                <li class="nav-item">
                    <a href="{{ route('admin.appSettings') }}" class="nav-link {{ (Request::is('manager/app/settings') || Request::is('manager/app/settings/*') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{trans('app.settings.settings')}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('viewAny', App\Models\Season::class)
                <li class="nav-item">
                    <a href="{{ route('admin.seasons.show') }}" class="nav-link {{ (Request::is('manager/seasons') || Request::is('manager/seasons/*') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-stopwatch"></i>
                        <p>
                            {{trans('app.seasons.seasons')}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('viewAny', App\Models\Course::class)
                <li class="nav-item">
                    <a href="{{ route('admin.courses.show') }}" class="nav-link {{ (Request::is('manager/courses') || Request::is('manager/courses/*') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            {{trans('app.courses.courses')}}
                        </p>
                    </a>
                </li>
                @endcan

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{trans('app.logout')}}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>