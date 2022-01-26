<div class="box-tab bg-pinklight2 content-equal">
    <div class="container">
        <ul class="nav nav-tabs nav-news" id="myTabNewsVdo" role="tablist">

            @foreach ($videoCategories as $key => $category)
            <li class="nav-item">
                <a class="nav-link nav-icon megaphone {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#tabNewsVdo{{ $key }}"
                    role="tab" aria-controls="tabNewsVdo{{ $key }}" aria-selected="true">{{ $category->title }}</a>
            </li>
            @endforeach

            @foreach ($documentTypes as $key => $docType)
            <li class="nav-item">
                <a class="nav-link nav-icon doc" data-toggle="tab" href="#tabDownload{{ $key }}" role="tab"
                    aria-controls="tabDownload{{ $key }}" aria-selected="false">{{ $docType->type_name }}</a>
            </li>
            @endforeach

        </ul>
        <div class="tab-content" id="myTabNewsVdoContent">
            @foreach ($videoCategories as $key => $category)
            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabNewsVdo{{ $key }}" role="tabpanel" aria-labelledby="tabNewsVdo{{ $key }}">
                <div class="slider slider-videos">
                    @foreach ($category->featured_videos as $rows)
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                @php $firstContent = $rows->first(); @endphp
                                <div class="box-item">
                                    <div class="photo-thumb sm">
                                        <div class="photo-parent">
                                            @if ($firstContent->video_url)
                                            <iframe class="photo" src="{{ $firstContent->youtube_embed }}"
                                                title="{{ $firstContent->title }}" 
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen>
                                            </iframe>
                                            @else
                                            <video class="photo" controls>
                                                <source src="{{ $firstContent->video }}" type="video/mp4">
                                            </video>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="box-item-dt">
                                        <h2 class="txt-wrap2">{{ $firstContent->title }}</h2>
                                        <div class="d-flex">
                                            <p class="date pr-4">{{ $firstContent->date_th }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    @foreach ($rows->slice(1, 4) as $content)
                                    <div class="col-md-6">
                                        <div class="box-item">
                                            <div class="photo-thumb sm">
                                                <div class="photo-parent">
                                                    @if ($content->video_url)
                                                    <iframe class="photo" src="{{ $content->youtube_embed }}" 
                                                        title="{{ $content->title }}" 
                                                        frameborder="0" 
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                        allowfullscreen>
                                                    </iframe>
                                                    @else
                                                    <video class="photo" controls>
                                                        <source src="{{ $content->video }}" type="video/mp4">
                                                    </video>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="box-item-dt">
                                                <h2 class="txt-wrap">{{ $content->title }}</h2>
                                                <div class="d-flex">
                                                    <p class="date pr-4">{{ $content->date_th }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><!-- slide -->
                    @endforeach
                </div>
            </div>
            @endforeach

            @foreach ($documentTypes as $key => $docType)
            <div class="tab-pane fade" id="tabDownload{{ $key }}" role="tabpanel" aria-labelledby="tabDownload{{ $key }}">
                <div>
                    @foreach ($docType->files as $file)
                        {{-- @if ($file->hasFile) --}}
                        <a href="{{ url("downloads?id=$file->id") }}" target="_blank" class="check-item txt-wrap pl-5" target="_blank">{{ $file->title }}</a>
                        {{-- @endif --}}
                    @endforeach
                </div>

                <a href="{{ url('downloads') }}" class="btn btn-style btn-view extra transparent mt-3">คลิกดูทั้งหมด</a>
            </div>
            @endforeach
        </div>
    </div>
</div>