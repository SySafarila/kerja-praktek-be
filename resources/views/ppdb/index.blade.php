@extends('layouts.adminlte', [
    'title' => 'PPDB'
])

@section('head')
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <style>
        td:nth-child(5), td:nth-child(10) {
            text-wrap: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <x-adminlte.session-notifications />
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0">PPDB</h1>
                    @can('ppdb-create')
                        {{-- <a href="{{ route('admin.ppdb.create') }}" class="btn btn-sm btn-primary ml-2">Add New</a> --}}
                    @endcan
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">PPDB</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content pb-3">
        <div class="container-fluid">
            <div class="card m-0">
                <div class="card-body table-responsive">
                    <form action="{{ route('admin.ppdb.index') }}" method="GET" class="align-items-center d-flex justify-content-center justify-content-md-start mb-2" style="gap: 7px;">
                        @csrf
                        <select name="payment" id="payment" class="custom-select custom-select-sm form-control form-control-sm" style="width: fit-content;">
                            <option value="all">Pembayaran: Semua</option>
                            <option value="pending" @if(request()->payment == 'pending') selected @endif>Pembayaran: Pending</option>
                            <option value="settlement" @if(request()->payment == 'settlement') selected @endif>Pembayaran: Lunas</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </form>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="cursor: pointer" id="selector">
                                    <input type="checkbox" class="w-100" style="cursor: pointer">
                                    <span style="display: none;">Selector</span>
                                </th>
                                <th style="text-wrap: nowrap;">NISN</th>
                                <th style="text-wrap: nowrap;">Full Name</th>
                                <th style="text-wrap: nowrap;">Gender</th>
                                <th style="text-wrap: nowrap;">Birth</th>
                                <th style="text-wrap: nowrap;">Religion</th>
                                <th style="text-wrap: nowrap;">Address</th>
                                <th style="text-wrap: nowrap;">Whatsapp</th>
                                <th style="text-wrap: nowrap;">Payment</th>
                                <th style="text-wrap: nowrap;">Registered At</th>
                                <th class="d-print-none">Options</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{-- <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="{{ asset('js/datatables/select-deselect-all.js') }}"></script>
    <script src="{{ asset('js/datatables/delete-button-init.js') }}"></script>
    <script src="{{ asset('js/datatables/bulk-delete.js') }}"></script>
    <script>
        $(document).ready(function() {
            const exportOption = [1, 2];
            const buttons = [{
                extend: 'copy',
                className: 'btn btn-sm rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'csv',
                className: 'btn btn-sm rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'excel',
                className: 'btn btn-sm rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'pdf',
                className: 'btn btn-sm rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'print',
                className: 'btn btn-sm rounded-0 btn-secondary',
                exportOptions: {
                    columns: exportOption
                }
            }, {
                extend: 'colvis',
                className: 'btn btn-sm rounded-0 btn-secondary'
            }, {
                text: 'Bulk Delete',
                className: 'btn btn-sm rounded-0 btn-danger',
                action: function() {
                    startBulkDelete('{{ csrf_token() }}', '{{ route('admin.ppdb.massDestroy') }}')
                }
            }, ];

            const datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                search: {
                    return: true,
                },
                language: {
                    processing: 'Loading...'
                },
                ajax: '{!! route('admin.ppdb.index', [
                    'payment' => request()->payment
                ]) !!}',
                lengthMenu: [
                    [10, 50, 100, 500, 1000, -1],
                    [10, 50, 100, 500, 1000, 'All']
                ],
                columns: [{
                    defaultContent: ''
                }, {
                    data: 'nisn',
                    name: 'nisn'
                }, {
                    data: 'full_name',
                    name: 'full_name'
                }, {
                    data: 'gender',
                    name: 'gender'
                }, {
                    data: 'birth',
                    name: 'birth_date'
                }, {
                    data: 'religion',
                    name: 'religion'
                }, {
                    data: 'address',
                    name: 'address'
                }, {
                    data: 'whatsapp',
                    name: 'whatsapp'
                }, {
                    data: 'payment',
                    name: 'user.transaction.transaction_status'
                }, {
                    data: 'created_at',
                    name: 'created_at'
                }, {
                    data: 'options',
                    name: 'options'
                }],
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: buttons,
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    targets: [6, 7, 8, 10]
                }],
                order: [
                    // [1, 'asc']
                ]
            });

            datatable.on('draw', () => {
                deleteButtonInit('{{ csrf_token() }}');
            });
        });
    </script>
@endsection
