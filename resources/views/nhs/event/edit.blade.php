@extends('layouts.main')
@section('page_title')
Edit Event
@endsection

@section('page_content')

<div class="card p-3 mt-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <form action="{{ route('update.event', $event->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row g-2">
                        <div class="col-md-12 col-sm-12 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input
                            type="text" value="{{ $event->title }}"
                            id="title"
                            name="title"
                            class="form-control"
                            placeholder="Enter Name" />
                        </div>

                        <div class="col-md-6 col-sm-12 mb-0">
                        <label for="date" class="form-label">Event Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $event->date }}" />
                        </div>

                        <div class="col-md-6 col-sm-12 mb-0">
                            <label for="date" class="form-label">Event End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date }}" />
                        </div>

                        <div class="col-md-6 col-sm-12 mb-0">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ $event->amount }}" />
                        </div>

                        <div class="col-md-6 col-sm-12 mb-0">
                            <label for="member_type_id" class="form-label">Member type</label>
                            <select name="member_type_id" id="member_type_id" class="form-control form-select">
                                <option value="">Select</option>
                                <option value="0" {{ $event->member_type_id == 0 ? 'selected' : ''  }} >All</option>
                                @foreach ($member_types as $row)
                                <option value="{{ $row->id ?? ''  }}" {{ $row->id == $event->member_type_id ? 'selected' : ''  }} >{{ $row->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col mb-0">
                            <label for="description" class="form-label">Description</label>
                            <input
                                type="text" value="{{ $event->description }}"
                                id="description"
                                name="description"
                                class="form-control"
                                placeholder="Description" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary btn-sm">Save <i class="ti ti-check"></i></button>
                        <a href="{{ route('event.index') }}" class="btn btn-warning btn-sm">Back <i class="ti ti-arrow-back"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
