@extends('layouts.main')

@section('page_title')
Payments
@endsection

@section('page_content')

<div class="card p-4">
    <div class="row p-2 mb-2">
        <h5 class="fw-bold">Payment List</h5>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table" id="payment-table"></table>
            </div>
        </div>

    </div>
</div>



@push('css')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" /> --}}">
<link rel="stylesheet" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css">
@endpush

@push('scripts')
    {{-- <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script> --}}

    {{-- <script>
        let table = new DataTable('#myTable');
    </script> --}}

    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script>
         // Parse the PHP JSON string into JavaScript object
        const payments = JSON.parse(@json($payments));
        new gridjs.Grid({
        columns: ["Payer", "Service Type", "Remark", "Amount", "Reference", "Action"],
        data: payments.map(payment => [
        payment.user?.name ?? "N/A",
        payment.payment_type?.name ?? "N/A", // You must eager load this
        // payment.event?.title ?? "N/A",        // You must eager load this
        payment.remark,
        parseFloat(payment.amount).toFixed(2),
        payment.reference,
        gridjs.html(`<a href='/receipt/${payment.id}' target='_blank' class=''><i class='text-info fa fa-eye'></i></a>`)
        ]),
        pagination: {
        enabled: true,
        limit: 10
        },
        search: true,
        sort: true,
        className: {
        table: 'table table-bordered'
        }
    }).render(document.getElementById("payment-table"));
    </script>
@endpush

@endsection
