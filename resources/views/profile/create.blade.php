@extends('layouts.main')
@section('page_title')
Personal Information
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
    <div class="col-12 p-3">
        <div class="card">
            <div class="card-header justify-content-center m-0 pb-0">
                <center><h5 class="card-title fw-bold text-uppercase">Personal Information</h5></center>
            </div>
            <div class="card-body ">
                <div class="row gy-5">
                    <div class="col-lg-12">
                        <div class="px-lg-4">
                            <form action="{{ route('update.profile') }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="row">


                                    <div class="col-lg-12 col-sm-12 my-2">
                                        <label for="">Membership Category <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="membership_category_id" id="membership_category_id">
                                            <option value="">Select Membership Category </option>
                                            @foreach ($membershipCategories as $row)
                                            <option value="{{ $row->id }}" @if( ($profile && $profile->membership_category_id == $row->id) || old('membership_category_id') == $row->id) {!! 'selected' !!}  @endif >{{ $row->name }} {{ $row->description ? ' - '.$row->description : '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                     <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Title <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="title" id="title">
                                            <option value="">Select Title</option>
                                            <option value="Mr" @if( ($profile && $profile->title == 'Mr') || old('title') == 'Mr') {!! 'selected' !!}  @endif>Mr</option>
                                            <option value="Mrs" @if( ($profile && $profile->title == 'Mrs') || old('title') == 'Mrs') {!! 'selected' !!}  @endif>Mrs</option>
                                            <option value="Miss" @if( ($profile && $profile->title == 'Miss') || old('title') == 'Miss') {!! 'selected' !!}  @endif>Miss</option>
                                            <option value="Dr" @if( ($profile && $profile->title == 'Dr') || old('title') == 'Dr') {!! 'selected' !!}  @endif>Dr</option>
                                            <option value="Prof" @if( ($profile && $profile->title == 'Prof') || old('title') == 'Prof') {!! 'selected' !!}  @endif>Prof</option>
                                            <option value="Engr" @if($profile && $profile->title == 'Engr') {!! 'selected' !!}  @endif>Engr</option>
                                            <option value="Chief" @if($profile && $profile->title == 'Chief') {!! 'selected' !!}  @endif>Chief</option>
                                            <option value="Alhaji" @if($profile && $profile->title == 'Alhaji') {!! 'selected' !!}  @endif>Alhaji</option>
                                            <option value="Alhaja" @if($profile && $profile->title == 'Alhaja') {!! 'selected' !!}  @endif>Alhaja</option>
                                            <option value="Pastor" @if($profile && $profile->title == 'Pastor') {!! 'selected' !!}  @endif>Pastor</option>
                                            <option value="Imam" @if($profile && $profile->title == 'Imam') {!! 'selected' !!}  @endif>Imam</option>
                                            <option value="Other" @if($profile && $profile->title == 'Other') {!! 'selected' !!}  @endif>Other</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name"
                                        value="{{ $profile ? $profile->first_name : old('first_name') }}">
                                        @error('first_name')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name"
                                        value="{{ $profile ? $profile->last_name : old('last_name') }}">
                                        @error('last_name')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Other Names</label>
                                        <input type="text" class="form-control" name="other_name" id="other_name" placeholder="Other Name"
                                        value="{{ $profile ? $profile->other_name : old('other_name') }}">
                                        @error('other_name')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Gender<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="gender" id="gender">
                                            <option value="">Gender</option>
                                            <option value="Male" @if ( ($profile && $profile->gender == 'Male') || old('gender') == 'Male') {!! 'selected' !!}  @endif >Male</option>
                                            <option value="Female" @if ( ($profile && $profile->gender == 'Female') || old('gender') == 'Female') {!! 'selected' !!}  @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Marital Status </label>
                                        <select class="form-control form-select" name="marital_status" id="marital_status">
                                            <option value="">Marital Status</option>
                                            <option value="Single" @if( ($profile && $profile->marital_status == 'Single') || old('marital_status') == 'Single') {!! 'selected' !!}  @endif >Single</option>
                                            <option value="Married" @if( ($profile && $profile->marital_status == 'Married') || old('marital_status') == 'Married') {!! 'selected' !!}  @endif >Married</option>
                                            <option value="Divorced" @if( ($profile && $profile->marital_status == 'Divorced') || old('marital_status') == 'Divorced') {!! 'selected' !!}  @endif >Divorced</option>
                                            <option value="Disclosed" @if( ($profile && $profile->marital_status == 'Disclosed') || old('marital_status') == 'Disclosed') {!! 'selected' !!}  @endif >Disclosed</option>
                                        </select>
                                        @error('marital_status')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Nationality <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="nationality" id="nationality">
                                            <option value="">Nationality</option>
                                            <option value="NG" @if( ($profile && $profile->nationality == 'NG') || old('nationality') == 'NG') {!! 'selected' !!}  @endif>Nigerian</option>
                                        </select>
                                        @error('nationality')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">State <span class="text-danger">*</span></label>
                                            <select class="form-control form-select" name="state" id="state_id">
                                                <option value="">State</option>
                                                @foreach ($states as $row)
                                                <option value="{{ $row->id }}" @if( ($profile && $profile->state == $row->id) || old('state') == $row->id) {!! 'selected' !!}  @endif >{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">LGA <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="lga" id="lga_id">
                                            <option value="">Lga</option>
                                            @if($profile && $profile->lga)
                                                @foreach ($lgas as $row)
                                                <option value="{{ $row->id }}" @if($profile && $profile->lga == $row->id ) {!! 'selected' !!}  @endif >{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('lga')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Town</label>
                                        <input type="text" class="form-control" name="town" id="town" placeholder="Town"
                                        value="{{ $profile ? $profile->town : old('town') }}" >
                                        @error('town')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number"
                                        value="{{ $profile ? $profile->phone_number : old('phone_number') }}" >
                                        @error('phone_number')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Date of birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $profile ? $profile->date_of_birth : old('date_of_birth') }}" >
                                        @error('date_of_birth')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Place Of Birth</label>
                                        <input type="text" class="form-control" name="place_of_birth" id="place_of_birth" placeholder="Place Of Birth"
                                        value="{{ $profile ? $profile->place_of_birth : old('place_of_birth') }}" >
                                        @error('place_of_birth')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-sm-12 my-2">
                                        <label for="">Involved in hypertension <span class="text-danger">*</span></label>
                                        <select class="form-control" name="involved_in_hypertension" id="involved_in_hypertension">
                                            <option value="">Select</option>
                                            <option value="Yes" @if( ($profile && $profile->involved_in_hypertension == 'Yes') || old('involved_in_hypertension') == 'Yes') {!! 'selected' !!}  @endif>Yes</option>
                                            <option value="No" @if( ($profile && $profile->involved_in_hypertension == 'No') || old('involved_in_hypertension') == 'No') {!! 'selected' !!}  @endif>No</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-sm-12 hypertension_description my-2" style="display: hidden;">
                                        <label for="">Please Describe</label>
                                        <textarea class="form-control" name="hypertension_description" id="hypertension_description" rows="3">{{ $profile ? $profile->hypertension_description : old('hypertension_description') }}</textarea>
                                        @error('hypertension_description')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row my-2 justify-content-end">
                                        <button class="btn btn-primary col-2 float-right">Save profile</button>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end -->
    </div>
    <!-- end col -->

</div>


@push('scripts')
<script src="../../assets/vendor/libs/bs-stepper/bs-stepper.js"></script>

<script>
    $(document).ready(function() {
        // Show or hide the hypertension description field based on the selection
        $('#involved_in_hypertension').change(function() {
            if ($(this).val() === 'Yes') {
                $('.hypertension_description').show();
            } else {
                $('.hypertension_description').hide();
            }
        });

        // Trigger change to set initial state
        $('#involved_in_hypertension').trigger('change');
    });
</script>
@endpush
@endsection
