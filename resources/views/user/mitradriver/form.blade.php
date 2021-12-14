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
                            </div>
                        @endforeach
                        <button class="btn btn-primary">Daftar</button>
                    </form>
                @endif
                @if ($data['status_user'] == 0)
                    <form method="post" action="{{ url($data['form_validasi']['link']) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="type_mitra" name="type_mitra" value="{{$data['form_validasi']['type_mitra']}}">
                        <?php $i = 1; ?>
                        @foreach ($data['form_validasi']['form'] as $form_validasi)
                            <div class="form-group">
                                <label for="pernyataan">{{ $form_validasi['pertanyaan'] }}</label>
                                <div class="form-check">
                                    <?php $j = 1; ?>
                                    @foreach ($form_validasi['pilihan_ganda'] as $key => $pilihan_ganda)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="{{ $form_validasi['type'] }}"
                                                name="jawaban{{ $i }}" id="jawaban{{ $j }}"
                                                value="{{ $pilihan_ganda }}">
                                            <label class="form-check-label"
                                                for="jawaban{{ $i }}">{{ $pilihan_ganda }}</label>
                                        </div>
                                        <?php $j++; ?>
                                    @endforeach

                                </div>
                            </div>
                            <?php $i++; ?>
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
                @if ($data['status_user'] == 2)
                    <p>pengajuan anda menunggu validasi</p>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

    </script>
@endsection
