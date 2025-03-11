@extends('layouts.main')
@section('page_title')
Roles & Permissions
@endsection

@section('page_content')

<div class="card p-4">

    <div class="row p-2 mb-2">
        <div class="col-lg-6">
            <form action="{{ route('create.role') }}" method="post">
                @csrf
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <label for="">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Role Name">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <form action="{{ route('create.permission') }}" method="post">
                @csrf
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <label for="">Permission Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Permission Name">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <h6> Roles </h6>
        </div>

        <div class="col-6">
            <h6> Permissions </h6>
        </div>
    </div>
    <div class="row">
        @php
            $sn = 0;
        @endphp

        <div class="col-6">
            <div class="row">
                @foreach ($roles as $row)
                <p class="col-lg-6 col-md-6 col-sm-6 text-uppercase"><span class="badge bg-info m-1"> {{$row->name}} </span></p>
                @endforeach
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                @foreach ($permissions as $row)
                <p class="col-lg-4 col-md-4 col-sm-6"><span class="badge bg-info m-1"> {{$row->name}} </span></p>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
