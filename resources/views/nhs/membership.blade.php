<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="horizontal-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>NHS</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/nhs-logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-misc.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl container-p-y ">

      <div class="card ">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card p-5">
                    <div class="card-header p-0">
                        <div class="btn-group" style="float: right" align="right">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                @if (auth()->user()->membershipPayment)
                                <a href="{{ route('dashboards') }}" class="btn btn-primary">Go to Dashboard</a>
                                @endif
                                <button class="btn btn-danger" type="submit">Back</button>
                            </form>
                        </div>
                    </div>
                    <h4 class="mb-2">Membership Payment</h4>
                <p class="pb-2 mb-0">This is a payment for "{{ auth()->user()->memberType->name }}" Membership </p>
                <div class="bg-lighter p-4 rounded mt-4">
                  <p class="mb-1">Membership fee</p>
                  <div class="d-flex align-items-center">
                    <h1 class="text-heading display-5 mb-1"><del>N</del>{{ number_format(auth()->user()->memberType->fee, 2) }}</h1>
                    <sub>/*</sub>
                  </div>
                  <div class="d-grid">
                    <button type="button" data-bs-target="#smallModal" data-bs-toggle="modal" class="btn btn-label-primary waves-effect">
                      Change Plan
                    </button>
                  </div>
                </div>
                <div>
                  {{-- <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="mb-0">Subtotal</p>
                    <h6 class="mb-0">$85.99</h6>
                  </div> --}}
                  <hr>
                  <div class="d-flex justify-content-between align-items-center mt-3 pb-1">
                    <p class="mb-0">Total</p>
                    <h6 class="mb-0"><del>N</del>{{ number_format(auth()->user()->memberType->fee, 2) }}</h6>
                  </div>
                  <div class="d-grid mt-3">
                    <form action="{{ route('pay.membership') }}" method="post">
                        @csrf
                        <input type="hidden" name="amount" id="amount" value="{{ auth()->user()->memberType->fee*100 }}">
                        <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="payment_type_id" id="payment_type_id" value="1">
                        <div class="row">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <span class="me-2">Proceed with Payment</span>
                                <i class="ti ti-arrow-right scaleX-n1-rtl"></i>
                            </button>
                        </div>
                    </form>
                  </div>

                  <p class="mt-4 pt-2">
                    By continuing, you accept to our Terms of Services and Privacy Policy. Please note that payments are
                    non-refundable.
                  </p>
                </div>
                </div>
            </div>
        </div>
      </div>

    </div>

    <!-- / Content -->

    {{-- Modal for editing membership --}}

    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <form action="{{ route('change.membership') }}" method="POST">
                @method('patch')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Change Membership Plan</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <div class="col mb-3">
                        <label for="nameSmall" class="form-label">Memberships</label>
                        <select type="text" id="type" name="type" class="form-control form-select" >
                            <option value=""> Select </option>
                            @foreach ($memberships as $row)
                                <option value="{{ $row->id }}" {{ auth()->user()->type === $row->id ? 'selected' : '' }}>{{ $row->name .' - '. number_format($row->fee, 2) }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>
    <!-- Page JS -->
    @if (session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
    </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: '{{ $error }}'
            })
            </script>
        @endforeach
    @endif

    @if (session()->has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: '{{ session()->get('error') }}'
        })
    </script>
    @endif
  </body>
</html>
