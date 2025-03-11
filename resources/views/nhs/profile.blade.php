@extends('layouts.main')
@section('page_title')
Profile
@endsection

@section('page_content')

<div class="row">

    <div class="col-xl-4 col-lg-5 col-md-5 col-sm-12 order-1 order-md-0">
        <!-- User Card -->
        <div class="card mb-4">
            <div class="card-header my-0 pb-0">
                <button class="btn btn-primary btn-xs" data-bs-target="#smallModal" data-bs-toggle="modal" style="float:right">Add Avatar <i class="ti ti-upload"></i></button>
            </div>
          <div class="card-body">
            <div class="user-avatar-section">
              <div class="d-flex align-items-center flex-column">
                <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ auth()->user()->profile->avatar ? auth()->user()->profile->avatar : '../../assets/avatar/dummy.jpeg' }}" height="100" width="100" alt="User avatar">
                <div class="user-info text-center">
                  <h5 class="mb-2 text-uppercase">{{ auth()->user()->profile ? auth()->user()->profile->last_name.' '.auth()->user()->profile->first_name : auth()->user()->name }}</h5>
                  <span class="badge bg-label-info mt-1 text-uppercase">{{ auth()->user()->memberType->name }}</span>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
              <div class="d-flex align-items-start me-4 mt-3 gap-2">
                <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-checkbox ti-sm"></i></span>
                <div>
                  <p class="mb-0 fw-medium">{{ count(auth()->user()->successPayments) }}</p>
                  <small>Payments</small>
                </div>
              </div>
              <div class="d-flex align-items-start mt-3 gap-2">
                <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-briefcase ti-sm"></i></span>
                <div>
                  <p class="mb-0 fw-medium">{{ count(auth()->user()->eventPayments) }}</p>
                  <small>Events Attended</small>
                </div>
              </div>
            </div>
            <p class="mt-4 small text-uppercase text-muted">Details</p>
            <div class="info-container">
              <ul class="list-unstyled">
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Email:</span>
                  <span>{{ auth()->user()->email }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Status:</span>
                  {!! auth()->user()->status == 1 ? '<span class="badge bg-label-success">Active</span>' : '<span class="badge bg-label-danger">In-active</span>' !!}
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Membership:</span>
                  <span class="">{{ auth()->user()->memberType->name }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Contact:</span>
                  <span>{{ $profile ? $profile->phone_number : 'NA' }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Nationality:</span>
                  <span>{{ $profile ? $profile->nationality : 'NA' }}</span>
                </li>
                <li class="pt-1">
                  <span class="fw-medium me-1">Membership Expiry Date:</span>
                  <span class="badge bg-primary">
                    {{ auth()->user()->membershipPayment ? auth()->user()->membershipPayment->created_at->addYear() : 'NA' }}
                  </span>
                </li>
              </ul>
              @if (auth()->user()->type == 2)
              <div class="d-flex justify-content-center">
                @if (auth()->user()->status == 0)
                <a href="javascript:void(0);" class="btn btn-label-danger suspend-user waves-effect">Suspended</a>
                @endif
              </div>
              @endif
            </div>
          </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-12">
        @can('membership_expire')
        @if(date('Y-m-d') >= auth()->user()->created_at->addYears(1)->format('Y-m-d'))
        <div class="alert alert-danger">Your membership package has expired please
            <button class="btn btn-primary btn-sm">Click </button> to renew membership
        </div>
        @endif
        @endcan
        <div class="card mb-3">
          <div class="card-header pt-1">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-password" aria-controls="navs-tab-home" aria-selected="true">
                  Change Password
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-profile" aria-controls="navs-tab-profile" aria-selected="false" tabindex="-1">
                  Edit Profile
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" data-bs-toggle="tab" role="tab" data-bs-target="#navs-tab-payments" aria-controls="navs-tab-payments" aria-selected="false" tabindex="-1">
                  Payments
                </button>
              </li>
            </ul>
          </div>
          <div class="card-body pt-3">
            <div class="tab-content p-0">

              <div class="tab-pane fade active show" id="navs-tab-password" role="tabpanel">
                <h5 class="card-title">Change Password</h5>
                <p>Ensure your account is using a long, random password to stay secure.</p>
                 <form action="{{ route('password.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row align-items-end">
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <div class="col-md-6 col-sm-12 my-1">
                            <label for=""></label>
                            <input type="text" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
                            @error('current_password')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 col-sm-12 my-1">
                            <label for=""></label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="New Password">
                            @error('password')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 col-sm-12 my-1">
                            <label for=""></label>
                            <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                            @error('password_confirmation')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 col-sm-12 my-1">
                            <button class="btn btn-primary" style="float:">Save</button>
                        </div>
                    </div>
                 </form>
                <p class="mt-3">
                {{-- <a href="{{route('dashboards')}}" class="btn btn-primary waves-effect waves-light">Go home</a> --}}
                </p>
              </div>

              <div class="tab-pane fade text-left" id="navs-tab-profile" role="tabpanel">
                <h5 class="card-title">Update profile biodata</h5>
                <form action="{{ route('update.profile') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name"
                            value="{{ $profile ? $profile->first_name : '' }}">
                            @error('first_name')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name"
                            value="{{ $profile ? $profile->last_name : '' }}">
                            @error('last_name')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Other Names</label>
                            <input type="text" class="form-control" name="other_name" id="other_name" placeholder="other name"
                            value="{{ $profile ? $profile->other_name : '' }}">
                            @error('other_name')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Gender</label>
                            <select class="form-control form-select" name="gender" id="gender">
                                <option value="">Gender</option>
                                <option value="Male" @if ($profile && $profile->gender == 'Male') {!! 'selected' !!}  @endif >Male</option>
                                <option value="Female" @if ($profile && $profile->gender == 'Female') {!! 'selected' !!}  @endif>Female</option>
                            </select>
                            @error('gender')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Marital Status</label>
                            <select class="form-control form-select" name="marital_status" id="marital_status">
                                <option value="">Marital Status</option>
                                <option value="Single" @if($profile && $profile->marital_status == 'Single') {!! 'selected' !!}  @endif >Single</option>
                                <option value="Married" @if($profile && $profile->marital_status == 'Married') {!! 'selected' !!}  @endif >Married</option>
                                <option value="Divorced" @if($profile && $profile->marital_status == 'Divorced') {!! 'selected' !!}  @endif >Divorced</option>
                                <option value="Disclosed" @if($profile && $profile->marital_status == 'Disclosed') {!! 'selected' !!}  @endif >Disclosed</option>
                            </select>
                            @error('marital_status')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Nationality</label>
                            <select class="form-control form-select" name="nationality" id="nationality">
                                <option value="">Nationality</option>
                                <option value="NG" @if($profile && $profile->nationality == 'NG') {!! 'selected' !!}  @endif>Nigerian</option>
                            </select>
                            @error('nationality')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">State</label>
                            <select class="form-control form-select" name="state" id="state">
                                <option value="">State</option>
                                {{-- @foreach ($states as $row)
                                <option value="{{ $row->id }}" @if($profile && $profile->state == $row->id ) {!! 'selected' !!}  @endif >{{ $row->name }}</option>
                                @endforeach --}}
                            </select>
                            @error('state')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">LGA</label>
                            <select class="form-control form-select" name="lga" id="lga">
                                <option value="">Lga</option>
                                {{-- @foreach ($lgas as $row)
                                <option value="{{ $row->id }}" @if($profile && $profile->lga == $row->id ) {!! 'selected' !!}  @endif >{{ $row->name }}</option>
                                @endforeach --}}
                            </select>
                            @error('lga')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Town</label>
                            <input type="text" class="form-control" name="town" id="town" placeholder="Town"
                            value="{{ $profile ? $profile->town : '' }}" >
                            @error('town')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" id="town" placeholder="phone_number"
                            value="{{ $profile ? $profile->phone_number : '' }}" >
                            @error('phone_number')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Date of birth</label>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                            value="{{ $profile ? $profile->date_of_birth : '' }}" >
                            @error('date_of_birth')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-sm-12 my-2">
                            <label for="">Place Of Birth</label>
                            <input type="text" class="form-control" name="place_of_birth" id="place_of_birth" placeholder="Place Of Birth"
                            value="{{ $profile ? $profile->place_of_birth : '' }}" >
                            @error('place_of_birth')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 my-2">
                            <label for="">Address Line One</label>
                            <input type="text" class="form-control" name="address_line_1" id="address_line_1" placeholder="Address One"
                            value="{{ $profile ? $profile->address_line_1 : '' }}" >
                            @error('address_line_1')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 my-2">
                            <label for="">Address Line Two</label>
                            <input type="text" class="form-control" name="address_line_2" id="address_line_2" placeholder="Address Two"
                            value="{{ $profile ? $profile->address_line_2 : '' }}" >
                            @error('address_line_2')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 my-2">
                            <button class="btn btn-primary waves-effect waves-light">Save profile</button>
                        </div>


                    </div>
                </form>

              </div>

              <div class="tab-pane fade" id="navs-tab-payments" role="tabpanel">
                <h6 class="card-title">All my payments</h5>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Payment For</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        @forelse (auth()->user()->successPayments as $row)
                        <tr>
                            <td>#</td>
                            <td>{{ $row->paymentType() }}</td>
                            <td><del>N</del>{{ number_format($row->amount, 2) }}</td>
                            <td>{{ DATE($row->created_at) }}</td>
                            @empty
                            <td class="text-center"  colspan="4">No payments found</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
                <a href="{{route('dashboards')}}" class="btn btn-primary waves-effect waves-light mt-2">Go Back</a>
              </div>

            </div>
          </div>
        </div>
    </div>

</div>



{{-- MODAL START --}}
<div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form action="{{ route('upload.avatar') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="modal-content">
                <div class="modal-header">
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-12 col-sm-12 mb-0">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- MODAL ENDS --}}

@endsection


