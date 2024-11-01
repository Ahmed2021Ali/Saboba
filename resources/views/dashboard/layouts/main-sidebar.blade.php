<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- شريط التنقل -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                     xml:space="preserve">
          <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87 	"/>
              <polygon class="st0" points="96,69 33,69 42,51 105,51 	"/>
              <polygon class="st0" points="78,33 15,33 24,15 87,15 	"/>
          </g>
        </svg>
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-1 item-text">{{ __('admin_dashboard/sidebar/messages.control_panel') }}</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>{{ __('admin_dashboard/sidebar/messages.components') }}</span>
        </p>

        <ul class="navbar-nav flex-fill w-100 mb-2">

            {{-- Category--}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('categories.index')}}">
                    <i class="fe fe-folder fe-16"></i>
                    <span class="ml-1 item-text">{{ __('admin_dashboard/sidebar/messages.sections') }}</span>
                </a>
            </li>

            {{--Ads --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('ads.index')}}">
                    <i class="fe fe-shopping-cart fe-16"></i>
                    <span class="ml-1 item-text">{{ __('admin_dashboard/sidebar/messages.ads') }}</span>
                </a>
            </li>

            <!-- Existing Users Section -->
            <li class="nav-item dropdown">
                <a href="#auth" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">{{ __('admin_dashboard/sidebar/messages.users') }}</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="auth">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{route('users.index')}}">
                            <i class="fe fe-eye fe-16"></i>
                            <span class="ml-1 item-text"> {{ __('admin_dashboard/sidebar/messages.show_users') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{route('users.create')}}">
                            <i class="fe fe-user-plus fe-16"></i>
                            <span class="ml-1 item-text"> {{ __('admin_dashboard/sidebar/messages.add_user') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Existing Roles Section -->
            <li class="nav-item dropdown">
                <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-shield fe-16"></i>
                    <span class="ml-3 item-text">{{ __('admin_dashboard/sidebar/messages.roles') }}</span>
                </a>

                <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                    @can('عرض الأدوار')
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('roles.index') }}">
                                <i class="fe fe-eye fe-16"></i>
                                <span class="ml-1 item-text"> {{ __('admin_dashboard/sidebar/messages.show_roles') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('إضافة دور')
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('roles.create') }}">
                                <i class="fe fe-plus-circle fe-16"></i>
                                <span class="ml-1 item-text"> {{ __('admin_dashboard/sidebar/messages.add_role') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>


            <!-- Existing Verification Company Section -->
            <li class="nav-item dropdown">
                <a href="#verification" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-file-text fe-16"></i>
                    <span class="ml-3 item-text"> {{ __('admin_dashboard/sidebar/messages.identity_verification') }} </span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="verification">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{route('verifications.index')}}">
                            <i class="fe fe-sliders fe-16"></i>

                            <span class="ml-1 item-text">   {{ __('admin_dashboard/sidebar/messages.waiting_review') }}  </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{route('verifications.show',5)}}">
                            <i class="fe fe-check-square fe-16"></i>

                            <span class="ml-1 item-text">   {{ __('admin_dashboard/sidebar/messages.verified') }} </span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Existing Country and City Section -->
            <li class="nav-item dropdown">
                <a href="{{route('country.index')}}" class="nav-link">
                    <i class="fe fe-map-pin fe-16"></i>
                    <span class="ml-3 item-text"> {{ __('admin_dashboard/sidebar/messages.countries_cities') }}</span>
                </a>
            </li>

            <!-- Existing Block User Section -->
            <li class="nav-item w-100">
                <a class="nav-link" href="{{route('blocked_user.index')}}">
                    <i class="fe fe-star fe-16"></i>
                    <span class="ml-3 item-text">{{ __('admin_dashboard/sidebar/messages.block_users') }}</span>
                </a>
            </li>

            <!-- Existing Report Ads Section -->
            <li class="nav-item w-100">
                <a class="nav-link" href="{{route('report_ads.index')}}">
                    <i class="fe fe-star fe-16"></i>
                    <span class="ml-3 item-text">>{{ __('admin_dashboard/sidebar/messages.report_ads') }}</span>
                </a>
            </li>


        </ul>
    </nav>
</aside>
