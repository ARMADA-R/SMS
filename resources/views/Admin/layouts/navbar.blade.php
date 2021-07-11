<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-dark navbar-info" style="border-color: #c2e5ea;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.home')}}" class="nav-link">{{trans('app.home')}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">{{trans('app.support-contact')}}</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav  ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" id="notification-nav" href="#">
                <i class="far fa-bell"></i>
                <!-- <span class="badge badge-warning navbar-badge" style="right: 2px; top: 5px;" id="unread-notifications-number"></span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                <div class="dropdown-item dropdown-header d-flex align-items-center px-2">
                    <a onclick="markNotificationsAsRead()" class="header-link mr-auto">{{ trans('app.notifications.mark-all-as-read') }}</a>
                    <a class="header-link ml-auto p-2" onclick="checkNotification()" title="{{trans('app.refresh')}}">
                        <i class="fas fa-redo-alt"></i>
                    </a>
                </div>
                <div class="dropdown-divider"></div>
                <div class="notification-menu" id="notification-menu">
                    <div class="dropdown-divider"></div>
                    <a href="/course/unity-game-developer/learn/#announcements/5039882/" class="panel-menu-item item-card">
                        <div class="notification-item">
                            <div class="heading-sm notification-item-title ">
                            </div>
                            <div class="notification-item-time">

                            </div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-divider"></div>
                <a onclick="CheckForMoreNotifications()" style="cursor: pointer;" class="footer-link  dropdown-item dropdown-footer">{{ trans('app.notifications.load-more') }}</a>
            </div>
        </li>
        <style>
            .heading-sm {
                /* font-weight: 600; */
                line-height: 1.2;
                letter-spacing: -.02rem;
                font-size: 1rem;
            }

            .dropdown-item:focus,
            .dropdown-item:hover {
                color: #16181b;
                text-decoration: none;
                background-color: unset;
            }

            .dropdown-item:active {
                color: unset;
                text-decoration: none;
                background-color: unset;
            }

            .header-link {
                color: #17a2b8;
                cursor: pointer;
            }

            .footer-link {
                color: #17a2b8;
            }

            .panel-menu-item {
                padding: .6rem;
            }

            .item-card {
                color: #3c3b37 !important;
                display: flex;
            }

            .item-card:hover {
                background-color: #17a2b826;
            }

            .notification-item {
                padding: 0 .8rem;
                position: relative;
                width: 26.4rem;
            }

            .notification-item-title {
                display: block !important;
                display: -webkit-box !important;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: normal;
                max-height: 2.4rem;
                /* margin: 0 .8rem .4rem 0; */
            }

            .unread-notification-item-title {
                font-weight: 700;
            }

            .notification-item-time {
                color: #17a2b8;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                font-size: .8rem;
            }


            .dropdown-notification-item {
                padding: 1rem 1rem !important;
            }

            .notification-menu {
                overflow: auto;
                max-height: 350px;
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }

            .notification-menu::-webkit-scrollbar {
                display: none;
            }

            .notification:hover {
                background-color: #17a2b88c;
            }
        </style>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href=" route('set-local', 'en') }}">
                English
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href=" route('set-local', $lang->code) }}" class="dropdown-item">
                    Arabic
                </a>
            </div>
        </li>


        <!-- @ if(strtolower(langDirection()) != 'rtl') -->

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>


        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->

        <!-- @ endif -->

    </ul>
</nav>
<!-- /.navbar -->

@push('scripts')
<script src="{{url('/')}}/js/moment/moment.js"></script>
<script src="{{url('/')}}/js/moment/moment-timezone.js"></script>
<script>
    var currentPageNum = 1;

    document.addEventListener('DOMContentLoaded', function() {
        checkNotification();
    });



    function checkNotification() {
        $.ajax({
            url: "{{ route('admin.notifications.get') }}",
            success: function(result) {

                if (result.unreadNotificationsNumber > 0 && !document.getElementById('unread-notifications-number')) {
                    document.getElementById('notification-nav').innerHTML += '<span class="badge badge-warning navbar-badge" id="unread-notifications-number"></span>';
                    document.getElementById('unread-notifications-number').innerHTML = result.unreadNotificationsNumber;
                } else if (document.getElementById('unread-notifications-number') && result.unreadNotificationsNumber == 0) {
                    document.getElementById('unread-notifications-number').remove();
                }

                var notificationMenu = document.getElementById('notification-menu');

                if (result.userNotifications.data) {
                    notificationMenu.innerHTML = '';
                    addToNotificationsMenu(result.userNotifications.data, notificationMenu);
                }

            },
            error: function(result) {
                var notificationMenu = document.getElementById('notification-menu');
                notificationMenu.innerHTML = '';
                notificationMenu.innerHTML = `
                    <a class="panel-menu-item item-card" style=" padding: 20px; opacity: .8; color: #d02d3cf2 !important; text-align: center;">
                        <div class="notification-item">
                            <div class=" notification-item-title">
                                <span class="subject">
                                        {{ trans('app.notifications.load.error') }}
                                </span>
                            </div>
                        </div>
                    </a>`;
            }
        });
    }

    $(document).on('click', '.dropdown-menu', function(e) {
        e.stopPropagation();
    });

    function markNotificationsAsRead() {
        $.ajax({
            url: "{{ route('admin.notifications.read') }}",
            success: function(result) {
                checkNotification();
            },
        });
    }

    function addToNotificationsMenu(notifications) {
        var menu = document.getElementById('notification-menu');
        notifications.forEach((element) => {
            menu.innerHTML += `
                        <div class="dropdown-divider"></div>
                        <a href="element.data.URL" class="panel-menu-item item-card">
                            <div class="notification-item">
                                <div class="heading-sm notification-item-title ` + ((!element.read_at) ? `unread-notification-item-title` : ``) + `">
                                    <span data-purpose="safely-set-inner-html:notification-item:notification-template">element.data.title
                                        <span class="subject">
                                            element.data.content
                                        </span>
                                    </span>
                                </div>
                                <div class="notification-item-time">
                                    ` + moment.utc(element.created_at).local().fromNow() + `
                                </div>
                            </div>
                        </a>
                        `;
        });
    }

    function CheckForMoreNotifications() {
        $.ajax({
            url: "{{ route('admin.notifications.get') .'?page=' }}" + ++currentPageNum ,
            success: function(result) {

                if (result.userNotifications.data) {
                    addToNotificationsMenu(result.userNotifications.data);
                }

            },
            error: function(result) {
                var notificationMenu = document.getElementById('notification-menu');
                notificationMenu.innerHTML = '';
                notificationMenu.innerHTML = `
                    <a class="panel-menu-item item-card" style=" padding: 20px; opacity: .8; color: #d02d3cf2 !important; text-align: center;">
                        <div class="notification-item">
                            <div class=" notification-item-title">
                                <span class="subject">
                                        {{ trans('app.notifications.load.error') }}
                                </span>
                            </div>
                        </div>
                    </a>`;
            }
        });
    }
</script>
@endpush