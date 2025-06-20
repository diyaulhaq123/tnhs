@extends('layouts.main')

@section('page_title')
Members List
@endsection

@section('page_content')

    <div class="card p-3">
        <div class="table-responsive">
            <table class="table" id="members-table"></table>
        </div>
    </div>


@push('css')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css">

@endpush



@push('scripts')
    {{-- <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script> --}}
    {{-- <script>
        let table = new DataTable('#myTable');
    </script> --}}

    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script>
         // Parse the PHP JSON string into JavaScript object
        const users = JSON.parse(@json($users));

            new gridjs.Grid({
                columns: [
                    // Add a hidden 'ID' column as the first column.
                    // This column's data will be the user.id, making it accessible via row.cells[0].data
                    { id: 'id', name: 'ID', hidden: true },
                    "Email",
                    "Name",
                    "Membership Category",
                    {
                        name: "Completed Profile",
                        formatter: (cell, row) => {
                            // Now, row.cells[0].data will correctly contain the user's ID.
                            // We access it directly without '.id' because it is the data itself.
                            const userId = row.cells[0].data;
                            if (cell === 1) {
                                return gridjs.html(`<i class='text-success fa fa-check'></i>
                                    <a href='/${userId}/user' class='badge bg-success text-white ms-2'>
                                        Profile
                                    </a>`);
                            } else {
                                return gridjs.html(`<i class='text-danger fa fa-ban'></i>`);
                            }
                        }
                    },
                    "Action"
                ],
                data: users.map(user => [
                    // Make sure user.id is the first element in the data array for each row,
                    // corresponding to the new hidden 'ID' column.
                    user.id,
                    user.email ?? "N/A",
                    user.name ?? "N/A",
                    user.profile && user.profile.membership_category ? user.profile.membership_category.name : "N/A",
                    user.completed_profile,
                    // This action link already correctly uses user.id
                    gridjs.html(`<a href='/show/user/${user.id}' target='_blank' class=''><i class='text-info fa fa-eye'></i></a>`)
                ]),
                pagination: {
                    enabled: true,
                    limit: 10
                },
                search: true,
                sort: true,
                className: {
                    table: 'table table-bordered'
                }
            }).render(document.getElementById("members-table"));

    </script>
@endpush
@endsection
