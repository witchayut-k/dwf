@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner">
    <div class="container">
        <div class="row content-row">
            <div class="col-lg-8 py-4">
                <div class="card card-custom">
                    <div class="card-header pt-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-custom">
                                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">แบบสำรวจ</li>
                            </ol>
                        </nav>
                        <h1 class="font-medium c-pink">{{ $survey->title }}</h1>
                        <div class="d-flex flex-wrap mt-3">
                            <p class="date c-gray pr-4">{{ $survey->date_th }}</p>
                            <p class="view c-gray pr-4">{{ $survey->view_count }} view</p>
                            <p class="view c-gray pr-4">{{ $survey->author->name }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="content-editor">
                            <p
                                style="font-size: 18px; line-height: 32px; color: #444444; padding-top: 10px; padding-bottom: 10px;">
                                {!! $survey->description !!}
                            </p>
                        </div> <!-- editor -->
                        {{ Form::open(['url'=>url("surveys")]) }}
                            {{ Form::hidden('survey_id', $survey->id) }}

                        <div class="vote-group">
                            @if (session()->has('success'))
                                <h1>โหวตเรียบร้อยแล้ว</h1>
                            @else
                                @foreach ($survey->questions as $questionKey => $question)
                                    <strong style="margin-top: 30px; display: block;">{{ $question->question }}</strong>
                                    @foreach ($survey->choices as $key => $choice)
                                    <div class="vote-item my-4" onclick="selectVote()">
                                        <label class="check-radio">{{ $choice['name'] }}
                                            <input type="radio" name="question_{{ $questionKey + 1 }}" value="{{ $key+1 }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                        <div class="row mt-5">
                            <div class="col-6">
                                <button type="button" class="btn btn-light w-100" data-toggle="modal" data-target="#modalVoteResult">ดูผลโหวต</button>
                            </div>
                            @if (!session()->has('success'))
                            <div class="col-6">
                                <button type="submit" class="btn btn-pink w-100">โหวต</button>
                            </div>
                            @endif
                        </div>
                        {{ Form::close() }}

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center align-items-center pt-3">
                            <h2 class="share-topic font-bold pt-3 pr-4">SHARE</h2>
                            @include('frontend.partials.social_share')
                        </div>
                    </div>
                </div> <!-- card -->
            </div>
            <div class="col-lg-4 py-4">
                <div class="card card-custom">
                    <div class="card-body pt-0">
                        @if ($moreSurveys->count() > 0)
                        <div>
                            <h2 class="title-line c-pink mb-4">แบบสำรวจอื่นๆ</h2>
                            <ul class="content-list">
                                @foreach ($moreSurveys as $item)
                                <li>
                                    <a href="{{ url("surveys/$item->id") }}">
                                        <h3 class="font-medium txt-wrap2">{{ $item->title }}</h3>
                                        <p class="date c-pink pt-2">{{ $item->date_th }}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="pt-4">
                            <h2 class="title-line text-uppercase c-pink mb-2">Share</h2>
                            @include('frontend.partials.social_share')
                        </div>
                    </div>
                </div> <!-- card -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Vote Result -->
<div class="modal modal-custom modal-vote fade" id="modalVoteResult" tabindex="-1" role="dialog"
    aria-labelledby="modalVoteResultTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title c-pink pb-2">ผลโหวต</h5>
                @foreach ($survey->questions as $questionKey => $question)
                    <strong style="margin-top: 30px; display: block;">{{ $question->question }}</strong>
                    @foreach ($survey->choices as $key => $choice)
                    <div class="progress-item">
                        <h6>{{ $choice['name'] }}</h6>
                        <div class="d-flex align-items-center">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ SurveyHelper::GetPercentAnswer($survey->id, $questionKey, $key + 1) }}%" aria-valuenow="{{ SurveyHelper::GetPercentAnswer($survey->id, $questionKey, $key + 1) }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-num">{{ SurveyHelper::GetPercentAnswer($survey->id, $questionKey, $key + 1) }}% [{{ SurveyHelper::GetQtyAnswer($survey->id, $questionKey, $key + 1) }}]</span>
                        </div>
                    </div> <!-- progress -->
                    @endforeach
                @endforeach
                <p class="text-center">ผู้โหวตทั้งหมด: {{ $surveyResult['votes'] }}</p>
                <button type="button" class="btn btn-pink w-100 mt-4" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // function selectVote() {
    //     $('.vote-group .vote-item').click(function () {
    //         $('.vote-item').removeClass("active");
    //         $(this).addClass("active");
    //     });
    // }
</script>
@endsection