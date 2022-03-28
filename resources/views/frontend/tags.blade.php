@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white tags">
    <div class="container">
        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tags</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">Tags</h1>
            </div>
            <div class="col-md-12">
                @foreach ($contents as $content)
                <div class="item">
                    <div class="item-image" style="background-image: url({{ $content->featured_image_resized }})">
                    </div>
                    <div class="item-body">
                        <h4><a href="{{ url("contents/$content->id") }}">{{ $content->title }}</a></h4>
                        <p class="pre-content">{!! $content->content !!}</p>
                        @if ($content->created_at)
                        <p class="timestamp">{{ $content->date_th }}</p>
                        @endif
                        <p class="tags">
                            @foreach ($content->tag_list as $tag)
                            <a href="{{ url("tags?q=$tag") }}" class="tag">{{ $tag }}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection