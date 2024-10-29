<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
  <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
  </a>
  <nav class="vertnav navbar navbar-light">
    <!-- شريط التنقل -->
    <div class="w-100 mb-4 d-flex">
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
        <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
          <g>
            <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
            <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
            <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
          </g>
        </svg>
      </a>
    </div>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item">
        <a class="nav-link" href="">
          <i class="fe fe-home fe-16"></i>
          <span class="ml-1 item-text">لوحة التحكم</span>
        </a>
      </li>
    </ul>

    <p class="text-muted nav-heading mt-4 mb-1">
      <span>المكونات</span>
    </p>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <!-- Existing Users Section -->
      <li class="nav-item dropdown">
        <a href="#auth" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-users fe-16"></i>
          <span class="ml-3 item-text">المستخدمين</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="auth">
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{route('users.index')}}">
                <i class="fe fe-eye fe-16"></i>
                <span class="ml-1 item-text">عرض المستخدمين</span>
            </a>
          </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{route('users.create')}}">
                    <i class="fe fe-user-plus fe-16"></i>
                    <span class="ml-1 item-text">إضافة مستخدم</span>
                </a>
            </li>
        </ul>
      </li>

        <!-- Existing Roles Section -->


        <li class="nav-item dropdown">
            <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text">الأدوار</span>
            </a>

            <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                @can('عرض الأدوار')
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('roles.index') }}">
                            <i class="fe fe-eye fe-16"></i>
                            <span class="ml-1 item-text">عرض الأدوار</span>
                        </a>
                    </li>
                @endcan

                @can('إضافة دور')
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('roles.create') }}">
                            <i class="fe fe-plus-circle fe-16"></i>
                            <span class="ml-1 item-text">إضافة دور</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}">
                <i class="fe fe-folder fe-16"></i>
                <span class="ml-1 item-text">الفئات</span>
            </a>
        </li>

        <!-- Existing Addresses Section -->
        <li class="nav-item dropdown">
            <a href="{{route('country.index')}}" class="nav-link">
                <i class="fe fe-map-pin fe-16"></i>
                <span class="ml-3 item-text">الدول و المدن</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="{{route('identity-verification.index')}}"  class="nav-link">
                <i class="fe fe-file-text fe-16"></i>
                <span class="ml-3 item-text">النماذج</span>
            </a>
        </li>
      <!-- Existing Stores Section -->
      <li class="nav-item dropdown">
        <a href="#stores" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-box fe-16"></i>
          <span class="ml-3 item-text">المخازن</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="stores">
          <li class="nav-item">
            <a class="nav-link pl-3" href="">
              <i class="fe fe-eye fe-16"></i>
              <span class="ml-1 item-text">عرض المخازن</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="">
              <i class="fe fe-plus-circle fe-16"></i>
              <span class="ml-1 item-text">إضافة مخزن</span>
            </a>
          </li>
        </ul>
      </li>





    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="fe fe-shopping-cart fe-16"></i>
        <span class="ml-1 item-text">المنتجات</span>
      </a>
    </li>

        <li class="nav-item w-100">
            <a class="nav-link" href="">
                <i class="fe fe-star fe-16"></i>
                <span class="ml-3 item-text">إنشاء بوست جديد</span>
            </a>
        </li>
        <li class="nav-item w-100">
            <a class="nav-link" href="">
                <i class="fe fe-star fe-16"></i>
                <span class="ml-3 item-text">حظر المستخدمين</span>
            </a>
        </li>
      <li class="nav-item w-100">
        <a class="nav-link" href="widgets.html">
          <i class="fe fe-star fe-16"></i>
          <span class="ml-3 item-text">الأدوات</span>
          <span class="badge badge-pill badge-primary">جديد</span>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-file-text fe-16"></i>
          <span class="ml-3 item-text">النماذج</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="forms">
          <li class="nav-item">
            <a class="nav-link pl-3" href="./form_elements.html">
              <i class="fe fe-check-square fe-16"></i>
              <span class="ml-1 item-text">العناصر الأساسية</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="./form_advanced.html">
              <i class="fe fe-sliders fe-16"></i>
              <span class="ml-1 item-text">العناصر المتقدمة</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-file fe-16"></i>
          <span class="ml-3 item-text">الصفحات</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="pages">
          <li class="nav-item">
            <a class="nav-link pl-3" href="./profile.html">
              <i class="fe fe-user fe-16"></i>
              <span class="ml-1 item-text">الملف الشخصي</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="./inbox.html">
              <i class="fe fe-inbox fe-16"></i>
              <span class="ml-1 item-text">البريد الوارد</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-pie-chart fe-16"></i>
          <span class="ml-3 item-text">المخططات</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="charts">
          <li class="nav-item">
            <a class="nav-link pl-3" href="./chartjs.html">
              <i class="fe fe-bar-chart fe-16"></i>
              <span class="ml-1 item-text">ChartJS</span>
            </a>
          </li>
        </ul>
      </li>


      <li class="nav-item dropdown">
        <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-table fe-16"></i>
          <span class="ml-3 item-text">الجداول</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="tables">
          <li class="nav-item">
            <a class="nav-link pl-3" href="./tables.html">
              <i class="fe fe-grid fe-16"></i>
              <span class="ml-1 item-text">جدول بسيط</span>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
</aside>
