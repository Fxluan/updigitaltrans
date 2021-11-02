@extends('user.layout.app')
@section('content')
    {{-- CONTENT --}}
    <div>
        <form method="post" action="{{ url($form['link']) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="type_mitra" name="type_mitra" value="{{ $form['type_mitra'] }}">
            @foreach ($form['form'] as $form_item)
                <div class="form-group">
                    <label for="{{ $form_item['label'] }}">{{ $form_item['label'] }}</label>
                    @if ($form_item['type'] == 'input')
                        <input type="{{ $form_item['value_type'] }}" class="form-control" id="{{ $form_item['id'] }}"
                            placeholder="" name="{{ $form_item['name'] }}" {{ $form_item['mandatory'] }}>
                    @endif
                </div>

            @endforeach
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>

    </div>

@endsection
