@extends('backend.layouts.app', ['title' => 'FAQ'])

@section('content')

<h1>FAQ</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>FAQ</h2>
            <p><i class="fa fa-home"></i> - FAQ - {{ empty($faq->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/faqs/$faq->id"), 'id' => 'form-faq', 'class'=>'form',
        'redirect-url'=>route('faqs.index')]) }}
        @method($faq->id ? 'PUT' : 'POST')

        <div class="form-body">
            {!! Form::groupText('title','หัวข้อ', $faq->title, ['required'=>'required']) !!}
            {{-- {!! Form::groupText('content', 'คำตอบ', $faq->content, []) !!} --}}

            {!! Form::groupSummernoteEditor('content', 'คำตอบ', $faq->content, true) !!}

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $faq->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/faqs') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ mix('backend/js/summernote-editor.min.js') }}"></script>
<script src="{{ mix('backend/js/pages/faq.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\FaqRequest', '#form-faq') !!}

@endsection