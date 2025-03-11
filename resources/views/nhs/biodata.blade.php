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

<title>NHS|Profile</title>

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

    <div class="card p-4">
        <div class="card-header row">
            <div class="col-lg-8">
                <h4><strong>Update your profile to continue</strong></h4>
            </div>
            <div class="col-lg-4 d-flex btn-group justify-content-right">
                <form action="{{ route('logout') }}" method="post" >
                    @csrf
                    <button class="btn btn-primary waves-effect waves-light" style="float-right">
                        <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                        <span class="d-none d-md-block">Logout</span>
                    </button>
                    <a href="{{ route('dashboards') }}" class="btn btn-primary">Dashboard</a>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">

            <form action="{{ route('create.profile') }}" method="post">
                @csrf
                {{-- @method('post') --}}
                <div class="row">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name"
                        value="{{ old('first_name') }}" >
                        @error('first_name')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name"
                        value="{{ old('last_name') }}" >
                        @error('last_name')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Other Names</label>
                        <input type="text" class="form-control" name="other_name" id="other_name" placeholder="other name"
                        value="{{ old('other_name') }}" >
                        @error('other_name')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Gender</label>
                        <select class="form-control form-select" name="gender" id="gender">
                            <option value="">Gender</option>
                            <option value="Male" >Male</option>
                            <option value="Female" >Female</option>
                        </select>
                        @error('gender')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Marital Status</label>
                        <select class="form-control form-select" name="marital_status" id="marital_status">
                            <option value="">Marital Status</option>
                            <option value="Single" >Single</option>
                            <option value="Married" >Married</option>
                            <option value="Divorced" >Divorced</option>
                            <option value="Disclosed" >Disclosed</option>
                        </select>
                        @error('marital_status')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Nationality</label>
                        <select class="form-control form-select" name="nationality" id="nationality">
                            <option value="">Nationality</option>
                            <option value="NG">Nigerian</option>
                        </select>
                        @error('nationality')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">State</label>
                        <select class="form-control form-select select2" name="state" id="state">
                            <option value="">State</option>
                            @foreach ($states as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('state')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">LGA</label>
                        <select class="form-control form-select" name="lga" id="lga">
                            <option value="">Lga</option>
                            @foreach ($lgas as $row)
                            <option value="{{ $row->id }}" >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('lga')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Town</label>
                        <input type="text" class="form-control" name="town" id="town" placeholder="Town"  value="{{ old('town') }}">
                        @error('town')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="town" placeholder="phone number"
                        value="{{ old('phone_number') }}" >
                        @error('phone_number')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Date of birth</label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" >
                        @error('date_of_birth')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-sm-12 my-2">
                        <label for="">Place Of Birth</label>
                        <input type="text" class="form-control" name="place_of_birth" id="place_of_birth" placeholder="Place Of Birth"
                        value="{{ old('place_of_birth') }}" >
                        @error('place_of_birth')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12 my-2">
                        <label for="">Address Line One</label>
                        <input type="text" class="form-control" name="address_line_1" id="address_line_1" placeholder="Address One"
                        value="{{ old('address_line_1') }}" >
                        @error('address_line_1')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12 my-2">
                        <label for="">Address Line Two</label>
                        <input type="text" class="form-control" name="address_line_2" id="address_line_2" placeholder="Address Two"
                        value="{{ old('address_line_2') }}" >
                        @error('address_line_2')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 my-2">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Save profile</button>
                    </div>


                </div>
            </form>

        </div>
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
