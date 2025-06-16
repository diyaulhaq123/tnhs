@extends('layouts.main')
@section('page_title')
Academic Qualification
@endsection

@push('css')
<link rel="stylesheet" href="../../assets/vendor/libs/bs-stepper/bs-stepper.css" />
@endpush
@section('page_content')

{{-- *** Profile menu Starts ***** --}}
@include('layouts.profile_menu')
{{-- *** Profile menu Ends ***** --}}
<div class="row">
    <div class="col-12 p-3">
        <div class="card">
            <div class="card-body ">
                <div class="row gy-5">
                    <div class="col-lg-12">
                        <div class="px-lg-4">
                                <div class="" id="v-pills-bill-address" >
                                        <form action="{{ isset($academicQualification) ? route('academic-qualification.update', $academicQualification->id) : route('academic-qualification.store') }}" method="POST">
                                            @csrf
                                            @if(isset($academicQualification))
                                                @method('PUT')
                                            @endif
                                                <input type="hidden" name="user_id" class="form-control" value="{{ auth()->user()->id ?? $academicQualification->user_id ?? '' }}" required>
                                            <div class="row">

                                                <div class="col-md-3 col-lg-4 mb-3">
                                                    <label for="qualification" class="form-label">Qualification</label>
                                                    <select name="qualification_id" id="qualification_id" class="form-control" required>
                                                        <option value="">Select Qualification</option>
                                                        @foreach($qualifications as $id => $name)
                                                            <option value="{{ $id }}" {{ (old('qualification_id', $academicQualification->qualification_id ?? '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 col-lg-4 mb-3">
                                                    <label for="year_start" class="form-label">Start Date</label>
                                                    <input type="number" name="year_start" id="year_start" class="form-control" value="{{ old('year_start', $academicQualification->year_start ?? '') }}">
                                                </div>

                                                <div class="col-md-3 col-lg-4  mb-3">
                                                    <label for="year_end" class="form-label">End Date</label>
                                                    <input type="number" name="year_end" id="year_end" class="form-control" value="{{ old('year_end', $academicQualification->year_end ?? '') }}">
                                                </div>

                                                <div class="col-md-3 col-lg-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ isset($academicQualification) ? 'Update' : 'Save' }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
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

    <div class="col-12 p-3 mt-3">
        <div class="card border card-border-light">
            <div class="card-header">
                <h6 class="card-title mb-0">List of Documents</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Qualification</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($academicQualifications as $index => $row)
                        <tr>
                            <td scope="row">{{ $index+1 }}</td>
                            <td>{{ $row->qualification->name ?? '-' }}</td>
                            <td>{{ $row->year_start ?? '-' }}</td>
                            <td>{{ $row->year_end ?? '-' }}</td>
                            <td>
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="javascript:void(0);" class="text-primary fs-15 edit-qualification" data-id="{{ $row->id }}"> <i class="fa fa-edit"></i></a>
                                    <form action="{{ route('academic-qualification.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        {{-- <input type="hidden" name="application_id" value="{{ $application_id }}"> --}}
                                        <span class="text-danger delete fs-15"><i class="fa fa-trash"></i></span>
                                    </form>
                                </div>
                            </td>
                            @empty
                            <td colspan="5" class="text-center text-danger">No academic qualifications uploaded yet</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@push('scripts')
<script src="../../assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
@endpush
@endsection
