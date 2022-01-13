@extends('backend.layouts.app', ['title' => 'หมวดหมู่เอกสาร'])

@section('content')

<h1>หมวดหมู่เอกสาร</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>หมวดหมู่เอกสาร</h2>
            <p><i class="fa fa-home"></i> - หมวดหมู่เอกสาร - {{ empty($documentType->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/document-types/$documentType->id"), 'id' => 'form-document-type', 'class'=>'form', 'redirect-url'=>route('document-types.index')]) }}
        @method($documentType->id ? 'PUT' : 'POST')
        
        <div class="form-body">
            {!! Form::groupText('type_name','ชื่อหมวดเอกสาร', $documentType->type_name, ['required'=>'required']) !!}

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $documentType->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/document-types') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/document-type.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\DocumentTypeRequest', '#form-document-type') !!}
@endsection