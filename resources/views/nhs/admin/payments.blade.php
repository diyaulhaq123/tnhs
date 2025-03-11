@extends('layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />
@endpush

@section('page_title')
Payments
@endsection

@section('page_content')

<div class="card p-4">
    <div class="row p-2 mb-2">
        <h5 class="fw-bold">Payment List</h5>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Payment Type</th>
                            <th>Payer</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $index => $row)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $row->paymentType() ?? 'Na' }}</td>
                            <td>{{ $row->user->email ?? 'NA' }}</td>
                            <td><del>N</del>{{ number_format($row->amount, 2) ?? '0.00' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('receipt.view', $row->id) }}" target="_blank" class="btn btn-primary btn-xs"><i class="ti ti-eye"></i></a>
                                    {{-- <button class="btn btn-danger btn-xs"><i class="ti ti-trash"></i></button> --}}
                                </div>
                            </td>
                            @empty
                            <td colspan="5" class="text-center">No Payments found</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


@push('scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush

@endsection
