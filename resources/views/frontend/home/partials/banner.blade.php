<div class="hero-banner">
    <div class="slider slider-hero">
        @foreach ($banners as $banner)
        @php $link = ""; @endphp
        @if ($banner->url)
        @php $link = $banner->url; @endphp
        @elseif ($banner->published_content)
        @php $link = url("contents/$banner->content_id"); @endphp
        @endif
        <div>
            <div class="photo-thumb">
                <div class="photo-parent">
                    @if ($link)
                    <a href="{{ url("content/$banner->content_id") }}">
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