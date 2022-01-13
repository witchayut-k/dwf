@extends('backend.layouts.app', ['title' => 'ระบบรับเรื่องร้องเรียน และระบบแจ้งเบาะแสทุจริต'])

@section('content')

<h1>ระบบรับเรื่องร้องเรียน และระบบแจ้งเบาะแสทุจริต</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>ระบบรับเรื่องร้องเรียน และระบบแจ้งเบาะแสทุจริต</h2>
            <p><i class="fa fa-home"></i> - ระบบรับเรื่องร้องเรียน และระบบแจ้งเบาะแสทุจริต - {{ empty($petition->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/petitions/$petition->id"), 'id' => 'form-petition', 'class'=>'form', 'files'=>true, 'redirect-url'=>route('petitions.index')]) }}
        @method($petition->id ? 'PUT' : 'POST')
        
        <div class="form-body">
            {!! Form::groupText('title','หัวข้อ', $petition->title, ['required'=>'required']) !!}
            {!! Form::groupText('url','URL', $petition->url, []) !!}

            <div class="form-group">
                <label for="" class="control-label">รูปภาพ</label>
                <div class="image-info" style="display: {{ $petition->has_featured_image ? '' : 'none' }}"> </div>
                <div class="featured {{ $petition->has_featured_image ? 'preview' : '' }}" style="background-image: url({{ $petition->featured_image }})"> </div>
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
                    <input type="checkbox" name="published" {{ $petition->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/petitions') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/petition.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\PetitionRequest', '#form-petition') !!}
@endsection