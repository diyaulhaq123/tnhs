@extends('layouts.main')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />

@endpush
@section('page_title')
User/Member List
@endsection

@section('page_content')

    <div class="card p-3">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Email</th>
                        <th>Membership Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lists as $index => $row)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->memberType->name }}</td>
                        <td>{!! $row->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">In-active</span>'  !!}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('delete.members') }}" method="post">
                                    @csrf @method('delete')
                                    <input type="hidden" name="id" id="id" value="{{ $row->id }}">
                                    {{-- <div class="btn-group"> --}}
                                        <a href="{{ route('user.show', $row->id) }}" type="button" class="btn btn-primary btn-xs"><i class="ti ti-eye"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs delete"><i class="ti ti-trash"></i></button>
                                    {{-- </div> --}}
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush
@endsection
