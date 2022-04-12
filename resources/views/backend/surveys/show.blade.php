@extends('frontend.layouts.preview')

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
                            <p class="person c-gray pr-4">{{ $survey->author->name }}</p>
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

        </div>
    </div>
</div>

@endsection
