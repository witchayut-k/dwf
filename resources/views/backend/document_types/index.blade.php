@extends('backend.layouts.app', ['title' => 'หมวดหมู่เอกสาร'])

@section('content')

<h1>หมวดหมู่เอกสาร</h1>

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
                <a href="{{ url('admin/document-types/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มหมวดหมู่
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-document-type">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อหมวดเอกสาร</th>
                    <th>วันที่สร้าง</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/document-type.min.js') }}"></script>
@endsection