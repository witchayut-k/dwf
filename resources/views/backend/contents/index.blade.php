@extends('backend.layouts.app', ['title' => 'จัดการเนื้อหาเว็บไซต์'])

@section('content')

<h1>จัดการเนื้อหาเว็บไซต์</h1>

<div class="block block-condensed">
    <div class="app-heading">
        <div class="d-flex">
            <div class="mr-10">
                <div class="form-group">
                    <select name="content_type_id" class="selectpicker" title="เลือกประเภทเนื้อหา">
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
                <a href="{{ url('admin/contents/create') }}" class="btn btn-create">
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
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/content.min.js') }}"></script>
@endsection