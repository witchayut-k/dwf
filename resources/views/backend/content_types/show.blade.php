@extends('backend.layouts.preview')

@section('content')

<div class="content-type-image">
    <img src="{{ url($contentType->example_image) }}" alt="{{ $contentType->title }}" style="width: 726px;" />
</div>

@endsection