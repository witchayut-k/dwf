@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white">
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item">คลังวีดีโอ</li>
            </ol>
        </nav>

        <div class="box-tab pt-4">
            <ul class="nav nav-tabs nav-news">
                @foreach ($categories as $key => $category)
                <li class="nav-item">
                    <a class="nav-link nav-icon doc {{ $request->category == $category->id ? 'active' : '' }}" href="{{ url("videos?category=$category->id") }}">{{ $category->title }}</a>
                </li>
                @endforeach
              
            </ul>
            <div class="tab-content" id="myTabNewsVdoContent" style="padding: 25px">
                {{-- @foreach ($categories as $key => $category) --}}
                    <div class="row">
                        @foreach ($videos as $key => $video)
                        <div class="col-md-3">
                            <div class="box-item">
                                <div class="photo-thumb sm">
                                    <div class="photo-parent">
                                        @if ($video->video_url)
                                            {{-- <iframe class="photo" src="{{ $video->youtube_embed }}"
                                                    title="{{ $video->title }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe> --}}
                                            <div class="yt-preview photo js-modal-btn"  data-video-id="{{ $video->youtube_id }}" style="background-image: url('{{ $video->video_preview_image }}');">
                                                <img src="{{ asset('images/yt-icon.png') }}" />
                                            </div>
                                        @else
                                            <video class="photo" controls>
                                                <source src="{{ $video->video }}" type="video/mp4">
                                            </video>
                                        @endif
                                    </div>

                                </div>
                                <div class="box-item-dt">
                                    <h2 class="txt-wrap">{{ $video->title }}</h2>
                                    <div class="d-flex">
                                        <p class="date pr-4">{{ $video->date_th }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                {{-- @endforeach --}}
            </div>

            {{ $videos->links() }}
            
        </div>
    </div>
</div>
@endsection