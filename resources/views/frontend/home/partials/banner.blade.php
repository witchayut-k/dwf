<div class="hero-banner">
    <div class="slider slider-hero">
        @foreach ($banners as $banner)
        {{-- @if ($banner->published_content)
            @php $link = url("contents/$banner->content_id"); @endphp
        @elseif ($banner->url)
            @php $link = $banner->url; @endphp
        @endif --}}
        @php $link = $banner->url; @endphp
        <div>
            <div class="photo-thumb">
                <div class="photo-parent">
                    @if ($link)
                    <a href="{{ $link }}" target="_blank">
                        <span class="photo" style="background-image: url('{{ $banner->featured_image }}')"></span>
                    </a>
                    @else
                        <span class="photo" style="background-image: url('{{ $banner->featured_image }}')"></span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>