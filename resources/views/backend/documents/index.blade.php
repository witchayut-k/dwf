@extends('backend.layouts.app', ['title' => 'จัดการข้อมูล สื่อสิ่งพิมพ์'])

@section('content')

<h1>จัดการข้อมูล สื่อสิ่งพิมพ์</h1>

<div class="block block-condensed">
    <div class="app-heading">
        <div class="d-flex justify-between align-center">
            <div>
                <div class="form-group">
                    <div class="input-icon ">
                        <i class="fa fa-search"></i>
                        <input type="search" class="form-control input-search" placeholder="ค้นหา...">
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ url('admin/documents/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มไฟล์
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-document">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อไฟล์</th>
                    <th>หมวดหมู่เอกสาร</th>
                    <th>วันที่สร้าง</th>
                    <th>View</th>
                    <th>Download</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/document.min.js') }}"></script>
@endsection