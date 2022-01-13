@extends('backend.layouts.app', ['title' => 'หมวดหมู่วีดีโอ'])

@section('content')

<h1>หมวดหมู่วีดีโอ</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>หมวดหมู่วีดีโอ</h2>
            <p><i class="fa fa-home"></i> - หมวดหมู่วีดีโอ - {{ empty($videoCategory->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/video-categories/$videoCategory->id"), 'id' => 'form-video-category', 'class'=>'form', 'files'=>true, 'redirect-url'=>route('video-categories.index')]) }}
        @method($videoCategory->id ? 'PUT' : 'POST')
        
        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อหมวด', $videoCategory->title, ['required'=>'required']) !!}

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $videoCategory->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/video-categories') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/video-category.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\VideoCategoryRequest', '#form-video-category') !!}
@endsection