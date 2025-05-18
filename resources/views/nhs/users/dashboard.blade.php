@extends('layouts.main')
@section('page_title')
Dashboard
@endsection

@section('page_content')

<div class="row">
    <div class="row text-center">
        @if(auth()->user()->type ==2 && empty(auth()->user()->membershipPayment))
        <div class="alert alert-danger">Payment for Membership not found
            <a href="{{ route('membership.pay') }}" class="btn btn-danger btn-sm">Click here </a> to pay membership
        </div>
        @endif
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h6 class="mb-0 me-2 text-uppercase">{{ auth()->user()->MemberType ? auth()->user()->MemberType->name : 'Member' }}</h6>
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

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ count(auth()->user()->eventPayments) }}</h5>
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

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ count($events) }} - Events</h5>
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

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">₦{{ number_format(auth()->user()->successPaymentsTotal(), 2) }} </h5>
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


    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{  count($events) - count(auth()->user()->eventPayments) }}</h5>
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

    <div class="col-lg-3 col-sm-6 mb-4">
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

@endsection
