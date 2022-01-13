@extends('backend.layouts.app', ['title' => 'ระบบคลังวีดีโอ'])

@section('content')

<h1>ระบบคลังวีดีโอ</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>ระบบคลังวีดีโอ</h2>
            <p><i class="fa fa-home"></i> - ระบบคลังวีดีโอ - {{ empty($video->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/videos/$video->id"), 'id' => 'form-video', 'class'=>'form', 'files'=>true,
        'redirect-url'=>route('videos.index')]) }}
        @method($video->id ? 'PUT' : 'POST')

        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อ VDO', $video->title, ['required'=>'required']) !!}

            {!! Form::groupSelect('video_category_id', 'หมวดหมู่', $videoCategories, $video->video_category_id,
            ['data-live-search'=>'true', 'required'=>'required']) !!}

            @include('backend.components.form_featured_image',
            [
                'label' => 'รูปภาพหน้าปก',
                'model' => $video,
                'help' => '*รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 600x300 px'
            ])

            {!! Form::groupText('video_url', 'Video URL', $video->video_url, ['placeholder'=>'https://', 'helptext'=>'Eg. https://youtu.be/EKLS6l929nA']) !!}

            @if ($video->video_url)
            <div class="form-group">
                <iframe class="photo" src="{{ $video->youtube_embed }}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            @endif
            
            <div class="form-group">
                <label for="" class="control-label">อัพโหลด VDO</label>
                <div class="file-input">
                    <input type="file" class="file" name="video" accept="video/mp4,video/x-m4v,video/*" />
                    @if ($video->has_video)
                    <span class="file-input-name">{{ $video->video_name }} ({{ $video->video_size }})</span>
                    @endif
                </div>
                <span class="help-block">*รองรับไฟล์ MP4 ขนาดไม่เกิน 500MB</span>
                <video controls class="preview-video">
                    <source src="{{ $video->video }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $video->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/videos') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/video.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\VideoRequest', '#form-video') !!}
@endsection