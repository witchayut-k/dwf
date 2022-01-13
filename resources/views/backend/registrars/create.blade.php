@extends('backend.layouts.app', ['title' => 'ระบบลงทะเบียน'])

@section('content')

<h1>ระบบลงทะเบียน</h1>

<div class="block registrar-app">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>ระบบลงทะเบียน</h2>
            <p><i class="fa fa-home"></i> - ระบบลงทะเบียน - {{ empty($registrar->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/registrars/$registrar->id"), 'id' => 'form-registrar', 'class'=>'form', 'files'=>true, 'redirect-url'=>route('registrars.index')]) }}
        @method($registrar->id ? 'PUT' : 'POST')

        {{ Form::hidden('id', $registrar->id) }}
        
        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อแบบลงทะเบียน', $registrar->title, ['required'=>'required']) !!}

            @include('backend.components.form_featured_image', [
                'model' => $registrar, 
                'label' => 'รูปภาพหน้าปก',
                'help' => '*รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 600x300 px'])

            {!! Form::groupTextArea('description', 'รายละเอียด', $registrar->description, []) !!}

            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>วันเริ่มต้น</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" name="begin_date" class="form-control bs-datepicker" value="{{ $registrar->begin_date ? $registrar->begin_date->format('d/m/Y') : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>วันสิ้นสุด</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" name="end_date" class="form-control bs-datepicker" value="{{ $registrar->end_date ? $registrar->end_date->format('d/m/Y') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <hr class="form-separator" />

            <h4>ฟิลด์ข้อมูลลงทะเบียน</h4>

            <div class="field-group" v-cloak>
                <div class="form-group" v-for="(item, index) in fields">
                    <label>ฟิลด์ @{{ index+1 }}</label>
                    <div class="input-group-icon">
                        <input type="text" class="form-control" v-model="item.name" />
                        <button type="button" class="btn-delete" v-on:click="removeField(index)"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-add-field" :disabled="fields.length == maxFields" v-on:click="addField()">เพิ่มฟิลด์</button>

            <hr class="form-separator" />

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $registrar->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/registrars') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/registrar.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\RegistrarRequest', '#form-registrar') !!}
@endsection