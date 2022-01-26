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
                                <li class="breadcrumb-item active" aria-current="page">PROFILE MANAGEMENT</li>
                            </ol>
                        </nav>
                        <h1 class="font-medium c-pink">{{ $profile->title }}</h1>
                        <div class="d-flex flex-wrap mt-3">
                            <p class="date c-gray pr-4">{{ $profile->updated_at->addYear(543)->translatedFormat('j F Y') }}</p>
                            {{-- <p class="view c-gray pr-4">250 view</p> --}}
                            <p class="view c-gray pr-4">{{ $profile->user->name }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="content-editor">
                           {!! $profile->content !!}
                       </div> <!-- editor -->
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
                       <div>
                           <h2 class="title-line c-pink mb-2">อื่นๆที่น่าสนใจ</h2>
                           <ul class="content-list">
                               <li>
                                   <a href="#">
                                       <h3 class="font-medium txt-wrap2">PROFILE MANAGEMENT</h3>
                                       <p class="date c-pink pt-2">25 ธ.ค. 2564</p>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <h3 class="font-medium txt-wrap2">PROFILE MANAGEMENT</h3>
                                       <p class="date c-pink pt-2">25 ธ.ค. 2564</p>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <h3 class="font-medium txt-wrap2">PROFILE MANAGEMENT</h3>
                                       <p class="date c-pink pt-2">25 ธ.ค. 2564</p>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <h3 class="font-medium txt-wrap2">PROFILE MANAGEMENT</h3>
                                       <p class="date c-pink pt-2">25 ธ.ค. 2564</p>
                                   </a>
                               </li>
                           </ul>
                       </div>
                        <div class="pt-5">
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