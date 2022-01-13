@extends('backend.layouts.app', ['title' => 'ระบบติดต่อสอบถาม'])

@section('content')

<h1>ระบบติดต่อสอบถาม</h1>

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
        <table class="table table-bordered table-striped" id="table-message">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>เรื่อง</th>
                    <th>วันที่ได้รับ</th>
                    <th>ผู้ส่ง</th>
                    <th>ติดต่อผู้ส่ง</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/message.min.js') }}"></script>
@endsection