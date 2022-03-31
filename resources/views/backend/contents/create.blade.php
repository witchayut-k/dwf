@extends('backend.layouts.app', ['title' => 'จัดการเนื้อหาเว็บไซต์'])

@section('styles')
<link href="{{ mix('backend/css/content.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

<h1>จัดการเนื้อหาเว็บไซต์</h1>

<div class="block content-app">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>จัดการเนื้อหาเว็บไซต์</h2>
            <p><i class="fa fa-home"></i> - จัดการเนื้อหาเว็บไซต์ - {{ empty($content->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/contents/$content->id"), 'id' => 'form-content', 'class'=>'form',
        'files'=>true, 'redirect-url'=>route('contents.index')]) }}
        @method($content->id ? 'PUT' : 'POST')

        <div class="form-body">

            {!! Form::hidden('id', $content->id) !!}

            {!! Form::groupText('title', 'ชื่อเนื้อหา', $content->title, ['required'=>'required']) !!}

            {!! Form::groupSelect('content_type_id', 'ประเภทเนื้อหา', $contentTypes, $content->content_type_id, ['required'=>'required','data-live-search'=>'true']) !!}

            <div class="form-group center-container" style="display: {{ $content->content_type_id == Config::get('dwf.regional_content_id') ? 'block' : 'none' }}">
                <label class="control-label">ศูนย์ต่างๆ <span class="required">*</span></label>
                <select name="center_name" class="form-control selectpicker">
                    <option value="">[-ไม่ระบุ-]</option>
                    @foreach (Config::get('dwf.centers') as $item)
                        <option value="{{ $item }}" {{ $content->center_name == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>

            {!! Form::groupSummernoteEditor('content', 'รายละเอียด', $content->content) !!}

            @include('backend.components.form_featured_image', [
                'model' => $content,
                'label' => 'รูปภาพ',
                'help' => '*รองรับไฟล์ JPG, PNG, GIF ขนาด 640 x 360 px'])

            {{-- <div class="form-group">
                <label for="" class="control-label">แนบไฟล์ PDF</label>
                <div class="file-input">
                    <input type="file" class="file" name="pdf" accept="application/pdf" />
                    @if ($content->has_file)
                    <span class="file-input-name">{{ $content->file_name }} ({{ $content->file_size  }})</span>
                    @endif
                </div>
                @if ($content->has_file)
                <a href="javascript:;" class="btn-delete-file">ลบไฟล์แนบ</a>
                @endif
            </div> --}}

            <hr class="form-separator" />

            <h4>ไฟล์แนบ</h4>

            <div class="form-group">
                <div class="files-container">
                    <div class="files-items" style="display: none;" v-show="!files.processing">
                        <div class="item" v-for="(item, index) in files.items">
                            @{{ index + 1 }} - @{{ item.name }}
                            <button type="button" class="btn-delete-item" v-bind:data-id="item.id"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <div id="files-preview" class="dropzone" style="display:none">
        
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-add-files btn-add-field">เพิ่มไฟล์</button>

            <hr class="form-separator" />

            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>วันเริ่มต้น</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" name="begin_date" class="form-control bs-datepicker" value="{{ $content->begin_date ? $content->begin_date->format('d/m/Y') : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>วันสิ้นสุด</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" name="end_date" class="form-control bs-datepicker" value="{{ $content->end_date ? $content->end_date->format('d/m/Y') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::groupText('tags', 'Tags', $content->tags, ['data-role'=>'tagsinput', 'helptext'=>'กด Enter เพื่อเริ่ม tag ใหม่']) !!}

            <div class="form-separator"></div>

            <div class="form-group">
                <label>รูปแบบการแสดงผล</label>
                <div class="app-radio inline round"> 
                    <label>
                        <input type="radio" name="template_id" value="1" {{ $content->template_id == \App\Enums\ContentTemplateEnum::RIGHT_COLUMN ? 'checked' : '' }}> Right Column 
                    </label> 
                </div>
                <div class="app-radio inline round"> 
                    <label>
                        <input type="radio" name="template_id" value="2" {{ $content->template_id == \App\Enums\ContentTemplateEnum::LEFT_COLUMN ? 'checked' : '' }}> Left Column 
                    </label> 
                </div>
                <div class="app-radio inline round"> 
                    <label>
                        <input type="radio" name="template_id" value="3" {{ $content->template_id == \App\Enums\ContentTemplateEnum::FULLWIDTH ? 'checked' : '' }}> Full width 
                    </label> 
                </div>
               
            </div>

            <div class="form-separator"></div>

            <div class="d-flex">
                <div class="form-group">
                    <label for="" class="control-label">สถานะการแสดงผล</label>
                    <label class="switch has-label">
                        <input type="checkbox" name="published" {{ $content->published ? "checked" : "" }} />
                        เปิดใช้งาน
                    </label>
                </div>
    
                <div class="form-group">
                    <label for="" class="control-label">การปักหมุด</label>
                    <label class="switch has-label">
                        <input type="checkbox" name="pinned" {{ $content->pinned ? "checked" : "" }} />
                        ปักหมุด
                    </label>
                </div>
            </div>

           
        </div>
        <div class="form-action">
            @if ($content->id)
            <a href="{{ url("contents/$content->id") }}" class="btn btn-default" target="_blank">View</a>
            @endif
            <a href="{{ url('admin/contents') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>

            <span id="regional_content_id" data-id="{{ Config::get('dwf.regional_content_id') }}"></span>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/summernote-editor.min.js') }}"></script>
<script src="{{ mix('backend/js/pages/content.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\ContentRequest', '#form-content') !!}
@endsection