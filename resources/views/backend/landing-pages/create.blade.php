@extends('backend.layouts.app', ['title' => 'Landing Page Management'])

@section('content')

<h1>Landing Page Management</h1>

<div class="block landing-page-app">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>Content Management</h2>
            <p><i class="fa fa-home"></i> - Landing Page - {{ empty($landingPage->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/landing-pages/$landingPage->id"), 'id' => 'form-landing-page',
        'class'=>'form', 'files'=>true, 'redirect-url'=>url('admin/landing-pages')]) }}
        @method($landingPage->id ? 'PUT' : 'POST')

        <div class="form-body">
            {!! Form::groupText('title','ชื่อเรื่อง', $landingPage->title, ['required'=>'required']) !!}

            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>วันเริ่มต้น</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" name="begin_date" class="form-control bs-datepicker" value="{{ $landingPage->begin_date ? $landingPage->begin_date->format('d/m/Y') : '' }}">
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
                            <input type="text" name="end_date" class="form-control bs-datepicker" value="{{ $landingPage->end_date ? $landingPage->end_date->format('d/m/Y') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            @include('backend.components.form_featured_image', [
                'model' => $landingPage,
                'help' => '*รองรับไฟล์ JPG, PNG, GIF ขนาด 800 x 450 pixel'
            ])

            <div class="form-separator"></div>

            <div class="d-flex">
                <div class="form-group">
                    <label for="" class="control-label">สถานะการแสดงผล</label>
                    <label class="switch has-label">
                        <input type="checkbox" name="published" {{ $landingPage->published ? "checked" : "" }} />
                        เปิดใช้งาน
                    </label>
                </div>

                <div class="form-group">
                    <label for="" class="control-label">แสดงแบบเต็มหน้า</label>
                    <label class="switch has-label">
                        <input type="checkbox" name="is_page" {{ $landingPage->is_page ? "checked" : "" }} />
                        แสดงเต็มหน้า
                    </label>
                </div>

                <div class="form-group">
                    <label for="" class="control-label">แสดงแบบ Popup</label>
                    <label class="switch has-label">
                        <input type="checkbox" name="is_popup" {{ $landingPage->is_popup ? "checked" : "" }} />
                        แสดง Popup
                    </label>
                </div>
            </div>

            <div class="form-separator"></div>

            <h4>Action Buttons</h4>

            <div class="field-group" v-cloak>
                <div class="d-flex" v-for="(item, index) in buttons">
                    <div class="form-group" style="margin-right: 10px">
                        <label>ชื่อปุ่มที่ @{{ index+1 }}</label>
                        <input type="text" class="form-control" v-model="item.title" placeholder="ระบุชื่อปุ่ม" />
                    </div>
                    <div class="form-group">
                        <label>ลิงค์ปุ่มที่ @{{ index+1 }}</label>
                        <div class="input-group-icon">
                            <input type="text" class="form-control" v-model="item.url" placeholder="https://" />
                            <button type="button" class="btn-delete" v-on:click="removeButton(index)"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-add-field" v-on:click="addButton()">เพิ่มปุ่ม</button>

        </div>
        <div class="form-action">
            <a href="{{ url('admin/landing-pages') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
            {{ Form::hidden('id', $landingPage->id) }}
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/landing-page.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\LandingPageRequest', '#form-landing-page') !!}
@endsection