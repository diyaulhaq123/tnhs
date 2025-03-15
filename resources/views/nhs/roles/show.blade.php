@extends('layouts.main')
@section('page_title')
Role
@endsection

@section('page_content')
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card p-3 mt-1">
                    <div class="card-header">
                        <h5>Role Details (<strong>{{ str_replace('_', ' ', ucfirst($role->name)) }}</strong>)</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $role->name }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
