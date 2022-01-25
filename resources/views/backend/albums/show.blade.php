@extends('frontend.layouts.preview')

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
                                <li class="breadcrumb-item active" aria-current="page">คลังภาพกิจกรรม</li>
                            </ol>
                        </nav>
                        <h1 class="font-medium c-pink">{{ $album->title }}</h1>
                        <div class="d-flex flex-wrap mt-3">
                            <p class="date c-gray pr-4">{{ $album->date_th }}</p>
                            <p class="view c-gray pr-4">{{ $album->view_count }} view</p>
                            <p class="view c-gray pr-4">{{ $album->author->name }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="content-editor">
                           @if ($album->has_featured_image)
                           <img src="{{ $album->featured_image }}" alt="{{ $album->title }}">
                           @endif
                           @if ($album->description)
                           <p style="font-size: 18px; line-height: 32px; color: #444444; padding-top: 10px; padding-bottom: 10px;">
                               {!! $album->description !!}
                           </p>
                           @endif
                       </div> <!-- editor -->
                       <div class="border-top py-4 mt-3">
                           <h2 class="c-pink mb-3">รูปภาพในอัลบั้ม <span class="album-text">({{ $album->gallery_images->count() }} ภาพ)</span></h2>
                           <div class="row row-album">
                               @foreach ($album->gallery_images as $item)
                               <div class="col-6 col-md-3 py-3 px-3">
                                    <a href="{{ $item->getFullUrl() }}" data-fancybox="gallery">
                                        <div class="photo-thumb">
                                            <div class="photo-parent">
                                                <span class="photo" style="background-image: url('{{ $item->getFullUrl() }}')"></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                               @endforeach
                           </div>
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