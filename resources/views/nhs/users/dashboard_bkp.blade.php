@extends('layouts.main')
@section('page_title')
Dashboard
@endsection

@section('page_content')

<div class="row">

    <div class="col-lg-4 col-sm-12 ">
        <div class="card mb-4">
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
                {{-- <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Tax id:</span>
                  <span>Tax-8965</span>
                </li> --}}
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
              @can('can_suspend')
              <div class="d-flex justify-content-center">
                {{-- <a href="javascript:;" class="btn btn-primary me-3 waves-effect waves-light" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a> --}}
                <a href="javascript:;" class="btn btn-label-danger suspend-user waves-effect">Suspended</a>
              </div>
              @endcan
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-8 col-sm-12 ">
        <div class="row">
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                    <h6 class="mb-0 me-2 text-uppercase">{{ auth()->user()->MemberType->name }}</h6>
                    <small>Membership plan</small>
                    </div>
                    <div class="card-icon">
                    <span class="badge bg-label-success rounded-pill p-2">
                        <i class="ti ti-user-check ti-sm text-success"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                    <h5 class="mb-0 me-2">0</h5>
                    <small>Events Attended/Paid</small>
                    </div>
                    <div class="card-icon">
                    <span class="badge bg-label-danger rounded-pill p-2">
                        <i class="ti ti-user-cancel ti-sm text-danger"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                    <h5 class="mb-0 me-2">5 - Events</h5>
                    <small>Events</small>
                    </div>
                    <div class="card-icon">
                    <span class="badge bg-label-success rounded-pill p-2">
                        <i class="ti ti-calendar ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                    <h5 class="mb-0 me-2">20,000</h5>
                    <small>Total Payments</small>
                    </div>
                    <div class="card-icon">
                    <span class="badge bg-label-danger rounded-pill p-2">
                        <i class="ti ti-chart-pie-2 ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>


            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                    <h5 class="mb-0 me-2">1</h5>
                    <small>Unpaid Events</small>
                    </div>
                    <div class="card-icon">
                    <span class="badge bg-label-danger rounded-pill p-2">
                        <i class="ti ti-chart-pie-2 ti-sm text-danger"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                    <h5 class="mb-0 me-2">{{ date('Y-m-d') }}</h5>
                    <small>Date</small>
                    </div>
                    <div class="card-icon">
                    <span class="badge bg-label-warning rounded-pill p-2">
                        <i class="ti ti-calendar ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
