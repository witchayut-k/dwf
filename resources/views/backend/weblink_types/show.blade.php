@extends('backend.layouts.preview')

@section('content')

<div class="weblink-type-image">
    <img src="{{ url($weblinkType->example_image) }}" alt="{{ $weblinkType->title }}" style="width: 726px;" />
</div>

@endsection