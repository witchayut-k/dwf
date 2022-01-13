@extends('backend.layouts.app', ['title' => 'ระบบรับเรื่องร้องเรียน และระบบแจ้งเบาะแสทุจริต'])

@section('content')

<h1>ระบบรับเรื่องร้องเรียน และระบบแจ้งเบาะแสทุจริต</h1>

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
                <a href="{{ url('admin/petitions/export') }}" class="btn btn-create" target="_blank" style="width: 140px">
                    Export
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-petition">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>หัวข้อ</th>
                    <th>ประเภท</th>
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/petition.min.js') }}"></script>
@endsection