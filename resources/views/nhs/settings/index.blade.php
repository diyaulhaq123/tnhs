@extends('layouts.main')
@section('page_title')
Portal Settings
@endsection

@section('page_content')

<div class="p-3 m-4">
    <div class="row">
        <div class="col-3">
            <div class="card p-2">
                <div class="row justify-content-center">
                    <img src="{{ $settings->logo ? $settings->logo : asset('assets/img/nhs-logo.png') }}" alt="Logo" width="100">
                </div>
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                        </div>
                    </div>
                    <div class="col-12  mb-2">
                        <button type="submit" class="btn btn-primary">Upload <i class="ti ti-file-upload"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card p-5">
                <form action="{{ route('settings.update', $settings->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="">Name/Title</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $settings->name }}">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $settings->phone_number }}">
                        </div>

                        <div class="col-6 mb-2">
                            <label for="">Description</label>
                            <textarea cols="30" rows="5" class="form-control" name="description" id="description" >{{ $settings->description }}</textarea>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="">Address</label>
                            <textarea cols="30" rows="5" class="form-control" name="address" id="address" >{{ $settings->address }}</textarea>
                        </div>

                        <div class="col-6 mb-2 ">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
