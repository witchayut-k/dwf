@extends('backend.layouts.app', ['title' => 'Backend User management'])

@section('content')

<h1>Backend User role management</h1>

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
                <a href="{{ url('admin/user-roles/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มสิทธิ์ใหม่
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-role">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อสิทธิ์</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/user-role.min.js') }}"></script>
@endsection