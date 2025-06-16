@extends('layouts.main')

@section('page_title')
    Professional Affiliations
@endsection

@push('css')
<link rel="stylesheet" href="../../assets/vendor/libs/bs-stepper/bs-stepper.css" />
<style>
    .remove-btn {
        cursor: pointer;
        color: red;
        font-size: 16px;
        margin-left: 10px;
    }

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
            <div class="card-body">
                <div class="row gy-5">
                    <div class="col-lg-12">
                        <div class="px-lg-4">
                            <form action="{{ route('professional-affiliation.store') }}" method="POST" id="affiliationForm">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                <div id="affiliation-wrapper">
                                    <div class="row mb-3 affiliation-item">
                                        <div class="col-md-10">
                                            <label for="affiliation[]" class="form-label">Professional Affiliation</label>
                                            <input type="text" name="affiliation[]" class="form-control" placeholder="e.g., NMA, ESC, ISH" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-success add-affiliation">+</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-end mt-2">Save Affiliations</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Display Table --}}
    <div class="col-12 p-3 mt-3">
        <div class="card border card-border-light">
            <div class="card-header">
                <h6 class="card-title mb-0">List of Affiliations</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Affiliation</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($affiliations as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->affiliation }}</td>
                            <td>
                                <form action="{{ route('professional-affiliation.destroy', $row->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" class=" delete" data-id="{{ $row->id }}">
                                        <i class="text-danger fa fa-trash"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-danger text-center">No professional affiliations added yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.getElementById('affiliation-wrapper');

        wrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-affiliation')) {
                const clone = e.target.closest('.affiliation-item').cloneNode(true);
                clone.querySelector('input').value = '';
                clone.querySelector('.add-affiliation').outerHTML = '<button type="button" class="btn btn-danger remove-affiliation">-</button>';
                wrapper.appendChild(clone);
            }

            if (e.target.classList.contains('remove-affiliation')) {
                e.target.closest('.affiliation-item').remove();
            }
        });
    });
</script>
@endpush

@endsection
