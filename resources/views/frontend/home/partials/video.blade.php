<div class="box-tab bg-pinklight2 content-equal">
    <div class="container">
        <ul class="nav nav-tabs nav-news" id="myTabNewsVdo" role="tablist">

            <li class="nav-item">
                <a class="nav-link nav-icon megaphone active" data-toggle="tab" href="#tabNewsVdo"
                    role="tab" aria-controls="tabNewsVdo" aria-selected="true">สื่อที่น่าสนใจ</a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-icon doc" data-toggle="tab" href="#tabDownload" role="tab"
                    aria-controls="tabDownload" aria-selected="false">เอกสารสื่อสิ่งพิมพ์</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabNewsVdoContent">
            <div class="tab-pane fade show active" id="tabNewsVdo" role="tabpanel" aria-labelledby="tabNewsVdo">
                <div class="slider slider-videos">
                    @foreach ($videos as $rows)
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

            <div class="tab-pane fade" id="tabDownload" role="tabpanel" aria-labelledby="tabDownload">
                <div>
                    @foreach ($documents as $file) 
                        <a href="{{ url("downloads?id=$file->id") }}" target="_blank" class="check-item txt-wrap pl-5" target="_blank">{{ $file->title }}</a>
                    @endforeach
                </div>

                <a href="{{ url('downloads') }}" class="btn btn-style btn-view extra transparent mt-3">คลิกดูทั้งหมด</a>
            </div>
        </div>
    </div>
</div>