
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
              <!-- Menu -->
              <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                <div class="container-xl d-flex h-100">
                  <ul class="menu-inner justify-content-center">
                    <!-- Dashboards -->
                    <li class="menu-item">
                      <a href="javascript:void(0)" class="menu-link menu-toggle mx-1">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div >Dashboards</div>
                      </a>
                      <ul class="menu-sub">
                        <li class="menu-item">
                          <a href="{{ route('dashboards')}} " class="menu-link">
                            <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                            <div >Dashboard</div>
                          </a>
                        </li>
                        @can('see_users')
                        <li class="menu-item">
                          <a href="{{ route('user.list') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div >Users</div>
                          </a>
                        </li>
                        @endcan
                        {{-- <li class="menu-item">
                          <a href="app-ecommerce-dashboard.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-shopping-cart ti-3d-cube-spher"></i>
                            <div >eCommerce</div>
                          </a>
                        </li>
                        <li class="menu-item">
                          <a href="app-logistics-dashboard.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-truck"></i>
                            <div >Logistics</div>
                          </a>
                        </li>
                        <li class="menu-item">
                          <a href="app-academy-dashboard.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-book"></i>
                            <div >Academy</div>
                          </a>
                        </li> --}}
                      </ul>
                    </li>

                    <!-- Events -->
                    @can('view_events')
                    <li class="menu-item ">
                      <a href="javascript:void(0)" class="menu-link menu-toggle mx-1">
                        <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                        <div class="mx-1">Events</div>
                      </a>
                      <ul class="menu-sub">
                        <li class="menu-item">
                          <a href="{{route('event.index')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                            <div >Events & Upcomings</div>
                          </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('past.events') }}" class="menu-link">
                              <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                              <div >Past events</div>
                            </a>
                        </li>
                      </ul>
                    </li>
                    @endcan

                    <!-- Components -->
                    <li class="menu-item active">
                      <a href="javascript:void(0)" class="menu-link menu-toggle mx-1">
                        <i class="menu-icon tf-icons ti ti-money"></i>
                        <div >Finances</div>
                      </a>
                      <ul class="menu-sub">
                        <!-- payments -->
                        @can('view_all_payments')
                        <li class="menu-item active">
                          <a href="{{ route('payments.index') }}" class="menu-link ">
                            <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                            <div >Payments</div>
                          </a>
                        </li>
                        @endcan

                        @can('member_payment')
                        <li class="menu-item">
                          <a href="javascript:void(0)" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                            <div >My Payments</div>
                          </a>
                        </li>
                        @endcan

                        {{-- <li class="menu-item">
                          <a href="javascript:void(0)" class="menu-link ">
                            <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                            <div data-i18n="Icons">Icons</div>
                          </a>
                        </li> --}}
                      </ul>
                    </li>

                    @can('settings')
                    <!-- Misc -->
                    <li class="menu-item">
                      <a href="javascript:void(0)" class="menu-link menu-toggle mx-1">
                        <i class="menu-icon tf-icons ti ti-settings"></i>
                        <div >Settings</div>
                      </a>
                      <ul class="menu-sub">
                        <li class="menu-item">
                          <a href="{{route('role')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                            <div>Role</div>
                          </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('permission')}}" class="menu-link">
                              <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                              <div>Permissions</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                              <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                              <div>Assign Permissions</div>
                            </a>
                        </li>

                      </ul>
                    </li>
                    @endcan

                    @can('send_notification')
                    <li class="menu-item ">
                        <a href="javascript:void(0)" class="menu-link menu-toggle mx-1">
                          <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                          <div class="mx-1">Reminders</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="{{ route('reminder') }}" class="menu-link">
                              <i class="menu-icon tf-icons ti ti-circle" style="font-size: 11px"></i>
                              <div >Notifications</div>
                            </a>
                          </li>
                        </ul>
                    </li>
                    @endcan

                  </ul>
                </div>
              </aside>
              <!-- / Menu -->

              <!-- Content -->

              <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card p-4">
                    <h5 class="py-3 mb-2"><span class="text-muted fw-light">Home /</span> @yield('page_title')</h5>
                {{-- <h5 class="pb-1 mb-2">Title</h5> --}}
                    <div class="body">
                        @yield('page_content')
                    </div>
                </div>

              </div>
              <!--/ Content -->

              <!-- Footer -->
              <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl">
                  <div
                    class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                    <div>
                      ©
                      <script>
                        document.write(new Date().getFullYear());
                      </script>
                      , powered by <a href="https://hilinksnetwork.ng" target="_blank" class="fw-medium">Hilinks Networks</a>
                    </div>
                  </div>
                </div>
              </footer>
              <!-- / Footer -->

              <div class="content-backdrop fade"></div>
            </div>
            <!--/ Content wrapper -->
          </div>

          <!--/ Layout container -->
        </div>
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>

      <!--/ Layout wrapper -->
