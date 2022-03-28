<div class="box-event pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="title-line d-flex pt-4 mb-2" style="justify-content: space-between; align-items: center">
                    <h1 class="c-pink">{{ $activity->name }}</h1>
                    <a href="{{ url("categories/$activity->id") }}" class="btn-view">+ ดูทั้งหมด</a>
                </div>
                
                <div class="row row-event">
                    @foreach ($activity->published_contents->slice(0, 6) as $content)
                        <div class="col-4 col-event">
                            <a href="{{ url("contents/$content->id") }}" class="box-item">
                                <div class="photo-thumb">
                                    <div class="photo-parent">
                                        <span class="photo"
                                            style="background-image: url('{{ $content->featured_image_resized }}')"></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="calendar-box pt-5 pb-4">
                    <div class="title-group row align-items-center">
                        <div class="col-5 text-left">
                            <h1 class="txt-bold c-pink">ปฏิทินกิจกรรม</h1>
                        </div>
                        <div class="col-7 text-right d-flex justify-content-end align-items-center">
                            <a href="{{ url('events') }}" class="btn-view">+ ดูทั้งหมด</a>
                            <ul class="slick-arrow-list border-left pink pl-2 ml-4">
                                <li class="prev"></li>
                                <li class="next"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="slider slider-calendar pb-2">
                        @foreach ($events as $event)
                        <div>
                            <a href="{{ url("events/$event->id") }}" class="calendar-item d-flex align-items-center" title="{{ $event->title }}">
                                <div class="item-info item-left">
                                    <h1 class="date-txt c-pink">{{ $event->begin_date->format('j') }}</h1>
                                    <p class="pt-1">{{ $event->begin_date->translatedFormat('M') }}</p>
                                </div>
                                <div class="item-info">
                                    <h2 class="txt-wrap">{{ $event->title }}</h2>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>