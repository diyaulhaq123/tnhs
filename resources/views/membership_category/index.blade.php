@extends('layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />
@endpush

@section('page_title')
Member Category
@endsection

@section('page_content')

    <div class="row">
        <div class="mb-2">
            <a href="{{ route('membership-category.create') }}" class="btn btn-primary btn-sm col-2 float-end">Add Member Category<i class="ti ti-plus"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="card p-2">
            <div class="table-responsive">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($membership_categories as $index => $row)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->description }}</td>
                            <td>@if ($row->status == 0)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('membership-category.edit', $row->id) }}" class="btn btn-primary btn-xs"><i class="ti ti-edit"></i></a>
                                    {{-- <form action="{{ route('membership-category.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button class="btn btn-danger btn-xs delete"><i class="ti ti-trash"></i></button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@push('scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush
@endsection
