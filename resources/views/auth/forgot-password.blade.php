@include('layouts.dashboard.header')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body">
                      <!-- Logo -->
                      <!-- /Logo -->
                      <p><x-auth-session-status class="mb-4" :status="session('status')" /></p>
                      <p class="mb-4">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. </p>

                      <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                          <label for="email" class="form-label">Email or Username</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            value=""
                            placeholder="Enter your email "
                            autofocus />
                            @error('email')
                            <span style="font-size:13px" class="mt-2 text-danger" >{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <button class="btn btn-primary d-grid w-100" type="submit">Email Password Reset Link</button>
                        </div>
                      </form>
                    </div>
                  </div>
            </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
</div>

@include('layouts.dashboard.footer')

