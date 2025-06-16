@extends('layouts.main')
@section('page_title')
Consent Agreement
@endsection

@push('css')
<link rel="stylesheet" href="../../assets/vendor/libs/bs-stepper/bs-stepper.css" />
@endpush

@section('page_content')

{{-- *** Profile menu Starts ***** --}}
@include('layouts.profile_menu')
{{-- *** Profile menu Ends ***** --}}

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
            <div class="card-header bg-light text-white">
                <h5 class="mb-0">Consent Agreement</h5>
            </div>
            <div class="card-body">
                <p class="mb-4">
                    By proceeding, you confirm that all the information and data you have provided on this platform are true, complete, and accurate to the best of your knowledge.
                </p>
                <p class="mb-4">
                    You also consent and grant permission to the <strong>Nigeria Hypertensive Society (NHS)</strong> to securely store, process, and use your data for administrative, research, and official communication purposes, in line with data protection regulations and the Society’s objectives.
                </p>
                <p class="mb-4">
                    The Nigeria Hypertensive Society affirms that your data will not be misused, shared with third parties without consent, or used for commercial purposes.
                </p>
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="consentCheck">
                    <label class="form-check-label" for="consentCheck">
                        I agree to the above terms and consent to the Nigeria Hypertensive Society holding my data.
                    </label>
                </div>

                <form action="{{ route('consent.submit') }}" method="POST" class="mt-4">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="consent" value="1" id="consent">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit Consent</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="../../assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
<script>
    document.getElementById('consentCheck').addEventListener('change', function () {
        document.getElementById('submitBtn').disabled = !this.checked;
    });
</script>
@endpush

@endsection
