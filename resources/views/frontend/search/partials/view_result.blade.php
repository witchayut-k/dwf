<div class="item">
    <h4><a href="{{ url("contents/$item->id") }}">{!! $item->title !!}</a></h4>
    <p>{!! $item->content !!}</p>
    @if ($item->created_at)
    <p class="timestamp">{{ $item->created_at->translatedFormat('j F Y - H:i น.') }}</p>
    @endif
</div>