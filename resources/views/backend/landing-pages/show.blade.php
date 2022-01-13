@extends('backend.layouts.preview')

@section('content')

<div class="landingPage-image">
    <img src="{{ $landingPage->featured_image }}" alt="{{ $landingPage->title }}" style="width: 960px;" />
</div>

@endsection