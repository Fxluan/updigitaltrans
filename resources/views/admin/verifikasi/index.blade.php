@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    Pertanyaan Verifikasi

@stop

@section('content')
    <button class="btn btn-success" data-toggle="modal" data-target="#createModalCenter">
        create
    </button>
    <hr>
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

    <!-- Modal Create-->
    <div class="modal fade" id="createModalCenter" tabindex="-1" role="dialog" aria-labelledby="createModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLongTitle">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/admin/storepertanyaan') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="pertanyaan">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" aria-describedby=""
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="type_mitra">Tipe Mitra</label>
                            <select class="form-control" id="type_mitra" name="type_mitra">
                                <option value="driver">Driver</option>
                                <option value="merchant">Merchant</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pilihanganda">Pilihan Ganda</label>
                            <small id="" class="form-text text-muted">pilihan ganda A</small>
                            <input type="text" class="form-control" id="pilihanganda1" name="pilihanganda1"
                                placeholder="">
                            <small id="" class="form-text text-muted">pilihan ganda B</small>
                            <input type="text" class="form-control" id="pilihanganda2" name="pilihanganda2"
                                placeholder="">
                            <small id="" class="form-text text-muted">pilihan ganda C</small>
                            <input type="text" class="form-control" id="pilihanganda3" name="pilihanganda3"
                                placeholder="">
                            <small id="" class="form-text text-muted">pilihan ganda D</small>
                            <input type="text" class="form-control" id="pilihanganda4" name="pilihanganda4"
                                placeholder="">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
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
                        data: 'pertanyaan',
                        name: 'pertanyaan'
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
