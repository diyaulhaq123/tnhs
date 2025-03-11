@extends('layouts.main')
@section('page_title')
Assign Permissions
@endsection

@section('page_content')

<div class="card p-4">

    <div class="row p-2 mb-2">
        <p>Assign Roles to Users</p>
        <div class="col-lg-12">
            <form action="{{ route('assign.role') }}" method="post">
                @csrf
                <div class="row align-items-end">
                    <div class="col-lg-4">
                        <label for="">Role Name</label>
                        <select type="text" name="role_id" id="role_id" class="form-control form-select" >
                            <option value=""> Role </option>
                            @foreach ($roles as $row)
                            <option value="{{ $row->name }}"> {{ $row->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <label for="">User</label>
                        <select type="text" name="user_id" id="user_id" class="form-control form-select select2" >
                            <option value=""> Users </option>
                            @foreach ($users as $row)
                            <option value="{{ $row->id }}"> {{ $row->email }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary btn-sm"><i class="ti ti-check"></i></button>
                    </div>
                </div>
            </form>
        </div>

    </div>


    <hr>

    <div class="row">
        <div class="table-responsive">
            <form action="{{ route('assign.permission') }}" method="post">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Permission</th>
                            @foreach ($roles as $role)
                                <th class="text-center">{{ $role->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                @foreach ($roles as $role)
                                    <td class="text-center">
                                        <div class="form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="permissions[{{ $role->id }}][]"
                                                   value="{{ $permission->name }}"
                                                   {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary mt-2" type="submit">Save</button>
            </form>
        </div>
    </div>



</div>

@endsection
