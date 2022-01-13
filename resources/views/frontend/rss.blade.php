@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white">
    <div class="container">
        <div class="box-tab pt-4">
            <ul class="nav nav-tabs nav-news" id="myTabNewsList" role="tablist">
                <li class="nav-item">
                    <a class="nav-link nav-icon doc active" id="tabNewsListFirst" data-toggle="tab" href="#tabNewsList1" role="tab" aria-controls="tabNewsList1" aria-selected="true">แผนการจัดซื้อจัดจ้าง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon bath" id="tabNewsListSecond" data-toggle="tab" href="#tabNewsList2" role="tab" aria-controls="tabNewsList2" aria-selected="false">ราคากลาง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon doc" id="tabNewsListThrid" data-toggle="tab" href="#tabNewsList3" role="tab" aria-controls="tabNewsList3" aria-selected="false">ประชาพิจารณ์/ร่างประกาศ/เอกสาร/ประกวดราคา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon trophy" id="tabNewsListFourth" data-toggle="tab" href="#tabNewsList4" role="tab" aria-controls="tabNewsList4" aria-selected="false">ประกาศประกวดราคา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon trophy" id="tabNewsListFifth" data-toggle="tab" href="#tabNewsList5" role="tab" aria-controls="tabNewsList5" aria-selected="false">ประกาศผลการเสนอราคา</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabNewsListContent">
                <div class="tab-pane fade show active" id="tabNewsList1" role="tabpanel" aria-labelledby="tabNewsList1">
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                    <a href="#" class="check-item txt-wrap pl-5">15 ต.ค. 2564 : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</a>
                </div>
                <div class="tab-pane fade" id="tabNewsList2" role="tabpanel" aria-labelledby="tabNewsList2">

                </div>
                <div class="tab-pane fade" id="tabNewsList3" role="tabpanel" aria-labelledby="tabNewsList3">

                </div>
                <div class="tab-pane fade" id="tabNewsList4" role="tabpanel" aria-labelledby="tabNewsList4">

                </div>
                <div class="tab-pane fade" id="tabNewsList5" role="tabpanel" aria-labelledby="tabNewsList5">

                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination pt-4 pb-4">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="First">
                            <span aria-hidden="true" class="first"></span>
                            <span class="sr-only">First</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true" class="previous"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    <li class="page-item"><a class="page-link" href="#">9</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true" class="next"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Last">
                            <span aria-hidden="true" class="last"></span>
                            <span class="sr-only">Last</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection