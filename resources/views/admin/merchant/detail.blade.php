@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    Detail Merchant
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                {{-- profile --}}
                <div class="card">
                    <h5 class="card-header">User Info</h5>
                    <div class="card-body">
                        {{-- <div class="text-center">
                            <img src="{{ Storage::url($foto_user) }}" class="rounded-circle" alt="" width="200"
                                height="200">
                        </div> --}}
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>{{ $nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td>{{ $no_telepon }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>{{ $tgl_lahir }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                {{-- Data Merchant --}}
                <div class="card">
                    <h5 class="card-header">Merchant Info {!! $status !!}</h5>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nama Gerai</td>
                                    <td>{{ $merchant_name }}</td>
                                </tr>
                                <tr>
                                    <td>Tipe Gerai</td>
                                    <td>{{ $role }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>{{ $description }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Buka</td>
                                    <td>{{ $open_time }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Tutup</td>
                                    <td>{{ $close_time }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Gerai</td>
                                    <td>{{ $address_menchant }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><img src="{{ Storage::url($galery_merchant) }}" class="img-thumbnail" alt=""
                                            width="400"></td>
                                </tr>
                                <tr>
                                    <td>Keterangan verifikasi</td>
                                    <td>{{ $desc_verifikasi }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <button class="btn btn-primary btn-flat btn-sm"
                            onclick="verifikasiConfirmation({{ $id }})"> Verifikasi</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')

@stop

@section('js')
    <script type="text/javascript">
        async function verifikasiConfirmation(id) {
            let deskripsi = '';
            let status = '';
            status = await swal({
                title: 'Pilih status baru',
                input: 'select',
                inputOptions: {
                    1: 'aktifasi akun',
                    2: 'tolak pengajuan',
                    4: 'bekukan akun'
                },
                inputPlaceholder: 'Select a status',
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value !== '') {
                            resolve()
                        } else {
                            resolve('opsi harus dipilih')
                        }
                    })
                }
            })

            if (status.value == 2 || status.value == 4) {
                deskripsi = await swal({
                    title: 'keterangan',
                    input: 'textarea',
                    inputPlaceholder: 'Type your message here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                })
            }
            console.log('deskripsi ', status.value, deskripsi.value)

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/verifikasimerchant') }}",
                data: {
                    _token: CSRF_TOKEN,
                    status: status.value,
                    id,
                    deskripsi: deskripsi.value != undefined ? deskripsi.value : ' '
                },
                dataType: 'json',
                success: function(results) {
                    if (results.success === 1) {
                        swal("Done!", results.message, "success").then(() => {
                            location.reload(true);
                        });
                    } else {
                        swal("Error!", results.message, "error").then(() => {
                            location.reload(true);
                        });
                    }
                },
            });

        }
    </script>
@stop
