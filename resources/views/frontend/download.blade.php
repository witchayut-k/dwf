@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white">
    <div class="container">
        <div class="box-tab pt-4">
            <ul class="nav nav-tabs nav-news" id="myTabNewsVdo" role="tablist">
                @foreach ($documentTypes as $key => $docType)
                <li class="nav-item">
                    <a class="nav-link nav-icon doc {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#tabNewsVdo{{ $key }}" role="tab" aria-controls="tabNewsVdo{{ $key }}" aria-selected="false">{{ $docType->type_name }}</a>
                </li>
                @endforeach
              
            </ul>
            <div class="tab-content" id="myTabNewsVdoContent">
                @foreach ($documentTypes as $key => $docType)
                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabNewsVdo2" role="tabpanel" aria-labelledby="tabNewsVdo2">
                    <div>
                        @foreach ($docType->published_documents as $key => $file)
                             {{-- @if ($file->hasFile) --}}
                            <a href="{{ url("downloads?id=$file->id") }}" class="check-item txt-wrap pl-5" target="_blank">{{ $file->title }}</a>
                            {{-- @endif --}}
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
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
</div>
@endsection