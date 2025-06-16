@extends('layouts.main')
@section('page_title')
Dashboard
@endsection

@section('page_content')
<div class="row">
    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($users)) ?? '0' }}</h5>
              <small>Total Members</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-primary rounded-pill p-2">
                <i class="ti ti-users ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100 h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($active_users)) ?? '0' }}</h5>
              <small>Total Active Members</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-success rounded-pill p-2">
                <i class="ti ti-user-check ti-sm text-success"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100 h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($in_active)) ?? '0' }}</h5>
              <small>Total In-active Members</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-danger rounded-pill p-2">
                <i class="ti ti-user-cancel ti-sm text-danger"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100 h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($events)) ?? '0' }} - Events</h5>
              <small>Events</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-success rounded-pill p-2">
                <i class="ti ti-calendar ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($pendings)) ?? '0' }} </h5>
              <small>Pending Events</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-success rounded-pill p-2">
                <i class="ti ti-calendar ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format(count($done_events)) ?? '0' }}</h5>
              <small>Past Events</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-success rounded-pill p-2">
                <i class="ti ti-calendar ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format($total_payments, 2) ?? '0' }}</h5>
              <small>Payments</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-danger rounded-pill p-2">
                <i class="ti ti-chart-pie-2 ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format($success_payments, 2) ?? '0' }}</h5>
              <small>Succeful Payments</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-success rounded-pill p-2">
                <i class="ti ti-chart-pie-2 ti-sm text-success"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ number_format($pending_payments, 2) ?? '0' }}</h5>
              <small>Pending Payments</small>
            </div>
            <div class="card-icon dashboard-icon">
              <span class="badge bg-label-danger rounded-pill p-2">
                <i class="ti ti-chart-pie-2 ti-sm text-danger"></i>
              </span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card dashboard-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">0</h5>
              <small>Issues Found</small>
            </div>
            <div class="card-icon dashboard-icon">
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
    <div class="card dashboard-card p-3">
        <h5 class="card-header">Latest Payments <span style="font-size: 12px">(Last 20)</span> </h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped table-bordered" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Email</th>
                <th>Service Type</th>
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
                <td>{{ $row->paymentType->name ?? '--' }}</td>
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






@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />

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


@push('scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush

@endsection
