@extends('backend.layouts.app', ['title' => 'Link Management'])

@section('content')

<h1>Link Management</h1>

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
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-main-weblink-type">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>หมวดหมู่</th>
                    <th>ภาพตัวอย่าง</th>
                    <th>หมวดหมู่ย่อย</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>

@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/weblink-type.min.js') }}"></script>
@endsection