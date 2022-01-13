@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white search advance">
    <div class="container">
        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ค้นหาแบบละเอียด</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">ค้นหาแบบละเอียด</h1>
            </div>
            <div class="col-md-11">
                <div class="search-bar">
                    {{ Form::open(['url'=>'search/advance', 'method'=>'get', 'id'=>'form-search-advance']) }}
                    <div class="form-group">
                        <label>กลุ่มเนื้อหา</label>
                        <select name="contentType" class="form-control search-type">
                            <option value="">ทั้งหมด</option>
                            @foreach ($contentTypes as $contentType)
                            <option value="{{ $contentType->id }}" {{ $request->contentType == $contentType->id ?
                                "selected" : "" }}>{{ $contentType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>คำสำคัญ</label>
                        <input type="search" name="q" class="form-control" 
                            placeholder="ค้นหาข้อมูลภายในเว็บไซต์" autocomplete="off" autofocus
                            value="{{ $request->q }}">
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>วันเริ่มต้น</label>
                                <input type="text" name="begin" class="form-control bs-datepicker" value="{{ $request->begin }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>วันสิ้นสุด</label>
                                <input type="text" name="end" class="form-control bs-datepicker" value="{{ $request->end }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-action">
                        <input type="hidden" name="search" value="true" />
                        <button type="submit" class="btn btn-primary"> <i class="icon-magnifier"></i> เริ่มการค้นหา</button>
                        <a href="{{ url('search') }}" class="btn btn-default">กลับไปการค้นหาแบบปกติ</a>
                    </div>
                    {{-- <div>
                        ค้นหาแบบละเอียด
                    </div> --}}
                    {{ Form::close() }}

                </div>

                <div class="search-result">
                    @if (count($results) > 0)
                    @foreach ($results as $item)
                        @include('frontend.search.partials.view_result')
                    @endforeach

                    {{ $results->links() }}
                    @elseif ($request->search == 'true')
                    <h3>ไม่พบข้อมูลที่ต้องการค้นหา</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection