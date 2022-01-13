@extends('backend.layouts.app', ['title' => 'ระบบคลังภาพ'])

@section('styles')
<link href="{{ mix('backend/css/album.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

<h1>ระบบคลังภาพ</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>ระบบคลังภาพ</h2>
            <p><i class="fa fa-home"></i> - ระบบคลังภาพ - {{ empty($album->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content gallery-app">
        {{ Form::open(['url'=> url("admin/albums/$album->id"), 'id' => 'form-album', 'class'=>'form', 'files'=>true,
        'redirect-url'=>route('albums.index')]) }}
        @method($album->id ? 'PUT' : 'POST')

        {{ Form::hidden('id', $album->id) }}

        <div class="form-body">
            {!! Form::groupText('title','ชื่ออัลบั้ม', $album->title, ['required'=>'required']) !!}
            {!! Form::groupText('description', 'คำอธิบายอัลบั้ม', $album->description, []) !!}

            @include('backend.components.form_featured_image',
            [
                'label' => 'รูปภาพหน้าปก',
                'model' => $album,
                'help' => '*รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 600x300 px'
            ])

            <div class="form-group">
                <label for="">ภาพในอัลบั้ม</label>
                <div class="gallery-container">
                    <div class="gallery-images" style="display: none;" v-show="!gallery.processing">
                        <div class="item" v-bind:style="{'background-image':'url(' + image.url + ')'}"  v-for="(image, index) in gallery.items">
                            <button type="button" class="btn-delete-item" v-bind:data-id="image.id"><i class="fa fa-trash"></i></button>
                        </div>
        
                        <div class="item">
                            <button type="button" class="btn btn-add-gallery">
                                <i class="fa fa-camera"></i><br>เพิ่มรูปภาพ
                            </button>
                        </div>
                    </div>
                    <div id="gallery-preview" class="dropzone" style="display:none">
        
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $album->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/albums') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/album.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\AlbumRequest', '#form-album') !!}
@endsection