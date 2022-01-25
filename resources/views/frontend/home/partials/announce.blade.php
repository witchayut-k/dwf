<div class="box-tab box-list pb-5">
    <div class="container">
        <ul class="nav nav-tabs nav-news" id="myTabNewsList" role="tablist">
            @foreach ($announces as $key => $announce)
            <li class="nav-item">
                <a class="nav-link nav-icon doc {{ $key == 0 ? 'active' : '' }}" 
                    data-toggle="tab" href="#tabNewsList{{ $key }}" role="tab" aria-controls="tabNewsList{{ $key }}"
                    aria-selected="true">{{ $announce->name }}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabNewsListContent">
            @foreach ($announces as $key => $announce)
            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabNewsList{{ $key }}" role="tabpanel" aria-labelledby="tabNewsList{{ $key }}">
                @foreach ($announce->published_contents as $content)
                <a href="{{ url("contents/$content->id") }}" class="check-item txt-wrap pl-5">{{ $content->date_th }} : {{ $content->title }}</a>
                @endforeach
                <a href="{{ url("categories/$announce->id") }}" class="btn btn-style btn-view extra mt-3">คลิกดูทั้งหมด</a>
            </div>
            @endforeach
            {{-- <div class="tab-pane fade show active" id="tabNewsList1" role="tabpanel"
                aria-labelledby="tabNewsList1">
                <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the
                    printing and typesetting industry. Lorem Ipsum has been the industry's </a>
                <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the
                    printing and typesetting industry. Lorem Ipsum has been the industry's </a>
                <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the
                    printing and typesetting industry. Lorem Ipsum has been the industry's </a>
                <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the
                    printing and typesetting industry. Lorem Ipsum has been the industry's </a>
                <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the
                    printing and typesetting industry. Lorem Ipsum has been the industry's </a>

                <a href="{{ url('rss') }}" class="btn btn-style btn-view extra mt-3">คลิกดูทั้งหมด</a>
            </div>
            <div class="tab-pane fade" id="tabNewsList2" role="tabpanel" aria-labelledby="tabNewsList2">

            </div>
            <div class="tab-pane fade" id="tabNewsList3" role="tabpanel" aria-labelledby="tabNewsList3">

            </div>
            <div class="tab-pane fade" id="tabNewsList4" role="tabpanel" aria-labelledby="tabNewsList4">

            </div>
            <div class="tab-pane fade" id="tabNewsList5" role="tabpanel" aria-labelledby="tabNewsList5">

            </div> --}}
        </div>
    </div>
</div>