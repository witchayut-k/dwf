<div class="box-tab bg-news content-equal">
    <div class="container">
        <ul class="nav nav-tabs nav-news" id="myTabNews" role="tablist">
            <li class="nav-item">
                <a class="nav-link nav-icon megaphone active" id="tabNewsFirst" data-toggle="tab" href="#tabNews1"
                    role="tab" aria-controls="tabNews1" aria-selected="true">{{ $news->name }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon doc" id="tabNewsSecond" data-toggle="tab" href="#tabNews2" role="tab"
                    aria-controls="tabNews2" aria-selected="false">ประกาศจัดซื้อจัดจ้าง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon doc" id="tabNewsThrid" data-toggle="tab" href="#tabNews3" role="tab"
                    aria-controls="tabNews3" aria-selected="false">ประกาศราคากลาง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon trophy" id="tabNewsFourth" data-toggle="tab" href="#tabNews4" role="tab"
                    aria-controls="tabNews4" aria-selected="false">ประกาศสรุปผลจัดซื้อจัดจ้าง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon suitcase" id="tabNewsFifth" data-toggle="tab" href="#tabNews5" role="tab"
                    aria-controls="tabNews5" aria-selected="false">ประกาศรับสมัครงาน</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabNewsContent">
            <div class="tab-pane fade show active" id="tabNews1" role="tabpanel" aria-labelledby="tabNews1">
                <div class="slider slider-news">
                    @foreach ($news->featured_contents as $rows)
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
                    </div> <!-- slide -->
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="tabNews2" role="tabpanel" aria-labelledby="tabNews2">

            </div>
            <div class="tab-pane fade" id="tabNews3" role="tabpanel" aria-labelledby="tabNews3">

            </div>
            <div class="tab-pane fade" id="tabNews4" role="tabpanel" aria-labelledby="tabNews4">

            </div>
            <div class="tab-pane fade" id="tabNews5" role="tabpanel" aria-labelledby="tabNews5">

            </div>
        </div>
    </div>
</div>