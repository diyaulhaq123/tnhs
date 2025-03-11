@extends('layouts.main')
@section('page_title')
Events
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
        <h5 class="text-uppercase">Events</h5>
    </div>
    @can('add_event')
    <div class="col-6">
        <button class="btn btn-primary" style="float: right" type="button"
        data-bs-toggle="modal"
        data-bs-target="#modalCenter">Add event</button>
    </div>
    @endcan
</div>


{{-- ******************* Current events ******************* --}}
{{-- class="myTable" id="{{ $pendings ?  'myTable' : '' }}" --}}
<div class="row mb-5" style="height:400px; overflow: scroll;">
    @forelse ($pendings as $row)
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
                            <p class="card-text">Amount - {{ number_format($row->amount, 2) ?? '0.00' }}</p>
                        </div>
                        <div class="col-12 d-flex mt-4">
                            <p class="card-text col-4">
                                <small class="text-muted">{{ $row->date ?? 'NA'}}</small>
                            </p>
                            <div class="col-8  align-content-end">
                                @can('event_payment_status')
                                @if($event->checkEventPayment($row->id, auth()->user()->id))
                                <button class="btn btn-primary btn-sm" >Print Ticket</button>
                                <button class="btn btn-success btn-xs" style="float:right"> Paid<i class="ti ti-check"></i></button>
                                @else
                                <form action="{{ route('pay') }}" method="post" id="paymentForm">
                                    @csrf
                                    <input type="hidden" name="payment_type_id" value="2">
                                    <input type="hidden" name="event_id" value="{{ $row->id ?? '' }}">
                                    <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                                    <input type="hidden" name="amount" id="amount" value="{{ $row->amount*100 ?? '' }}">
                                    <input type="hidden" name="reference" value="{{ $reference ?? '' }}">
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnBuyTicket">Buy Ticket</button>

                                    <button type="button" class="btn btn-danger btn-xs" style="float:right"> Not Paid<i class="ti ti-ban"></i></button>
                                </form>
                                @endif
                                @endcan
                                <a href="{{ route('edit.event', $row->id) }}" class="btn btn-info btn-sm" style="float:right">Edit <i class="ti ti-edit"></i></a>
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





{{-- <!-- Modal --> --}}
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form action="{{ route('create.event') }}" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add event</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="row g-2">
                <div class="col-md-12 col-sm-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                      type="text" value="{{ old('title') }}"
                      id="title"
                      name="title"
                      class="form-control"
                      placeholder="Enter Name" />
                </div>

                <div class="col-md-6 col-sm-12 mb-0">
                  <label for="date" class="form-label">Event Date</label>
                  <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" />
                </div>

                <div class="col-md-6 col-sm-12 mb-0">
                    <label for="date" class="form-label">Event End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" />
                  </div>

                <div class="col-md-6 col-sm-12 mb-0">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" />
                </div>

                <div class="col-md-6 col-sm-12 mb-0">
                    <label for="member_type_id" class="form-label">Member type</label>
                    <select name="member_type_id" id="member_type_id" class="form-control form-select" value="{{ old('member_type_id') }}">
                        <option value="">Select</option>
                        <option value="0">All</option>
                        @foreach ($member_types as $row)
                        <option value="{{ $row->id ?? '' }}">{{ $row->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

              </div>


              <div class="row">
                <div class="col mb-0">
                    <label for="description" class="form-label">Description</label>
                    <input
                      type="text" value="{{ old('description') }}"
                      id="description"
                      name="description"
                      class="form-control"
                      placeholder="Description" />
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
      </form>
    </div>
</div>


@endsection
