@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white">
    <div class="container">

        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ระบบติดต่อสอบถาม</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">ระบบติดต่อสอบถาม</h1>
            </div>
            <div class="col-md-8">
                @if (session()->has('success'))
                <h2>ทำการส่งข้อความไปยังผู้ดูแลเว็บไซต์เรียบร้อยแล้ว</h2>
                @else
                {{ Form::open(['url'=>url('contact-us'), 'class'=>'mt-5 mb-4', 'id'=>'form-contact']) }}
                    <div class="form-group py-2">
                        <label>เรื่อง</label>
                        <input type="text" class="form-control extra" name="subject">
                    </div>
                    <div class="form-group py-2">
                        <label>หน่วยงาน</label>
                        <select class="form-control extra" name="department">
                            <option value="ศูนย์เรียนรู้การพัฒนาสตรีและครอบครัวรัตนาภา จังหวัดขอนแก่น">ศูนย์เรียนรู้การพัฒนาสตรีและครอบครัวรัตนาภา จังหวัดขอนแก่น</option>
                        </select>
                    </div>
                    <div class="form-group py-2">
                        <label>ชื่อผู้ส่ง</label>
                        <input type="text" class="form-control extra" name="sender_name">
                    </div>
                    <div class="form-group py-2">
                        <label>อีเมลผู้ส่ง</label>
                        <input type="email" class="form-control extra" name="sender_email">
                    </div>
                    <div class="form-group py-2">
                        <label>เบอร์ติดต่อ</label>
                        <input type="text" class="form-control extra" name="sender_tel">
                    </div>
                    <div class="form-group py-2">
                        <label>ข้อความ</label>
                        <textarea class="form-control extra" name="note" rows="8"></textarea>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <button type="button" class="btn btn-light w-100">ยกเลิก</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-pink w-100">ส่ง</button>
                        </div>
                    </div>
                {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Frontend\ContactUsRequest', '#form-contact') !!}
@endsection