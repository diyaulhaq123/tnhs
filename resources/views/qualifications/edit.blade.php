@extends('layouts.main')
@section('page_title')
Edit Qualification
@endsection

@section('page_content')

<div class="row justify-content-center p-3 m-3">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('qualification.update', $qualification->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="form-group my-3">
                            <label for="">Name/Title</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $qualification->name }}">
                            @error('name')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Active Status</option>
                                <option value="0" {{  $qualification->status == 0 ? 'selected' : '' }} >Active</option>
                                <option value="1" {{  $qualification->status == 1 ? 'selected' : '' }} >Deactivate</option>
                            </select>
                            @error('status')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('qualification.index') }}" class="btn btn-danger"><i class="ti ti-arrow-back"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
