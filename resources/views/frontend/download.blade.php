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
                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabNewsVdo{{ $key }}" role="tabpanel" aria-labelledby="tabNewsVdo2">
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
        </div>
    </div>
</div>
@endsection