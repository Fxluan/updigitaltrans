@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    Registrasi Driver

@stop

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemohon</th>
                <th>Tipe Kendaraan</th>
                <th>NoPol Kendaraan</th>
                <th>No SIM</th>
                <th>No KTP</th>
                <th>Status</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@stop

@section('css')

@stop

@section('js')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.driver') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'vehicle_type',
                        name: 'vehicle_type'
                    },
                    {
                        data: 'vehicle_number',
                        name: 'vehicle_number'
                    },
                    {
                        data: 'sim_number',
                        name: 'sim_number'
                    },
                    {
                        data: 'ktp_number',
                        name: 'ktp_number'
                    },
                    {
                        data: 'status_validasi',
                        name: 'status_validasi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@stop
