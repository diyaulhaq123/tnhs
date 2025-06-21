@extends('layouts.main')
@section('page_title')
Member Form
@endsection

@section('page_content')

<div class="row">
    <div class="col-xl-12">
        <div class="card" id="member-form">
            <div class="card-header text-center">
                <img src="{{ asset('assets/img/nhs-logo.png').'?v='. time() }}"
                    alt="Logo"
                    class="img-fluid mb-2 mx-auto d-block rounded-circle"
                    style="max-width: 100px; height: auto;">

                <h5 class="mt-2">Nigeria Hypertension Society (Member Information Form)</h5>
            </div>

            <div class="card-body">
                {{-- ?v={{ time() }} --}}

                <div class="form">
                    <h5 class="text-primary  text-center">Personal Information</h5>
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
                <!-- end tab pane -->

                {{-- Contact Information --}}
                <div class="form my-5">
                    <h5 class="text-primary mb-4 text-center">Contact Information</h5>
                    @if (!empty($user->contactInformation))
                    <div class="container">
                        <div class="form-card bg-white">
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Place Of Work:</div>
                                <div class="col-md-8">{{ $user->contactInformation->place_of_work ?? '-' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Department:</div>
                                <div class="col-md-8">{{ $user->contactInformation->department ?? '-' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Position:</div>
                                <div class="col-md-8">{{ $user->contactInformation->position ?? '-' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Professional Field:</div>
                                <div class="col-md-8">{{ $user->contactInformation->professional_field ?? '-' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Official Address:</div>
                                <div class="col-md-8">{{ $user->contactInformation->official_address ?? '-' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Phone Number:</div>
                                <div class="col-md-8">{{ $user->contactInformation->phone_number ?? '-' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">WhatsApp Number:</div>
                                <div class="col-md-8">{{ $user->contactInformation->whatsapp_number ?? '-' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Official Email:</div>
                                <div class="col-md-8">{{ $user->contactInformation->official_address ?? '-' }}</div>
                            </div>

                        </div>
                    </div>
                    @endif
                </div>
                <!-- end tab content -->


                {{-- Academic Qualification --}}
                <div class="form my-5">
                    <h5 class="text-primary mb-4 text-center"> Academic Qualification</h5>
                    @if ($user->academicQualifications->isNotEmpty())
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Qualification</th>
                                        <th>Start Year</th>
                                        <th>Year Of Completion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->academicQualifications as $qualification)
                                    <tr>
                                        <td>{{ $qualification->qualification->name ?? '-' }}</td>
                                        <td>{{ $qualification->year_start ?? '-' }}</td>
                                        <td>{{ $qualification->year_end ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- end tab content -->

                {{-- Professional Affiliations --}}
                <div class="form my-5">
                    <h5 class="text-primary mb-4 text-center"> Professional Affiliations</h5>
                    @if ($user->professionalAffiliations->isNotEmpty())
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Affiliation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->professionalAffiliations as $row)
                                    <tr>
                                        <td>{{ $row->affiliation ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- end tab content -->


                {{-- Documents --}}
                <div class="form my-5">
                    <h5 class="text-primary mb-4 text-center"> Documents</h5>
                    @if ($user->documents->isNotEmpty())
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Document Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->documents as $row)
                                    <tr>
                                        <td>{{ $row->name ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- end tab content -->

            </div>
        </div>

    </div>
</div>



@push('css')
    <style>
        @media print {

            body * {
                visibility: hidden;
            }
            #member-form, #member-form * {
                visibility: visible;
            }
            #member-form {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
                background: white;
                color: black;
            }

            .form {page-break-after: always;}
        }
        #member-form {
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

    </style>
@endpush

@endsection






