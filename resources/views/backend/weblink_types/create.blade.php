@extends('backend.layouts.app', ['title' => 'Link Management'])

@section('content')

<h1>จัดการหมวดหมู่ย่อย</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>{{ $weblinkType->id ? $weblinkType->title : "เพิ่มหมวดหมู่ย่อย" }}</h2>
            <p><i class="fa fa-home"></i> - Link Management - {{ empty($weblinkType->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/weblink-types/$weblinkType->id"), 'id' => 'form-weblink-type', 'class'=>'form', 'files'=>true,
        'redirect-url'=>url("admin/weblink-types/$parentType->id/table")]) }}
        @method($weblinkType->id ? 'PUT' : 'POST')
      
        {{ Form::hidden('parent_type_id', $parentType->id) }}

        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อหมวดหมู่ย่อย', $weblinkType->title, ['required'=>'required']) !!}

            <div class="form-group">
                <label for="" class="control-label">รูปภาพ Icon (ก่อน Active)</label>
                <div class="file-input">
                    <input type="file" class="file" name="icon" accept="image/*" />
                    @if ($weblinkType->has_icon)
                    <span class="file-input-name">{{ $weblinkType->icon }} ({{ $weblinkType->icon_resized }})</span>
                    @endif
                </div>
                <span class="help-block">*รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 600x600 px</span>
                <img src="{{ $weblinkType->icon_resized }}" alt="preview" class="preview-image icon" />
            </div>

            <div class="form-group">
                <label for="" class="control-label">รูปภาพ Icon (ขณะ Active)</label>
                <div class="file-input">
                    <input type="file" class="file" name="icon_active" accept="image/*" />
                    @if ($weblinkType->has_icon_active)
                    <span class="file-input-name">{{ $weblinkType->icon_active }} ({{ $weblinkType->icon_active_resized }})</span>
                    @endif
                </div>
                <span class="help-block">*รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 600x600 px</span>
                <img src="{{ $weblinkType->icon_active_resized }}" alt="preview" class="preview-image icon" />
            </div>

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $weblinkType->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url("admin/weblink-types/$parentType->id/table") }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/weblink-type.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\WeblinkTypeRequest', '#form-weblink-type') !!}
@endsection