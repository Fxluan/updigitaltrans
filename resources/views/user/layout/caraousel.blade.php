        {{-- CAROUSEL --}}
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <?php
            $img_carousel = ['no_img.jpeg', 'no_img.jpeg', 'no_img.jpeg'];
            ?>
            <div class="carousel-inner">
                @foreach ($img_carousel as $key => $val_img_carousel)
                    @if ($key == 0)
                        <div class="carousel-item active">
                    @endif
                    @if ($key != 0)
                        <div class="carousel-item">
                    @endif
                    <img id="carousel-img-{{ $key }}" class="carousel-img"
                        src="{{ asset('img/no_img.jpeg') }}" alt="{{ $key }}">
            </div>
            @endforeach
            <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
