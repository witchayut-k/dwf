<div class="tab-menu">
    <ul class="nav nav-tabs" role="tablist">
        @foreach ($linkServices as $key => $service)
        <li class="nav-item">
            <a class="nav-link nav-icon service-ic {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#tab{{ $key }}" role="tab"
                aria-controls="tab{{ $key }}" aria-selected="true">
                <div class="nav-content">
                    <h1>{{ $service->title }}</h1>
                </div>
            </a>
        </li>
        @endforeach
        <li class="nav-item">
            <a class="nav-link nav-icon service-ic"  href="{{ url('contacts') }}">
                <div class="nav-content">
                    <h1>ติดต่อเรา</h1>
                </div>
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        @foreach ($linkServices as $key => $service)
        <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="tab{{ $key }}" role="tabpanel" aria-labelledby="tab{{ $key }}">
            <div class="container">
                <div class="slider slider-menu-tab mt-4">
                    @foreach ($service->weblinks as $weblink)
                        <a href="{{ $weblink->url }}" target="_blank" class="box-menu col-6 col-lg-4" style="margin-bottom: 15px;">
                            <img src="{{ $weblink->featured_image_resized }}" alt="" class="img-fluid">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>