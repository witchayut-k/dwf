@extends('backend.layouts.app', ['title' => 'จัดการข้อมูล Download'])

@section('content')

<h1>จัดการข้อมูล Download</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>จัดการข้อมูล Download</h2>
            <p><i class="fa fa-home"></i> - จัดการข้อมูล Download - {{ empty($document->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/documents/$document->id"), 'id' => 'form-document', 'class'=>'form',
        'files'=>true, 'redirect-url'=>route('documents.index')]) }}
        @method($document->id ? 'PUT' : 'POST')

        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อไฟล์', $document->title, ['required'=>'required']) !!}
            {!! Form::groupSelect('document_type_id', 'หมวดหมู่', $documentTypes, $document->document_type_id,
            ['data-live-search'=>'true','required'=>'required']) !!}
            {!! Form::groupTextArea('description', 'รายละเอียด', $document->description, []) !!}

            <div class="form-group">
                <label for="" class="control-label">ไฟล์</label>
                <div class="file-input">
                    <input type="file" class="file" name="file" required />
                    @if ($document->has_file)
                    <span class="file-input-name">{{ $document->file_name }} ({{ $document->file_size  }})</span>
                    @endif
                </div>
                {{-- <span class="help-block">*รองรับไฟล์ PDF DOC DOCX XLS PPT CSV</span> --}}
                @if ($document->has_file)
                <div style="margin-top: 10px">
                    <button type="button" data-id="{{ $document->getFirstMedia('file')->id }}" class="btn btn-xs btn-danger btn-delete-image">ลบไฟล์แนบ</button>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $document->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/documents') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/document.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\DocumentRequest', '#form-document') !!}
@endsection