<div class="menu-content">
    <div class="container">
        <div class="slider slider-menu">
            @foreach ($linkSocials as $key => $social)
                @foreach ($social->weblinks as $weblink)
                    <div class="menu-item">
                        <a href="{{ $weblink->url }}" target="_blank">
                            <img src="{{ $weblink->featured_image_resized }}" alt="{{ $weblink->title }}">
                            <div>
                                <h1>{{ $weblink->title }}</h1>
                                <p>{{ $weblink->subtitle }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
        <ul style="display: none">
            @foreach ($linkSocials as $key => $social)
                @foreach ($social->weblinks as $weblink)
                <li>
                    <a href="{{ $weblink->url }}" target="_blank">
                        <img src="{{ $weblink->featured_image_resized }}" alt="{{ $weblink->title }}">
                        <div>
                            <h1>{{ $weblink->title }}</h1>
                            <p>{{ $weblink->subtitle }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>