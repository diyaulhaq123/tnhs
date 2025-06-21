@extends('layouts.main')

@section('page_title')
Documents Upload
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
            <div class="card-body">
                <div class="row gy-5">
                    <div class="col-lg-12">
                        <div class="px-lg-4">
                            <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Document Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="file" class="form-label">Upload File</label>
                                        <input type="file" name="file" id="file" class="form-control" required>
                                    </div>

                                    <div class="col-md-2 d-flex align-items-end mb-3">
                                        <button type="" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div> <!-- end card -->
    </div>

    {{-- Document List --}}
    <div class="col-12 p-3 mt-3">
        <div class="card border card-border-light">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <div class="float-start">Uploaded Documents</div>
                    @if (auth()->user()->documents->count() >= 1)
                    <a href="{{ route('consent') }}" class="btn btn-primary float-end">Complete Personal Information Form <i class="fa fa-check ms-2"></i></a>
                    @endif
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Document Name</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $index => $doc)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $doc->name }}</td>
                            <td>
                                <a href="{{ asset('storage/documents/' . $doc->file) }}" target="_blank"><i class="text-info fa fa-eye"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('document.destroy', $doc->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" class="delete">
                                        <i class="text-danger fa fa-trash"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-danger text-center">No documents uploaded yet.</td>
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
