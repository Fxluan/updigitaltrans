@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    Pengajuan Mitra

@stop

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemohon</th>
                <th>Mitra</th>
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
                ajax: "{{ route('admin.pengajuan') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'mitra',
                        name: 'mitra'
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
