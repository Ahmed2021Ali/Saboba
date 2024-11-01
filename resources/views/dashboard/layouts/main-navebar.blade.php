<nav class="topnav navbar navbar-light">
  <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
    <i class="fe fe-menu navbar-toggler-icon"></i>
  </button>
  <form class="form-inline mr-auto searchform text-muted">
    <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
  </form>
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
        <i class="fe fe-sun fe-16"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
        <span class="fe fe-grid fe-16"></span>
      </a>
    </li>
    <li class="nav-item nav-notif">
      <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
        <span class="fe fe-bell fe-16"></span>
        <span class="dot dot-md bg-success"></span>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="avatar avatar-sm mt-2">
              <img src="{{ asset('assets/images/avatars/face-1.jpg') }}" alt="..." class="avatar-img rounded-circle">
          </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          @auth
              <span class="dropdown-item text-muted">مرحبا، {{ Auth::user()->name }}</span>
              <span class="dropdown-item text-muted">{{ Auth::user()->email }}</span>
              <div class="dropdown-divider"></div>
          @endauth
          <a class="dropdown-item" href="#">الملف الشخصي</a>
          <a class="dropdown-item" href="#">الإعدادات</a>
          <a class="dropdown-item" href="#">الأنشطة</a>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              تسجيل الخروج
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-muted" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fe fe-globe"></i> Language
      </a>
      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li>
                  <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                      {{ $properties['native'] }}
                  </a>
              </li>
          @endforeach
      </ul>
    </li>

  </ul>
</nav>

