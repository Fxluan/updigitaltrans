@extends('user.layout.app')
@section('content')
    {{-- CONTENT --}}
    <div id="lisItem" class="col p-4">
        @foreach ($list_item as $key => $val_item)
            @if ($key % 2 == 0)
                <div class="row justify-content-start mb-5">
            @endif
            @if ($key % 2 != 0)
                <div class="row justify-content-end mb-5">
            @endif
            <div class="col-md-10">
                <div class="card">
                    <div class="col-md-12">
                        <div class="row">
                            @if ($key % 2 == 0)
                                <div class="col-md-7 pt-2 pb-2">
                                    <img id="img{{ $val_item['id'] }}" src="{{ asset($val_item['img']) }}" alt="">
                                </div>
                                <div class="col-md-5 pl-10 pt-2 pr-2 pb-2">
                                    <h5 class="text-left">{{ $val_item['title'] }}</h5>
                                    <h6 class="text-left">Deskripsi singkat</h6>
                                    <p class="text-justify">{{ $val_item['desc'] }}
                                    </p>
                                    <a href="{{ url($val_item['link']) }}" class="btn btn-danger pl-5 pr-5">Daftar</a>
                                </div>
                            @endif
                            @if ($key % 2 != 0)
                                <div class="col-md-5 pl-10 pt-2 pr-2 pb-2">
                                    <h5 class="text-left">{{ $val_item['title'] }}</h5>
                                    <h6 class="text-left">Deskripsi singkat</h6>
                                    <p class="text-justify">{{ $val_item['desc'] }}
                                    </p>
                                    <a href="{{ url($val_item['link']) }}" class="btn btn-danger pl-5 pr-5">Daftar</a>
                                </div>
                                <div class="col-md-7 pt-2 pb-2">
                                    <img id="img_{{ $val_item['id'] }}" src="{{ asset($val_item['img']) }}" alt="">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
    </div>

    <script>
        setupImageSize();

        function setupImageSize() {
            const e = document.getElementById('lisItem');
            const l = e.children.length;
            const x = screen.width;
            let w = x * 45 / 100;
            let h = w * 0.328;

            for (let i = 0; i < l; i++) {
                let imgID = null;
                if (i % 2 == 0) {
                    imgID = e.children[i].children[0].children[0].children[0].children[0].children[0].children[0].id;
                }
                if (i % 2 != 0) {
                    imgID = e.children[i].children[0].children[0].children[0].children[0].children[1].children[0].id
                }

                document.getElementById(imgID).height = h;
                document.getElementById(imgID).width = w;
            }
        }
    </script>

    </div>

@endsection
