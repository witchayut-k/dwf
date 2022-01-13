@extends('frontend.layouts.web')

@section('content')

<div class="wrapper-inner bg-white">
    <div class="container">

        <div class="row content-row mb-5">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink pt-2">{{ $category->name }}</h1>
            </div>
        </div>

        <div class="row content-row">
            @foreach ($contents as $content)
            <div class="col-md-6 col-lg-3">
                <a href="{{ url("categories/$category->id/$content->id") }}" class="box-item">
                    <div class="photo-thumb sm">
                        <div class="photo-parent">
                            <span class="photo" style="background-image: url('{{ $content->featured_image_resized }}')"></span>
                        </div>
                    </div>
                    <div class="box-item-dt">
                        <h2 class="txt-wrap">{{ $content->title }}</h2>
                        <div class="d-flex flex-wrap">
                            <p class="date pr-4">{{ $content->created_at }}</p>
                            <p class="view pr-4">{{ $content->view_count }} view</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
           
        </div>

        {{ $contents->links() }}
        
        {{-- <nav aria-label="Page navigation example">
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
        </nav> --}}

    </div>
</div>

@endsection