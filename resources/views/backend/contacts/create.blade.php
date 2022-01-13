@extends('backend.layouts.app', ['title' => 'ช่องทางการติดต่อ'])

@section('content')

<h1>ช่องทางการติดต่อ</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>ช่องทางการติดต่อ</h2>
            <p><i class="fa fa-home"></i> - ช่องทางการติดต่อ - {{ empty($contact->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/contacts/$contact->id"), 'id' => 'form-contact', 'class'=>'form',
        'redirect-url'=>route('contacts.index')]) }}
        @method($contact->id ? 'PUT' : 'POST')

        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อ', $contact->title, ['required'=>'required']) !!}
            {!! Form::groupText('address', 'ที่ตั้ง', $contact->address) !!}

            <div class="form-group">
                <div id="map" class="map"> </div>
                <input type="search" id="map-search-input" class="form-control" placeholder="ค้นหาที่ตั้งโดยพิมพ์ชื่อหรือที่อยู่ที่ต้องการ">

                <input type="hidden" name="lat" value="{{ $contact->lat }}">
                <input type="hidden" name="lng" value="{{ $contact->lng }}">
                <input type="hidden" name="place_id" value="">
            </div>

            {!! Form::groupText('email','อีเมล', $contact->email, []) !!}
            {!! Form::groupText('tel','เบอร์ติดต่อ', $contact->tel, []) !!}

            {!! Form::groupSummernoteEditor('content', 'รายละเอียดเพิ่มเติม', $contact->content) !!}

        </div>
        <div class="form-action">
            <a href="{{ url('admin/contacts') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/summernote-editor.min.js') }}"></script>
<script src="{{ mix('backend/js/pages/contact.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\ContactRequest', '#form-contact') !!}
@endsection