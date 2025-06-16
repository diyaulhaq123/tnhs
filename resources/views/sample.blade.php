@extends('layouts.main')
@section('page_title')
Page name
@endsection

@section('page_content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body form-steps">
                <div class="row gy-5">
                    {{-- *** Application Counter Starts ***** --}}
                    {{-- @include('layouts.application_counter') --}}
                    {{-- *** Application Counter Ends ***** --}}
                    <div class="col-lg-12">
                        <div class="px-lg-4">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="v-pills-bill-address" role="tabpanel" aria-labelledby="v-pills-bill-address-tab">

                                    <div class="row">
                                        <form class="vertical-navs-step" method="post" action="" enctype="multipart/form-data">
                                            @csrf
                                            <div class="">
                                                <div class="border-bottom-dashed border-success mb-3">
                                                    <h5>Upload Documents</h5>
                                                    <p class="text-muted">Please upload all listed documents to finish.</p>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="document_type" class="form-label">Document Type</label>
                                                            <select id="document_type" class="form-select" name="document_type">
                                                                <option selected>Select Document Type</option>
                                                                <option value="CAC Certificate">CAC Certificate </option>
                                                                <option value="Board Member CPN Evidence">Board Member CPN Evidence</option>
                                                                <option value="Memorandum and Article of Association">Memorandum and Article of Association</option>
                                                                {{-- <option value="3">Evidence of Affiliation with relevant Association (e.g NCS e.t.c)</option> --}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 mb-3">
                                                        <label for="document" class="form-label">Upload Document</label>
                                                        <input class="form-control" type="file" name="document" id="document">
                                                    </div>

                                                </div>

                                            </div>

                                            <hr class="my-4 text-muted">

                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <a href="" class="btn btn-light btn-label " ><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> BACK </a>
                                                <button type="submit" class="btn btn-success btn-label right ms-auto nexttab nexttab" ><i class="ri-upload-line label-icon align-middle fs-16 ms-2"></i>Upload</button>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="p-3 mt-3">

                                        <div class="card border card-border-light">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">List of Documents</h6>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped align-middle table-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">SN</th>
                                                            <th scope="col">Document Type</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($academicQualifications as $index => $row)
                                                        <tr>
                                                            <td scope="row">{{ $index+1 }}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <div class="hstack gap-3 flex-wrap">
                                                                    <a href="" target="_blank" class="btn btn-primary btn-sm fs-15"><i class="ri- ri-eye-line"></i></a>
                                                                    <form action="{{ route('academic-qualification.destroy', $row->id) }}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        {{-- <input type="hidden" name="application_id" value="{{ $application_id }}"> --}}
                                                                        <button type="button" class="btn btn-danger btn-sm delete fs-15"><i class="ri-delete-bin-line"></i></button>
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
                                            <div class="card-footer">
                                                <a href="" class="btn btn-info float-end" >Confirm Application <i class="ri-check-line"></i></a>
                                            </div>
                                        </div>

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
        <!-- end -->
    </div>
    <!-- end col -->
</div>

@endsection
