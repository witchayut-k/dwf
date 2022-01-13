<div class="box-last">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="box-tab box-institution py-0">
                    <ul class="nav nav-tabs nav-border" role="tablist">
                        @foreach ($linkRelated as $key => $related)
                        <li class="nav-item">
                            <a class="nav-link  {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#tab_related_{{ $key }}" role="tab"
                                aria-controls="home" aria-selected="true">{{ $related->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($linkRelated as $key => $related)
                        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tab_related_{{ $key }}" role="tabpanel" style="min-height: 200px">
                            <div class="slider slider-institution">
                                @foreach ($related->weblinks as $weblink)
                                <div>
                                    <a href="{{ $weblink->url }}" class="slider-item" target="_blank">
                                        <img src="{{ $weblink->featured_image_resized }}" alt="{{ $weblink->title }}">
                                        <p class="text-center">{{ $weblink->title }}</p>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-xl-6">
                        <h1 class="title-line c-pink">{{ $linkGov->title }}</h1>
                        <ul class="list-dashed my-4">
                            @foreach ($linkGov->weblinks as $weblink)
                            <li><a href="{{ $weblink->url }}" target="_blank">{{ $weblink->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-7 col-xl-6 stat-list">
                        <h1 class="title-line c-pink">สถิติผู้เข้าชมเว็บไซต์</h1>
                        <div class="row my-4">
                            <div class="col-7 stat-ic pr-1"><span class="ic-view"></span>สถิติผู้เข้าชมวันนี้</div>
                            <div class="col-5 text-right c-pink">{{ VisitorHelper::TodayVisitor() }} ครั้ง</div>
                        </div>
                        <div class="row my-4">
                            <div class="col-7 stat-ic pr-1">สถิติผู้เข้าชมเมื่อวานนี้</div>
                            <div class="col-5 text-right c-pink">{{ VisitorHelper::YesterdayVisitor() }} ครั้ง</div>
                        </div>
                        <div class="row my-4">
                            <div class="col-7 stat-ic pr-1">สถิติผู้เข้าชมเดือนนี้</div>
                            <div class="col-5 text-right c-pink">{{ VisitorHelper::MonthVisitor() }} ครั้ง</div>
                        </div>
                        <div class="row my-4">
                            <div class="col-7 stat-ic pr-1">สถิติผู้เข้าชมปีนี้</div>
                            <div class="col-5 text-right c-pink">{{ VisitorHelper::YearVisitor() }} ครั้ง</div>
                        </div>
                        <div class="row my-4">
                            <div class="col-7 stat-ic pr-1">สถิติผู้เข้าชมทั้งหมด</div>
                            <div class="col-5 text-right c-pink">{{ VisitorHelper::TotalVisitor() }} ครั้ง</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-5 col-xl-4 box-info bg-gray border-rd-10 info-disbursement">
                <div class="info-head">
                    <h1>ผลการเบิกจ่ายภาพรวม สค. ปีงบประมาณ {{ $budget->budget_year }}</h1>
                </div>
                <div class="info-body">
                    <div class="info-item">
                        <div class="row justify-content-between py-3">
                            <div class="col-md-auto">งบประมาณรวมทั้งหมด</div>
                            <div class="col-md-auto c-pink">{{ number_format($budget->budget_total, 2) }} บาท</div>
                        </div>
                        <div class="row justify-content-between py-3">
                            <div class="col-md-auto">เบิกจ่ายทั้งหมด</div>
                            <div class="col-md-auto c-pink">{{ number_format($budget->disburse_total, 2) }} บาท ({{ number_format($budget->disburse_total_percent, 2) }}%)</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="row justify-content-between py-3">
                            <div class="col-md-auto">งบดำเนินงาน</div>
                            <div class="col-md-auto c-pink">{{ number_format($budget->budget_operate, 2) }} บาท</div>
                        </div>
                        <div class="row justify-content-between py-3">
                            <div class="col-md-auto">เบิกจ่าย</div>
                            <div class="col-md-auto c-pink">{{ number_format($budget->disburse_operate, 2) }} บาท ({{ number_format($budget->disburse_operate_percent, 2) }}%)</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="row justify-content-between py-3">
                            <div class="col-md-auto">งบลงทุน</div>
                            <div class="col-md-auto c-pink">{{ number_format($budget->budget_invest, 2) }} บาท</div>
                        </div>
                        <div class="row justify-content-between py-3">
                            <div class="col-md-auto">เบิกจ่าย</div>
                            <div class="col-md-auto c-pink">{{ number_format($budget->disburse_invest, 2) }} บาท ({{ number_format($budget->disburse_invest_percent, 2) }}%)</div>
                        </div>
                    </div>
                </div>
                <p class="text-center">(ข้อมูล ณ วันที่ {{ $budget->date_th }})</p>
            </div> --}}
        </div>
    </div>
</div>