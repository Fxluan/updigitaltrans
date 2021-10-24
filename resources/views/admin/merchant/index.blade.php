@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    Registrasi Merchant

@stop

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gerai</th>
                <th>Deskripsi</th>
                <th>Waktu Buka</th>
                <th>Waktu Tutup</th>
                <th>Alamat</th>
                <th>Tipe Merchant</th>
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
                ajax: "{{ route('admin.merchant') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'merchant_name',
                        name: 'merchant_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'open_time',
                        name: 'open_time'
                    },
                    {
                        data: 'close_time',
                        name: 'close_time'
                    },
                    {
                        data: 'address_menchant',
                        name: 'address_menchant'
                    },
                    {
                        data: 'role',
                        name: 'role'
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
