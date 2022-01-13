<div class="modal modal-custom extra fade" id="modalLandingContent" tabindex="-1" role="dialog" aria-labelledby="modalLandingContentTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="owl-carousel owl-theme slider-landing">
                    @foreach ($landingPages as $page)
                    <div class="item">
                        <img src="{{ $page->featured_image }}" alt="{{ $page->title }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>