@extends('backend.layouts.app', ['title' => 'Backend User management'])

@section('content')

<h1>Backend User management</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>Backend User management</h2>
            <p><i class="fa fa-home"></i> - Backend User management - {{ empty($user->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/users/$user->id"), 'id' => 'form-user', 'class'=>'form', 'files'=>true, 'redirect-url'=>route('users.index')]) }}
        @method($user->id ? 'PUT' : 'POST')
        {{ Form::hidden('id', $user->id) }}
        
        <div class="form-body">

            <div class="form-group">
                <label for="" class="control-label">รูปภาพประจำตัว</label>
                <div class="featured {{ $user->has_avatar_image ? 'preview' : '' }}" style="background-image: url({{ $user->avatar_image }})"> </div>
                <span class="help-block"><mark>*รองรับไฟล์ JPG PNG ขนาดไม่เกิน 600x600 px</mark></span>
            </div>

            <div class="row form-group">
                <div class="col-lg-6">
                    {!! Form::groupText('username', 'Username', $user->username, ['required']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::groupText('name','ชื่อ-นามสกุล', $user->name, ['required']) !!}
                </div>
            </div>

            <div class="row form-group">
                <div class="col-lg-6">
                    {!! Form::groupText('email', 'Email', $user->email, ['required']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::groupSelect('role', 'User Group', $roles, NULL, ['data-live-search'=>'true', 'required']) !!}
                </div>
            </div>

            <div class="row form-group">
                <div class="col-lg-6">
                    {!! Form::groupPassword('password', 'รหัสผ่าน', []) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::groupPassword('password_confirmation', 'ยืนยันรหัสผ่าน', []) !!}
                </div>
            </div>
            

            <div class="form-group">
                <label for="" class="control-label">สถานะการเข้าสู่ระบบ</label>
                <label class="switch has-label">
                    <input type="checkbox" name="enabled" {{ $user->enabled ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>

        </div>
        <div class="form-action">
            <a href="{{ url('admin/users') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/user.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\UserRequest', '#form-user') !!}
@endsection