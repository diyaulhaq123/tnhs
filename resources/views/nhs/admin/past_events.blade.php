@extends('layouts.main')
@section('page_title')
Past Events
@endsection

@use('App\Repositories\Event\EventRepository', 'EventRepository')
@php
    $event = new EventRepository;
    $characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = str_shuffle($characters);
    $reference = substr($randomString, 0, 15);
@endphp

@section('page_content')
<div class="row justify-content-between mb-1">
    <div class="col-6">
        <h5 class="text-uppercase">Past Events</h5>
    </div>

</div>

{{-- ******************* Past events ******************* --}}

<div class="row mb-5" style="height:400px; overflow: scroll;">

    @forelse ($done_events as $row)
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="card-img card-img-left" src="../../assets/img/event1.jpg" alt="Card image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $row->title ?? 'NA' }}
                            @can('event_payment_list')
                            <a href="{{ route('event.pay-list', $row->id) }}" class="btn btn-primary btn-sm" style="float:right"> View <i class="ti ti-eye"></i></a>
                            @endcan
                        </h5>
                        <p class="card-text">
                            {{ $row->description }}
                        </p>
                        <div class="col">
                            <p class="card-text">Amount - {{ number_format($row->amount, 2)  ?? '0.00' }}</p>
                        </div>
                        <div class="col-12 d-flex mt-4">
                            <p class="card-text col-4">
                                <small class="text-muted">{{ $row->date  ?? 'NA'}}</small>
                            </p>
                            <div class="col-8  align-content-end">
                                @can('event_payment_status')
                                @if($event->checkEventPayment($row->id, auth()->user()->id))
                                <button class="btn btn-primary btn-sm" >Print Ticket</button>
                                <button class="btn btn-success btn-xs" style="float:right"> Paid<i class="ti ti-check"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-xs" style="float:right"> Not Paid<i class="ti ti-ban"></i></button>
                                    @if($row->status == 'pending')
                                    <form action="{{ route('pay') }}" method="post" id="paymentForm">
                                        @csrf
                                        <input type="hidden" name="payment_type_id" value="2">
                                        <input type="hidden" name="event_id" value="{{ $row->id ?? '' }}">
                                        <input type="hidden" name="email" id="email" value="{{ auth()->user()->email}}">
                                        <input type="hidden" name="amount" id="amount" value="{{ $row->amount*100 ?? '' }}">
                                        <input type="hidden" name="reference" value="{{ $reference }}">
                                        <button type="submit" class="btn btn-primary btn-sm" id="btnBuyTicket">Buy Ticket</button>
                                    </form>
                                    @endif
                                @endif
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="row g-0">
            <div class="col-md-4">
                <img class="card-img card-img-left" src="../../assets/img/event1.jpg" alt="Card image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">No events </h5>
                <p class="card-text">
                    No Events founds
                </p>
                <div class="col">
                    <p class="card-text">Amount - 00.00</p>
                </div>
                <div class="col mt-4">
                    <p class="card-text "><small class="text-muted">{{ date('Y-m-d') }}</small></p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    @endforelse

</div>


@endsection
