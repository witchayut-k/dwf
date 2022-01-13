@extends('backend.layouts.app', ['title' => 'จัดการแบนเนอร์'])

@section('content')

<h1>จัดการแบนเนอร์</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>จัดการแบนเนอร์</h2>
            <p><i class="fa fa-home"></i> - จัดการแบนเนอร์ - {{ empty($banner->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/banners/$banner->id"), 'id' => 'form-banner', 'class'=>'form', 'files'=>true, 'redirect-url'=>route('banners.index')]) }}
        @method($banner->id ? 'PUT' : 'POST')
        
        <div class="form-body">
            {!! Form::groupText('title','หัวข้อ', $banner->title, ['required'=>'required']) !!}
            {!! Form::groupText('url','URL', $banner->url, []) !!}

            <div class="form-group">
                <label for="" class="control-label">รูปภาพ</label>
                <div class="image-info" style="display: {{ $banner->has_featured_image ? '' : 'none' }}"> </div>
                <div class="featured {{ $banner->has_featured_image ? 'preview' : '' }}" style="background-image: url({{ $banner->featured_image }})"> </div>
                <span class="help-block"><mark>*รองรับไฟล์ JPG PNG ขนาดไม่เกิน 600x300 px</mark></span>
            </div>

            {{-- <div class="form-group">
                <label for="" class="control-label">รูปภาพ</label>
                <div class="file-input">
                    <input type="file" class="file" accept="image/*" />
                </div>
                <span class="help-block">*รองรับไฟล์ JPG PNG ขนาดไม่เกิน 600x300 px</span>
                <img src="" alt="preview" class="preview-image" style="display: none" />
            </div> --}}

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $banner->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/banners') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/banner.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\BannerRequest', '#form-banner') !!}
@endsection