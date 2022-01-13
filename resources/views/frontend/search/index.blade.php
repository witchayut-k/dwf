@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white search">
    <div class="container">
        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ค้นหาข้อมูล</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">ค้นหาข้อมูล</h1>
            </div>
            <div class="col-md-11">
                <div class="search-bar">
                    {{ Form::open(['url'=>'search', 'method'=>'get', 'id'=>'form-search']) }}
                    <div class="form-group">
                        <input type="search" name="q" class="form-control" required
                            placeholder="ค้นหาข้อมูลภายในเว็บไซต์" autocomplete="off" autofocus
                            value="{{ $request->q }}">
                    </div>
                    <div class="form-action">
                        <input type="hidden" name="search" value="true" />
                        <button type="submit" class="btn-search"> <i class="icon-magnifier"></i> เริ่มการค้นหา</button>
                    </div>
                    <div>
                        <a href="{{ url('search/advance') }}">ค้นหาแบบละเอียด</a>
                    </div>
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