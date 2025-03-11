@extends('layouts.main')
@section('page_title')
Dashboard
@endsection

@section('page_content')
<div class="row">
    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($users)) ?? '0' }}</h5>
              <small>Total Members</small>
            </div>
            <div class="card-icon">
              <span class="badge bg-label-primary rounded-pill p-2">
                <i class="ti ti-users ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($active_users)) ?? '0' }}</h5>
              <small>Total Active Members</small>
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
              <h5 class="mb-0 me-2">{{ number_format(count($in_active)) ?? '0' }}</h5>
              <small>Total In-active Members</small>
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
              <h5 class="mb-0 me-2">{{ number_format(count($events)) ?? '0' }} - Events</h5>
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
              <h5 class="mb-0 me-2">{{ number_format(count($pendings)) ?? '0' }} </h5>
              <small>Pending Events</small>
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
              <h5 class="mb-0 me-2">{{ number_format(count($done_events)) ?? '0' }}</h5>
              <small>Past Events</small>
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
              <h5 class="mb-0 me-2">{{ number_format($total_payments, 2) ?? '0' }}</h5>
              <small>Payments</small>
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
              <h5 class="mb-0 me-2">{{ number_format($success_payments, 2) ?? '0' }}</h5>
              <small>Succeful Payments</small>
            </div>
            <div class="card-icon">
              <span class="badge bg-label-success rounded-pill p-2">
                <i class="ti ti-chart-pie-2 ti-sm text-success"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format($pending_payments, 2) ?? '0' }}</h5>
              <small>Pending Payments</small>
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
              <h5 class="mb-0 me-2">0</h5>
              <small>Issues Found</small>
            </div>
            <div class="card-icon">
              <span class="badge bg-label-warning rounded-pill p-2">
                <i class="ti ti-alert-octagon ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

</div>
<div class="row justify-content-center">
   <div class="col-lg-12 col-sm-12">
    <div class="card">
        <h5 class="card-header">Latest Payments <i style="font-size: 12px">(Last 20)</i> </h5>
        <div class="table-responsive text-nowrap">
          <table class="table ">
            <thead>
              <tr>
                <th>#</th>
                <th>Email</th>
                <th>Payment Type</th>
                <th>Amount</th>
                <th>Status</th>
                {{-- <th>Actions</th> --}}
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @php
                    $sn = 0;
                @endphp
                @foreach ($payments as $row)
              <tr>
                <td>{{ ++$sn }}</td>
                <td> {{ $row->user->email ?? 'NA' }}</td>
                <td>{{ $row->paymentType() ?? '--' }}</td>
                <td> <del>N</del> {{ number_format($row->amount, 2) ?? '--' }} </td>
                <td>
                    {!!  $row->remark == 'success' ? '<span class="badge bg-success me-1">Success</span>' : '<span class="badge bg-danger me-1">Pending</span>' !!}
                </td>
                {{-- <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                      <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Delete</a>
                    </div>
                  </div>
                </td> --}}
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
    </div>
   </div>
</div>

@endsection
