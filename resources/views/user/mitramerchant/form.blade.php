@extends('user.layout.app')
@section('content')
    {{-- CONTENT --}}

    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">
                PENDAFTARAN MITRA DRIVER
            </div>
            <div class="card-body">
                @if ($data['status_user'] == 'not_exist')
                    <form method="post" action="{{ url($data['form_regist']['link']) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="type_mitra" name="type_mitra"
                            value="{{ $data['form_regist']['type_mitra'] }}">
                        @foreach ($data['form_regist']['form'] as $form_item)
                            <div class="form-group">
                                <label for="{{ $form_item['label'] }}">{{ $form_item['label'] }}</label>
                                @if ($form_item['type'] == 'input')
                                    <input type="{{ $form_item['value_type'] }}" class="form-control"
                                        id="{{ $form_item['id'] }}" placeholder="" name="{{ $form_item['name'] }}"
                                        {{ $form_item['mandatory'] }}>
                                @endif
                                @if ($form_item['type'] == 'textarea')
                                    <textarea type="{{ $form_item['value_type'] }}" class="form-control"
                                        id="{{ $form_item['id'] }}" placeholder="" name="{{ $form_item['name'] }}"
                                        {{ $form_item['mandatory'] }}></textarea>
                                @endif
                            </div>
                        @endforeach
                        <button class="btn btn-primary">Daftar</button>
                    </form>
                @endif
                @if ($data['status_user'] == 0)
                    <form method="post" action="{{ url($data['form_validasi']['link']) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="type_mitra" name="type_mitra"
                            value="{{ $data['form_validasi']['type_mitra'] }}">
                        @foreach ($data['form_validasi']['form'] as $form_validasi)
                            <div class="form-group">
                                <input type="hidden" id="pertanyaan_id" name="pertanyaan_id"
                                    value="{{ $form_validasi['id'] }}">
                                <label for="pertanyaan">{{ $form_validasi['pertanyaan'] }}</label>
                                <div class="form-check">
                                    @foreach ($form_validasi['pilihan_ganda'] as $key => $pilihan_ganda)
                                        @if ($pilihan_ganda != null)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="{{ $form_validasi['type'] }}"
                                                    name="jawaban_{{ $form_validasi['id'] }}"
                                                    id="jawaban_{{ $form_validasi['id'] }}"
                                                    value="{{ $pilihan_ganda }}">
                                                <label class="form-check-label"
                                                    for="jawaban_{{ $form_validasi['id'] }}">{{ $pilihan_ganda }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <button class="btn btn-primary">Submit</button>
                    </form>
                @endif
                @if ($data['status_user'] == 1)
                    <p>anda sudah terdaftar sebagai mitra</p>
                @endif
                @if ($data['status_user'] == 2)
                    <p>pengajuan anda ditolak</p>
                @endif
                @if ($data['status_user'] == 4)
                    <p>akun anda dibekukan</p>
                @endif
                @if ($data['status_user'] == 5)
                    <p>pengajuan anda menunggu verifikasi.</p>
                @endif

            </div>
        </div>
    </div>

    </div>

@endsection
