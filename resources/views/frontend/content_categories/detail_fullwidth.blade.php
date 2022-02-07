@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner">
    <div class="container">
        <div class="row content-row">
            <div class="col-lg-12 py-4">
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

                            <hr>

                            @if ($content->file)
                            <h4>ดาวน์โหลดไฟล์แนบ</h4>
                            <a href="{{ url("$content->file") }}" target="_blank">{{ $content->file }}</a>
                            @endif

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
        </div>
    </div>
</div>
@endsection