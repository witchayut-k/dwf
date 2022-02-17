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
                                <li class="breadcrumb-item"><a href="news.php">{{ $form->title }}</a></li>
                            </ol>
                        </nav>
                        <h1 class="font-medium c-pink">{{ $form->title }}</h1>
                        <div class="d-flex flex-wrap mt-3">
                            <p class="date c-gray pr-4">{{ $form->created_at }}</p>
                            <p class="view c-gray pr-4">{{ $form->author ? $form->author->name : "-" }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="content-editor">
                            @if ($form->has_featured_image)
                            <img src="{{ $form->featured_image }}" alt="{{ $form->title }}">
                            @endif
                            {!! $form->description !!}
                        </div>

                        @if (session()->has('success'))
                        <h1>ลงทะเบียนเรียบร้อยแล้ว</h1>
                        @else

                            {{ Form::open(['url'=>url("registers")]) }}
                                {{ Form::hidden('registrar_id', $form->id) }}
                                @foreach ($form->fields as $field)
                                <div class="form-group my-4">
                                    <label>{{ $field['name'] }}</label>
                                    <input type="text" class="form-control extra" name="field_value_{{ $loop->iteration }}" />
                                </div>
                                @endforeach

                                <div class="row mt-5">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-light w-100">ยกเลิก</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-pink w-100">ลงทะเบียน</button>
                                    </div>
                                </div>

                            {{ Form::close() }}

                        @endif


                    </div>

                </div> <!-- card -->
            </div>
            <div class="col-lg-4 py-4">
                <div class="card card-custom">
                    <div class="card-body pt-0">
                        @if ($moreForms->count() > 0)
                        <div>
                            <h2 class="title-line c-pink mb-4">{{ การลงทะเบียนอื่นที่น่าสนใจ }}</h2>
                            @foreach ($moreForms as $item)
                                <a href="{{ url("registers/$item->id") }}" class="box-item list my-2">
                                    <div class="photo-thumb sm">
                                        <div class="photo-parent">
                                            <span class="photo" style="background-image: url({{ $item->featured_image_resized }})"></span>
                                        </div>
                                    </div>
                                    <div class="box-item-dt">
                                        <h3 class="font-medium txt-wrap">{{ $item->title }}</h3>
                                        <p class="date pt-1">{{ $item->date_th }}</p>
                                    </div>
                                </a>
                            @endforeach
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
@endsection