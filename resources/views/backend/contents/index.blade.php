@extends('backend.layouts.app', ['title' => 'จัดการเนื้อหาเว็บไซต์'])

@section('content')

<h1>จัดการเนื้อหาเว็บไซต์</h1>

<div class="block block-condensed">
    <div class="app-heading">
        <div class="d-flex">
            <div class="mr-10">
                <div class="form-group">
                    <select name="content_type_id" class="selectpicker" title="เลือกประเภทเนื้อหา" data-live-search="true">
                        <option value="">แสดงทั้งหมด</option>
                        @foreach ($contentTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mr-10">
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-search"></i>
                        <input type="search" class="form-control input-search" placeholder="ค้นหา...">
                    </div>
                </div>
            </div>
            <div class="flex-grow"> </div>
            <div>
                {{-- <a href="{{ url('admin/contents/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มเนื้อหา
                </a> --}}
                <a href="#modal-simple-create" class="btn btn-create" data-toggle="modal" data-animation="effect-scale">
                    <i class="fa fa-plus"></i> เพิ่มเนื้อหา 
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-content">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อเนื้อหา</th>
                    <th>ภาพ</th>
                    <th>ประเภทเนื้อหา</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>


{{-- Modal Create Form --}}
<span id="regional_content_id" data-id="{{ Config::get('dwf.regional_content_id') }}"></span>

<div class="modal fade " id="modal-simple-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content" >
            {{ Form::open(['url'=>url('admin/contents'), 'id'=>'form-content', 'redirect-url'=>url('admin/contents/{id}/edit')]) }}
            @method("POST")
            <div class="modal-header">
                <h3 class="modal-title"> เพิ่มเนื้อหาเว็บไซต์</h3>
            </div>

            <div class="modal-body">

                <div class="form-body" style="padding: 10px;">

                    <div class="form-group">
                        <label for="tribe_id" class="control-label">หมวดหมู่เนื้อหา</label>
                        <select name="content_type_id" id="content-type-id" class="selectpicker" data-subtext="true" data-live-search="true">
                            @foreach ($contentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group center-container" style="display:none">
                        <label class="control-label">ศูนย์ต่างๆ <span class="required">*</span></label>
                        <select name="center_name" class="form-control selectpicker">
                            <option value="">[-ไม่ระบุ-]</option>
                            @foreach (Config::get('dwf.centers') as $item)
                                <option value="{{ $item }}" >{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    {!! Form::groupText('title', 'ชื่อเรื่อง', NULL, ['required']) !!}

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-dismiss" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
            {{ Form::close() }}
        </div>

    </div>
</div>


@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/content.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\ContentRequest', '#form-content') !!}
@endsection