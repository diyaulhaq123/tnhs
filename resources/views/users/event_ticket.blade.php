@extends('layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<style>
    body {
        background-color: #f8f9fa;
    }
    .ticket-card {
        max-width: 600px;
        margin: auto;
        border-radius: 16px;
    }
    .ticket-logo {
        max-width: 100px;
    }
</style>
@endpush

@section('page_title')
Event Ticket
@endsection

@section('page_content')

<div class="card ticket-card shadow" id="ticket">

    {{-- <div class="card ticket-card shadow"> --}}
        <div class="card-header bg-light text-white text-center">
            <img src="{{ $setting->logo ? $setting->logo : asset('assets/img/nhs-logo.png') }}?v={{ time() }}" alt="Logo" width="100" class="rounded-circle">
            <h4 class="fw-bold text-primary">{{ env('APP_NAME') }}</h4>
            <h5 class="mb-0 fw-bold">Event Ticket</h5>
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <strong>Title:</strong> {{ $event_payment->event->title }}<br>
                <strong>Description:</strong> {{ $event_payment->event->description }}
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-6"><strong>Payment Type:</strong></div>
                <div class="col-6 text-end">{{ 'Event Payment' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-6"><strong>Reference:</strong></div>
                <div class="col-6 text-end">{{ $event_payment->reference }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-6"><strong>Amount:</strong></div>
                <div class="col-6 text-end">₦{{ number_format($event_payment->amount, 2) }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-6"><strong>Remark:</strong></div>
                <div class="col-6 text-end">{{ ucfirst($event_payment->remark) }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-6"><strong>Date:</strong></div>
                <div class="col-6 text-end">{{ $event_payment->event->date }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-6"><strong>End Date:</strong></div>
                <div class="col-6 text-end">{{ $event_payment->event->end_date }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-6"><strong>Start Time:</strong></div>
                <div class="col-6 text-end">{{ $event_payment->event->start_time }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-6"><strong>End Time:</strong></div>
                <div class="col-6 text-end">{{ $event_payment->event->end_time }}</div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-success" id="downloadBtn">Download Ticket</button>
        </div>
    {{-- </div> --}}
</div>


@push('scripts')
<script src="https://rawgit.com/DoersGuild/jQuery.print/master/jQuery.print.js"></script>

{{-- <script>
    $(document).ready(function(){
        $('#downloadBtn').click(function(){
            $('#ticket').print();
        });
    });
</script> --}}
<script>
    document.getElementById("downloadBtn").addEventListener("click", () => {
        const ticket = document.getElementById("ticket");

        const opt = {
            margin:       0.5,
            filename:     'event-ticket.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(ticket).save();
    });
</script>

@endpush

@endsection
