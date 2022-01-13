@extends('backend.layouts.app', ['title' => 'จัดการแบบสำรวจ'])

@section('content')

<h1>จัดการแบบสำรวจ</h1>

<div class="block survey-app">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>จัดการแบบสำรวจ</h2>
            <p><i class="fa fa-home"></i> - จัดการแบบสำรวจ - {{ empty($survey->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/surveys/$survey->id"), 'id' => 'form-survey', 'class'=>'form', 'files'=>true,
        'redirect-url'=>route('surveys.index')]) }}
        @method($survey->id ? 'PUT' : 'POST')

        {{ Form::hidden('id', $survey->id) }}

        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อแบบสำรวจ', $survey->title, ['required'=>'required']) !!}

            {{-- @include('backend.components.form_featured_image', [
            'model' => $survey,
            'label' => 'รูปภาพหน้าปก',
            'help' => '*รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 600x300 px']) --}}
            <hr class="form-separator" />

            <h4>ตัวเลือกแบบสำรวจ</h4>

            <div class="field-group" v-cloak>
                <div class="form-group" v-for="(item, index) in choices">
                    <label>ชื่อตัวเลือก @{{ index+1 }}</label>
                    <div class="input-group-icon">
                        <input type="text" class="form-control" v-model="item.name" />
                        <button type="button" class="btn-delete" v-on:click="removeChoice(index)" :disabled="choices.length == 1"><i
                                class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-add-field" :disabled="choices.length == maxChoices"
                v-on:click="addChoice()">เพิ่มตัวเลือก</button>

            <hr class="form-separator" />

            <h4>ข้อคำถาม</h4>

            <div class="field-group" v-cloak>
                <div class="form-group" v-for="(item, index) in questions">
                    <label>คำถามที่ @{{ index+1 }}</label>
                    <div class="input-group-icon">
                        <input type="text" class="form-control" v-model="item.question" />
                        <button type="button" class="btn-delete" v-on:click="removeQuestion(index)" :disabled="questions.length == 1"><i
                                class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-add-field" :disabled="questions.length == maxQuestions"
                v-on:click="addQuestion()">เพิ่มคำถาม</button>

            <hr class="form-separator" />

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $survey->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/surveys') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/survey.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\SurveyRequest', '#form-survey') !!}
@endsection