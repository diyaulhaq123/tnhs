@extends('layouts.main')
@section('page_title')
Permission
@endsection

@section('page_content')
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card p-3 mt-1">
                    <div class="card-header">
                        <h5>Permission Details (<strong>{{ str_replace('_', ' ', ucfirst($permission->name)) }}</strong>)</h5>
                    </div>
                    <div class="card-body">
                        <p>{{$permission->name }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back to List</a>
                        <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
