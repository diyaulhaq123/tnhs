@extends('layouts.main')
@section('page_title')
Event Payment List
@endsection

@section('page_content')

<div class="card">
    <div class="table-responsive">
        @php
            $sn=0;
        @endphp
        <table class="table p-3" ixd="myTable">
            <tr>
                <th>SN</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Event Title</th>
                <th>Action</th>
            </tr>
            @forelse ($lists as $row)
            <tr>
                <td>{{ ++$sn }}</td>
                <td>{{ $row->user->email ?? 'NA' }}</td>
                <td><del>N</del>{{ number_format($row->amount, 2) ?? '0.00' }}</td>
                <td>{{ $row->remark ?? 'NA' }}</td>
                <td>{{ $row->event->title ?? 'NA' }}</td>
                <td>
                    <div class="btn-group">
                        <form action="" method="post">
                            @csrf @method('delete')
                            <div class="btn-group">
                                <a href="{{ route('receipt.view', $row->id) }}" target="_blank" class="btn btn-primary btn-xs"><i class="ti ti-eye"></i></a>
                                {{-- <button type="button" class="btn btn-info btn-xs"><i class="ti ti-printer"></i></button> --}}
                                {{-- <button type="submit" class="btn btn-danger btn-xs"><i class="ti ti-trash"></i></button> --}}
                            </div>
                        </form>
                    </div>
                </td>
                @empty
                <td colspan="6" class="text-center">No event Payment found</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>

@endsection
