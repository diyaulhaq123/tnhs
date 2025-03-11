@include('layouts.dashboard.header')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                      <!-- Logo -->
                      <div class="app-brand justify-content-center mb-4 mt-2">
                        <a href="javascript:void(0)" class="app-brand-link gap-2">
                            <img src="{{ asset('assets/img/nhs-logo.png') }}" class="rounded-circle logo" width="80" height="" alt="">
                          <span class="app-brand-text demo text-body fw-bold ms-1">Nigeria Hypertensive Society</span>
                        </a>
                      </div>
                      <!-- /Logo -->
                      <h4 class="mb-1 pt-2">Welcome ! 👋</h4>
                      <p class="mb-4">Please sign-in to your account </p>

                      <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                          <label for="email" class="form-label">Email or Username</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            value=""
                            placeholder="Enter your email or username"
                            autofocus />
                            @error('email')
                            <span style="font-size:13px" class="mt-2 text-danger" >{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                          <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                              <small>Forgot Password?</small>
                            </a>
                            @endif
                          </div>
                          <div class="input-group input-group-merge">
                            <input
                              type="password"
                              id="password"
                              value=""
                              class="form-control"
                              name="password"
                              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                              aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                          </div>
                          @error('password')
                            <span style="font-size:13px" class="mt-2 text-danger" >{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                          </div>
                        </div>
                        <div class="mb-3">
                          <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                      </form>

                      <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{ route('register') }}">
                          <span>Create an account</span>
                        </a>
                      </p>

                      <div class="divider my-4">
                        <div class="divider-text"></div>
                      </div>


                    </div>
                  </div>
            </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
</div>

@include('layouts.dashboard.footer')
