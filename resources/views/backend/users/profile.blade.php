@extends('backend.layouts.app', ['title' => 'Profile Management'])

@section('content')

<h1>Profile Management</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>Profile Management</h2>
            <p><i class="fa fa-home"></i> - Profile Management - {{ empty($user->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/profile/$user->id"), 'id' => 'form-profile', 'class'=>'form']) }}
        @method('PUT')

        <div class="form-body">

            <div class="form-group">
                <label for="" class="control-label">รูปภาพประจำตัว</label>
                <div class="featured {{ $user->has_avatar_image ? 'preview' : '' }}"
                    style="background-image: url({{ $user->avatar_image }})"> </div>
                <span class="help-block"><mark>*รองรับไฟล์ JPG PNG ขนาดไม่เกิน 600x600 px</mark></span>
            </div>

            <div class="row row-form">
                <div class="col-sm-6">
                    {!! Form::groupText('username', 'Username', $user->username, ['readonly'=>'readonly']) !!}
                </div>
            </div>

            <div class="row row-form">
                <div class="col-sm-6">
                    {!! Form::groupText('name','ชื่อ-นามสกุล', $user->name, ['required'=>'required', 'maxlength'=>100]) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::groupText('email', 'อีเมล', $user->email, ['maxlength'=>100]) !!}
                </div>
            </div>

            <h4>เปลี่ยนรหัสผ่าน</h4>

            <div class="row row-form">
                <div class="col-sm-6">
                    {!! Form::groupText('password', 'รหัสผ่านใหม่', null, []) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::groupText('password_confirmation','ยืนยันรหัสผ่านใหม่', null, []) !!}
                </div>
            </div>

        </div>
        <div class="form-action">
            {{ Form::hidden('id', $user->id) }}
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/profile.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\ProfileRequest', '#form-profile') !!}
@endsection