@extends('layouts.main')
@section('page_title')
Page name
@endsection

@section('page_content')

<div class="row">
    <div class="col-xl-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Member Information</h4>
            </div><!-- end card header -->
            <div class="card-body form-steps">
                <div class="vertical-navs-step">
                    <div class="row gy-5">
                        <div class="col-lg-12">
                            <div class="px-lg-4">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="v-pills-bill-info" role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
                                        <div>
                                            <h5 class="text-primary mb-4 text-center">Personal Information</h5>
                                        </div>
                                        {{-- ?v={{ time() }} --}}
                                        <div class="form">
                                            @if (!empty($user->profile))
                                            <div class="container">
                                                <div class="form-card bg-white">
                                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <div class=""></div>
                                                    <img src="{{ $user->profile->avatar ?? asset('assets/avatar/dummy.jpeg') }}" alt="Company Logo"  width="100" class="rounded-circle">
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Membership Category:</div>
                                                        <div class="col-md-8">{{ $user->profile->membershipCategory->name .' - '. '('. $user->profile->membershipCategory->description .')' ?? '-' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Title:</div>
                                                        <div class="col-md-8">{{ $user->profile->title ?? '-'  }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">First Name:</div>
                                                        <div class="col-md-8">{{ $user->profile->first_name ?? '-'  }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Last Name:</div>
                                                        <div class="col-md-8">{{ $user->profile->last_name ?? '-'  }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Other Name:</div>
                                                        <div class="col-md-8">{{ $user->profile->other_name ?? '-'  }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Phone Number:</div>
                                                        <div class="col-md-8">{{ $user->profile->phone_number ?? '-'  }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Gender:</div>
                                                        <div class="col-md-8">{{ $user->profile->gender ?? '-' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Marital Status:</div>
                                                        <div class="col-md-8">{{ $user->profile->marital_status ?? 'NA' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Nationality:</div>
                                                        <div class="col-md-8">{{ $user->profile->nationality ?? 'NA' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">State:</div>
                                                        <div class="col-md-8">{{ $user->profile->states->name ?? '' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Local Goverment Area:</div>
                                                        <div class="col-md-8">{{ $user->profile->lgas->name ?? '' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Town:</div>
                                                        <div class="col-md-8">{{ $user->profile->town ?? 'NA' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Date Of Birth:</div>
                                                        <div class="col-md-8">{{ $user->profile->date_of_birth ?? '-' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Place Of Birth:</div>
                                                        <div class="col-md-8">{{ $user->profile->place_of_birth ?? '-' }}</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Involved In Hypertension:</div>
                                                        <div class="col-md-8">{{ $user->profile->involved_in_hypertension ?? '-' }}</div>
                                                    </div>

                                                     <div class="row mb-2">
                                                        <div class="col-md-4 fw-bold">Description:</div>
                                                        <div class="col-md-8">{{ $user->profile->hypertension_description ?? '-' }}</div>
                                                    </div>

                                                </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                        </div>
                        <!-- end col -->

                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>

    </div>
    <!-- end col -->
</div>

@endsection






