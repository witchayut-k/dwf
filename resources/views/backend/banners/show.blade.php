@extends('frontend.layouts.preview')

@section('content')

<div class="banner-image">
    <img src="{{ $banner->featured_image }}" alt="{{ $banner->title }}" style="width: 990px; height: 248px;" />
</div>

@endsection