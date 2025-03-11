    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="javascriptvoid(0):" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img width="100%" height="100%" class="rounded-circle"  src="{{ asset('assets/img/nhs-logo.png') }}"/>
              </span>
              <span class="app-brand-text demo menu-text fw-bold">NHS</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                {{-- <div class="badge bg-primary rounded-pill ms-auto">5</div> --}}
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('dashboards')}}" class="menu-link">
                    <div>Dashboard</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text fw-bold text-dark">Users & Members</span>
            </li>
            {{-- users --}}
            <li class="menu-item">
                <a href="{{ route('user.list') }}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-users"></i>
                  <div>Users/Members</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('member_types.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-calendar-user">&#xeba9;</i>
                  <div>Membership Types</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text fw-bold text-dark">Events</span>
            </li>
            <li class="menu-item">
                <a href="{{route('event.index')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-calendar-up"></i>
                  <div>Upcoming Events</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{route('past.events')}}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar-down"></i>
                    <div >Past Events</div>
                </a>
            </li>

            {{-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                <div>Events</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('event.index')}}" class="menu-link">
                    <div >Upcoming Events</div>
                  </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('past.events')}}" class="menu-link">
                      <div >Past Events</div>
                    </a>
                  </li>
              </ul>
            </li> --}}


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text fw-bold text-dark">Finances & Payments</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('payments.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-cash"></i>
                  <div>Payments</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-cash"></i>
                    <div >My Payments</div>
                </a>
            </li>

            {{-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-cash"></i>
                <div >Finances</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('payments.index') }}" class="menu-link">
                    <div >Payments</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div >My Payments</div>
                  </a>
                </li>
              </ul>
            </li> --}}


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text fw-bold text-dark">Notifications & Reminders</span>
            </li>

            <li class="menu-item">
                <a href="{{ route('reminder') }}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                  <div>Notifications</div>
                </a>
            </li>


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text fw-bold text-dark">Roles & Permissions</span>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ti ti-lock"></i>
                  <div >Roles & Permissions</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('role') }}" class="menu-link">
                      <div >Roles</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('permission') }}" class="menu-link">
                      <div >Permissions</div>
                    </a>
                  </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="{{ route('settings.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-settings"></i>
                  <div>Settings</div>
                </a>
              </li>

            {{-- <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li> --}}

          </ul>
        </aside>
        <!-- / Menu -->

