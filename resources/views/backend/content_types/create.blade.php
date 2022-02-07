@extends('backend.layouts.app', ['title' => 'ประเภทเนื้อหา'])

@section('content')

<h1>จัดการประเภทเนื้อหา</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>{{ $contentType->id ? $contentType->title : "เพิ่มประเภทเนื้อหา" }}</h2>
            <p><i class="fa fa-home"></i> - ประเภทเนื้อหา - {{ empty($contentType->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/content-types/$contentType->id"), 'id' => 'form-content-type', 'class'=>'form', 'files'=>true,
        'redirect-url'=>url("admin/content-types")]) }}
        @method($contentType->id ? 'PUT' : 'POST')
      
        <div class="form-body">
            {!! Form::groupText('name', 'ชื่อประเภทเนื้อหา', $contentType->name, ['required'=>'required']) !!}
        </div>
        <div class="form-action">
            <a href="{{ url("admin/content-types") }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/content-type.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\ContentTypeRequest', '#form-content-type') !!}
@endsection