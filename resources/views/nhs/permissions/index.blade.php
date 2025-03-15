@extends('layouts.main')

@push("css")
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
@endpush

@section('page_content')
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card p-3 mt-1 overflow-hidden" style="100vh; ">
                    <div class="card-header">
                        <h4>Permission</h4>
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary float-end"><i class="ti ti-plus"></i>Add New Permission</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table mt-3 display" id="myTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <a href="{{ route('permissions.show', $row) }}" class="btn btn-info btn-xs"><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('permissions.edit', $row) }}" class="btn btn-warning btn-xs"><i class="ti ti-edit"></i></a>
                                        {{-- @can('delete_permission') --}}
                                        <form action="{{ route('permissions.destroy', $row) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs delete"><i class="ti ti-trash"></i></button>
                                        </form>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
