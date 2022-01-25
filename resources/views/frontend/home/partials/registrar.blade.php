@if (count($registerForms) > 0)
<div class="box-tab py-0">
    <div class="container">
        <ul class="nav nav-tabs nav-news" id="myTabNewsRegis" role="tablist">
            <li class="nav-item">
                <a class="nav-link nav-icon regis active" id="tabNewsRegisFirst" data-toggle="tab" href="#tabNewsRegis1"
                    role="tab" aria-controls="tabNewsRegis1" aria-selected="true">ระบบลงทะเบียน</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabNewsRegisContent">
            <div class="tab-pane fade show active" id="tabNewRegis1" role="tabpanel" aria-labelledby="tabNewsRegis1">
                <div class="row">
                    @foreach ($registerForms as $form)
                    <div class="col-md-3">
                        <a href="{{ url("registers/$form->id") }}" class="box-item">
                            <div class="photo-thumb sm">
                                <div class="photo-parent">
                                    <span class="photo" style="background-image: url('{{ $form->featured_image_resized }}')"></span>
                                </div>
                            </div>
                            <div class="box-item-dt">
                                <h2 class="txt-wrap">{{ $form->title }}</h2>
                                <div class="d-flex">
                                    <p class="date pr-4">{{ $form->created_at->translatedFormat('d M Y') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                {{-- <p class="text-center c-gray py-4">ขณะนี้ยังไม่มีการเปิดรับลงทะเบียน</p> --}}
            </div>
        </div>
    </div>
</div>
@endif
