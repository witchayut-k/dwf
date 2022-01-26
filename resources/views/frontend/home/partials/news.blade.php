<div class="box-tab bg-news content-equal">
    <div class="container">
        <ul class="nav nav-tabs nav-news" id="myTabNews" role="tablist">
            @foreach ($featuredContents as $key => $contentType)
            <li class="nav-item">
                <a class="nav-link nav-icon {{ $key == 0 ? "active" : "" }} " data-toggle="tab" href="#tabNews{{ $key }}"
                    role="tab" aria-controls="tabNews{{ $key }}" aria-selected="true">{{ $contentType->name }}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabNewsContent">
            @foreach ($featuredContents as $key => $contentType)
            @php
                $contents = $contentType->published_contents->sortByDesc('pinned');

                if ($contentType->name == "ข่าวภูมิภาค") {
                    $chunks = $contents->chunk(8);
                    $contentType->featured_contents = $chunks->slice(0, 3);
                } else {
                    $chunks = $contents->chunk(5);
                    $contentType->featured_contents = $chunks->slice(0, 3);
                }

            @endphp
            <div class="tab-pane fade {{ $key == 0 ? " show active" : "" }}" id="tabNews{{ $key }}" role="tabpanel" aria-labelledby="tabNews{{ $key }}">
                <div class="slider slider-news">
                    @foreach ($contentType->featured_contents as $rows)
                    @if ($contentType->name == "ข่าวภูมิภาค")
                    <div>
                        <div class="row">
                            @foreach ($rows as $content)
                            <div class="col-md-3">
                                <a href="{{ url("contents/$content->id") }}" class="box-item">
                                    <div class="photo-thumb sm">
                                        <div class="photo-parent">
                                            <span class="photo" style="background-image: url('{{ $content->featured_image }}')"></span>
                                        </div>
                                    </div>
                                    <div class="box-item-dt">
                                        <h2 class="txt-wrap">{{ $content->title }}</h2>
                                        <div class="d-flex">
                                            <p class="date pr-4">{{ $content->date_th }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                @php $firstContent = $rows->first(); @endphp
                                <a href="{{ url("contents/$firstContent->id") }}" class="box-item">
                                    <div class="photo-thumb sm">
                                        <div class="photo-parent">
                                            <span class="photo"
                                                style="background-image: url('{{ $firstContent->featured_image }}')"></span>
                                        </div>
                                    </div>
                                    <div class="box-item-dt">
                                        <h2 class="txt-wrap2">{{ $firstContent->title }}</h2>
                                        <div class="d-flex">
                                            <p class="date pr-4">{{ $firstContent->date_th }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    @foreach ($rows->slice(1, 4) as $content)
                                    <div class="col-md-6">
                                        <a href="{{ url("contents/$content->id") }}" class="box-item">
                                            <div class="photo-thumb sm">
                                                <div class="photo-parent">
                                                    <span class="photo"
                                                        style="background-image: url('{{ $content->featured_image_resized }}')"></span>
                                                </div>
                                            </div>
                                            <div class="box-item-dt">
                                                <h2 class="txt-wrap">{{ $content->title }}</h2>
                                                <div class="d-flex">
                                                    <p class="date pr-4">{{ $content->date_th }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>