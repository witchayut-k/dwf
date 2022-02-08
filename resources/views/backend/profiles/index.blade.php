@extends('backend.layouts.app', ['title' => 'Profile Management'])

@section('content')

<h1>Profile Management</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>Profile Management</h2>
            <p><i class="fa fa-home"></i> - Profile Management - {{ empty($profile->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/profile/$profile->id"), 'id' => 'form-profile', 'class'=>'form',
        'files'=>true, 'redirect-url'=>route('profile.index')]) }}
        @method($profile->id ? 'PUT' : 'POST')

        {{ Form::hidden('user_id', $user->id) }}

        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อเนื้อหา', $profile->title, ['required'=>'required']) !!}

            {!! Form::groupSummernoteEditor('content', 'เนื้อหา', $profile->content) !!}

            <div class="form-group">
                <label for="" class="control-label">แนบไฟล์</label>
                <div class="file-input">
                    <input type="file" class="file" name="file" accept="" />
                    @if ($profile->has_file)
                    <span class="file-input-name">{{ $profile->file_name }} ({{ $profile->file_size  }})</span>
                    @endif
                </div>
                @if ($profile->has_file)
                <div style="margin-top: 10px">
                    <button type="button" data-id="{{ $profile->getFirstMedia('file')->id }}" class="btn btn-xs btn-danger btn-delete-image">ลบไฟล์แนบ</button>
                </div>
                @endif
            </div>

        </div>
        <div class="form-action">
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/summernote-editor.min.js') }}"></script>
<script src="{{ mix('backend/js/pages/profile.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\ProfileRequest', '#form-profile') !!}

@endsection