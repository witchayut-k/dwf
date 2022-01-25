@extends('backend.layouts.app', ['title' => 'Link Management'])

@section('content')

<h1>Link Management</h1>

<div class="block weblink-app">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>Link Management</h2>
            <p><i class="fa fa-home"></i> - Link Management - {{ empty($weblink->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/weblinks/$weblink->id"), 'id' => 'form-weblink', 'class'=>'form',
        'files'=>true, 'redirect-url'=>route('weblinks.index')]) }}
        @method($weblink->id ? 'PUT' : 'POST')

        {{ Form::hidden('weblink_type_value', $weblink->weblink_type_id) }}
        {{ Form::hidden('parent_type_value', $weblink->type ? $weblink->type->parent_type_id : '') }}

        <div class="form-body">
            {!! Form::groupText('title', 'หัวข้อ', $weblink->title, ['required'=>'required']) !!}
            {!! Form::groupText('subtitle', 'รายละเอียดเพิ่มเติม', $weblink->subtitle) !!}

            <div class="form-group" v-cloak>
                <label class="control-label">หมวดหมู่หลัก <span class="required">*</span></label>
                <select name="parent_type_id" class="selectpicker" title="เลือกหมวดหมู่หลัก" @change="onParentChange($event)" v-model="parent_type_id">
                    <option :value="item.id" v-for="(item, index) in parentTypes">@{{ item.title }}</option>
                </select>
            </div>

            <div class="form-group" v-cloak>
                <label class="control-label">หมวดหมู่ย่อย <span class="required">*</span></label>
                <select name="weblink_type_id" class="selectpicker" title="เลือกหมวดหมู่ย่อย" @change="onChange($event)" v-model="weblink_type_id">
                    <option :value="item.id" v-for="(item, index) in types">@{{ item.title }}</option>
                </select>
            </div>

            {!! Form::groupText('url', 'Link', $weblink->url, ['required'=>'required']) !!}

            @include('backend.components.form_featured_image', [
                'model' => $weblink,
                'label' => 'รูปภาพ',
                'help' => '*รองรับไฟล์ JPG, PNG, GIF ขนาด 324 x 130 px']
            )

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $weblink->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/weblinks') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/weblink.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\WeblinkRequest', '#form-weblink') !!}
@endsection