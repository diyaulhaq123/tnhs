@extends('layouts.main')
@section('page_title')
Dashboard
@endsection

@push('css')
    <style>
        .dashboard-card {
            border: none;
            border-radius: 16px;
            background: linear-gradient(145deg, #f4f6fb, #ffffff);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .dashboard-icon {
            background-color: #f0f0f5;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .dashboard-icon i {
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover .dashboard-icon i {
            transform: scale(1.2);
        }

        .card-title h5,
        .card-title h6 {
            font-weight: 600;
            color: #222;
        }

        .card-title small {
            color: #666;
        }
    </style>
@endpush


@section('page_content')

<div class="row">
    <div class="row text-center">
        @if(auth()->user()->type == 2 && empty(auth()->user()->membershipPayment))
        <div class="alert alert-danger">Payment for Membership not found
            <a href="{{ route('membership.pay') }}" class="btn btn-danger btn-sm">Click here </a> to pay membership
        </div>
        @elseif (auth()->user()->type == 2 && auth()->user()->membershipPayment && auth()->user()->membershipPayment->created_at->addYear() < now())
        <div class="alert alert-warning">Your membership has expired
            <a href="{{ route('membership.pay') }}" class="btn btn-warning btn-sm">Click here </a> to renew membership
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 pt-1 mt-4" src="@if((auth()->user()->profile) && auth()->user()->profile->avatar != '' ){{ asset(auth()->user()->profile->avatar) }} @else {{ asset('../../assets/avatar/dummy.jpeg') }} @endif" height="100" width="100" alt="User avatar">
                        <div class="user-info text-center">
                        <h5 class="mb-2 text-uppercase">{{ auth()->user()->profile ? auth()->user()->profile->last_name.' '.auth()->user()->profile->first_name : auth()->user()->name }}</h5>
                        @if (auth()->user()->type == 2)
                        <span class="badge bg-label-info mt-1 text-uppercase">{{ auth()->user()->memberType->name ?? 'Member' }}</span>
                        @endif
                        </div>
                    </div>
                    </div>
                    @if (auth()->user()->type == 2)
                    <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-1 border-bottom">
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
                        @if (auth()->user()->type == 2 && auth()->user()->membership_number != null)
                        <div class=" align-items-start mt-2">
                            <span class="badge bg-info fw-bold" >{{ auth()->user()->membership_number }}</span>
                        </div>
                        @endif
                    </div>


                    @endif
                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                    <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Email:</span>
                        <span>{{ auth()->user()->email }}</span>
                        </li>
                        @if (auth()->user()->type == 2)
                            <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Status:</span>
                            {!! auth()->user()->status == 1 ? '<span class="badge bg-label-success">Active</span>' : '<span class="badge bg-label-danger">In-active</span>' !!}
                            </li>
                            @can('membership_expire')
                            <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Membership:</span>
                            <span class="">{{ auth()->user()->memberType->name ?? 'Member' }}</span>
                            </li>
                            @endcan

                            <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Contact:</span>
                            <span>{{ $profile ? $profile->phone_number : 'NA' }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-medium me-1">Nationality:</span>
                                <span>{{ $profile ? $profile->nationality : 'NA' }}</span>
                            </li>
                            @can('membership_expire')
                            <li class="pt-1">
                                <span class="fw-medium me-1">Membership Expiry Date:</span>
                                <span class="badge bg-primary">
                                    {{ auth()->user()->membershipPayment ? auth()->user()->membershipPayment->created_at->addYear() : 'NA' }}
                                </span>
                            </li>
                            @endcan
                            @if (auth()->user()->type == 2)
                            <li class="mt-2 pt-1">
                                <span class="fw-medium me-1">Memberhsip Form:</span>
                                <span>
                                    @if (auth()->user()->completed_profile == 1)
                                    {{-- {{ auth()->user()->id.'/user' }} --}}
                                    <a href="{{ route('user.display', auth()->user()->id) }}" class="badge bg-success ">Complete</a>
                                    @else
                                    <span class="badge bg-warning">Incomplete</span>
                                    @endif
                                </span>
                            </li>
                            @endif

                        @endif
                    </ul>
                    {{-- @if (auth()->user()->type == 2)
                    <div class="d-flex justify-content-center">
                        @if (auth()->user()->status == 0)
                        <a href="javascript:void(0);" class="btn btn-label-danger suspend-user waves-effect">Suspended</a>
                        @endif
                    </div>
                    @endif --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
            <div class="row">
                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card dashboard-card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h6 class="mb-0 me-2 text-uppercase">
                                    {{ auth()->user()->MemberType ? auth()->user()->MemberType->name : 'Member' }}
                                </h6>
                                <small>Membership Plan</small>
                            </div>
                            <div class="dashboard-icon text-success">
                                <i class="ti ti-user-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card dashboard-card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h5 class="mb-0 me-2">{{ count(auth()->user()->eventPayments) }}</h5>
                                <small>Events Attended/Paid</small>
                            </div>
                            <div class="dashboard-icon text-danger">
                                <i class="ti ti-user-cancel"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card dashboard-card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h5 class="mb-0 me-2">{{ count($events) }} - Events</h5>
                                <small>Total Events</small>
                            </div>
                            <div class="dashboard-icon text-primary">
                                <i class="ti ti-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card dashboard-card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h5 class="mb-0 me-2">₦{{ number_format(auth()->user()->successPaymentsTotal(), 2) }} </h5>
                                <small>Total Payments</small>
                            </div>
                            <div class="dashboard-icon text-success">
                                <i class="ti ti-chart-pie-2"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card dashboard-card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h5 class="mb-0 me-2">{{  count($events) - count(auth()->user()->eventPayments) }}</h5>
                                <small>Unpaid Events</small>
                            </div>
                            <div class="dashboard-icon text-warning">
                                <i class="ti ti-alert-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card dashboard-card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h5 class="mb-0 me-2">{{ date('Y-m-d') }}</h5>
                                <small>Date</small>
                            </div>
                            <div class="dashboard-icon text-info">
                                <i class="ti ti-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
