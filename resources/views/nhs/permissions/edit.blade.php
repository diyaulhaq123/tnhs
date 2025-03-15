@extends('layouts.main')
@section('page_title')
Edit Permission
@endsection

@section('page_content')
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card p-3 mt-1">
                    <div class="card-header">
                        <h5>Edit Permission</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permissions.update', $permission) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row align-items-end">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ $permission->name }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
