@extends('backend.layouts.app', ['title' => 'Landing Page Management'])

@section('content')

<h1>Landing Page Management</h1>

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
                <a href="{{ url('admin/landing-pages/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มเนื้อหาใหม่
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-landing-page">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>รูป</th>
                    <th>วันที่เริ่ม</th>
                    <th>วันที่สิ้นสุด</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/landing-page.min.js') }}"></script>
@endsection