@extends('layouts.main')
@section('page_title')
Roles
@endsection

@section('page_content')

    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card p-3 mt-1">
                    <div class="card-header">
                        <h4>Roles</h4>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary float-end">Add New Role</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <a href="{{ route('roles.show', $row) }}" class="btn btn-info btn-xs"><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('roles.edit', $row) }}" class="btn btn-warning btn-xs"><i class="ti ti-edit"></i></a>
                                        @can('delete_role')
                                        <form action="{{ route('roles.destroy', $row) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs delete"><i class="ti ti-trash"></i></button>
                                        </form>
                                        @endcan
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
