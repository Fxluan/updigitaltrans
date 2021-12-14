@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    Pertanyaan Verifikasi

@stop

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Pilihan Ganda</th>
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
                ajax: "{{ route('admin.verifiaksi') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'pernyataan',
                        name: 'pernyataan'
                    },
                    {
                        data: 'pilihan_ganda',
                        name: 'pilihan_ganda'
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
