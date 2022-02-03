@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner">
    <div class="container">
        <div class="row content-row">
            <div class="col-lg-8 py-4">
                <div class="card card-custom">
                    <div class="card-header pt-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-custom">
                                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url("categories/{$content->type->id}") }}">{{ $content->type->name }}</a></li>
                            </ol>
                        </nav>
                        <h1 class="font-medium c-pink">{{ $content->title }}</h1>
                        <div class="d-flex flex-wrap mt-3">
                            <p class="date c-gray pr-4">{{ $content->created_at }}</p>
                            <p class="view c-gray pr-4">{{ $content->view_count }} view</p>
                            <p class="view c-gray pr-4">{{ $content->author->name }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="content-editor">
                            @if ($content->has_featured_image)
                            <img src="{{ $content->featured_image }}" alt="{{ $content->title }}">
                            @endif

                            @if (\Str::endsWith($content->file, ".pdf"))
                                <iframe src="{{ $content->file }}" frameborder="0" width="100%" height="950"></iframe>
                            @endif

                            {!! $content->content !!}

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center align-items-center pt-3">
                            <h2 class="share-topic font-bold pt-3 pr-4">SHARE</h2>
                            @include('frontend.partials.social_share')
                        </div>
                    </div>
                </div> <!-- card -->
            </div>
            <div class="col-lg-4 py-4">
                <div class="card card-custom">
                    <div class="card-body py-5">
                        @if ($moreContents->count() > 0)
                        <div>
                            <h2 class="title-line c-pink mb-2">{{ $content->type->name }} อื่นๆ</h2>
                            <ul class="content-list">
                                @foreach ($moreContents as $mContent)
                                <li>
                                    <a href="{{ url("contents/$mContent->id") }}">
                                        <h3 class="font-medium txt-wrap2">{{ $mContent->title }}</h3>
                                        <p class="date c-pink pt-2">{{ $mContent->date_th }}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="py-5">
                            <h2 class="title-line text-uppercase c-pink mb-2">Tag</h2>
                            <div class="d-flex flex-wrap pt-3">
                                @foreach ($tags as $tag)
                                <a href="{{ url("categories/$tag->id") }}" class="tag">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="py-5">
                            <h2 class="title-line text-uppercase c-pink mb-2">Share</h2>
                            @include('frontend.partials.social_share')
                        </div>
                    </div>
                </div> <!-- card -->
            </div>
        </div>
    </div>
</div>
@endsection