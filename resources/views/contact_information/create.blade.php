@extends('layouts.main')

@section('page_title')
    Contact Information
@endsection

@push('css')
<link rel="stylesheet" href="../../assets/vendor/libs/bs-stepper/bs-stepper.css" />
<style>
    .form-control {
        height: 40px;
        font-size: 14px;
        border-radius: 0;
    }
    .form-select {
        height: 40px;
        font-size: 14px;
        border-radius: 0;
    }
    .btn {
        border-radius: 0;
    }
</style>
@endpush

@section('page_content')

{{-- *** Profile menu Starts ***** --}}
@include('layouts.profile_menu')
{{-- *** Profile menu Ends ***** --}}

<div class="row">
    <div class="card">
        <div class="card-header justify-content-center">
            <h5 class="card-title">Contact Information</h5>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{ route('contact-information.store') }}" method="POST">
                    @csrf

                    @if(isset($contactInfo))
                        <input type="hidden" name="id" value="{{ $contactInfo->id }}">
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="place_of_work" class="form-label">Place of Work <span class="text-danger">*</span></label>
                            <input type="text" name="place_of_work" class="form-control"
                                value="{{ old('place_of_work', $contactInfo->place_of_work ?? '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" name="department" class="form-control"
                                value="{{ old('department', $contactInfo->department ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Position<span class="text-danger">*</span></label>
                            <input type="text" name="position" class="form-control"
                                value="{{ old('position', $contactInfo->position ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="professional_field" class="form-label">Professional Field<span class="text-danger">*</span></label>
                            <input type="text" name="professional_field" class="form-control"
                                value="{{ old('professional_field', $contactInfo->professional_field ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="official_address" class="form-label">Official Address</label>
                            <input type="text" name="official_address" class="form-control"
                                value="{{ old('official_address', $contactInfo->official_address ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label">Phone Number<span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" class="form-control"
                                value="{{ old('phone_number', $contactInfo->phone_number ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="whatsapp_number" class="form-label">WhatsApp Number<span class="text-danger">*</span></label>
                            <input type="text" name="whatsapp_number" class="form-control"
                                value="{{ old('whatsapp_number', $contactInfo->whatsapp_number ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Official Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $contactInfo->email ?? '') }}">
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary float-end">
                            {{ isset($contactInfo) ? 'Update Information' : 'Save Information' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="../../assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
@endpush

@endsection
