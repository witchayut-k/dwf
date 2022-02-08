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