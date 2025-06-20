@extends('layouts.main')
@section('page_title')
Qualifications
@endsection

@section('page_content')

    <a href="{{ route('qualification.create') }}" class="btn btn-primary btn-sm float-end my-2">Add qualification +</a>
<div class="row justify-content-center p-3 m-3">

    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qualifications as $index => $row)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>@if ($row->status == 0)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('qualification.edit', $row->id) }}" class="btn btn-primary btn-xs"><i class="ti ti-edit"></i></a>
                                        {{-- <form action="{{ route('qualification.destroy', $row->id) }}" method="post">
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
    </div>
</div>

@endsection
