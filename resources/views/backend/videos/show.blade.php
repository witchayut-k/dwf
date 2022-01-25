@extends('frontend.layouts.preview')

@section('content')
<div class="box-tab bg-pinklight2 content-equal">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="box-item">
                    <div class="photo-thumb sm">
                        <div class="photo-parent">
                            @if ($video->video_url)
                            <iframe class="photo" src="{{ $video->youtube_embed }}" title="{{ $video->title }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                            @else
                            <video class="photo" controls>
                                <source src="{{ $video->video }}" type="video/mp4">
                            </video>
                            @endif
                        </div>
                    </div>
                    <div class="box-item-dt">
                        <h2 class="txt-wrap2">{{ $video->title }}</h2>
                        <div class="d-flex">
                            <p class="date pr-4">{{ $video->date_th }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>

@endsection