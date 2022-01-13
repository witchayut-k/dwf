<div class="box-tab">
    <div class="container">
        <ul class="nav nav-tabs nav-news" id="myTabNewsProvincial" role="tablist">
            @foreach ($linkDepartments as $key => $department)
            <li class="nav-item">
                <a class="nav-link nav-icon map active" id="tabNewsProvincialFirst" data-toggle="tab"
                    href="#tabNewsProvincial{{ $key }}" role="tab" aria-controls="tabNewsProvincial{{ $key }}"
                    aria-selected="true">{{ $department->title }}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabNewsProvincialContent">
            @foreach ($linkDepartments as $key => $department)
            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabNewProvincial{{ $key }}" role="tabpanel" aria-labelledby="tabNewsProvincial{{ $key }}">
                <div class="row">
                    @foreach ($department->weblinks as $weblink)
                    <div class="col-md-3">
                        <a href="{{ $weblink->url }}" class="box-item" target="_blank">
                            <div class="photo-thumb sm">
                                <div class="photo-parent">
                                    <span class="photo" style="background-image: url('{{ $weblink->featured_image_resized }}')"></span>
                                </div>
                            </div>
                            <div class="box-item-dt">
                                <h2 class="txt-wrap">{{ $weblink->title }}</h2>
                                <div class="d-flex">
                                    <p class="date pr-4">{{ $weblink->created_at }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>