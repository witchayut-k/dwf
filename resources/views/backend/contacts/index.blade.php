@extends('backend.layouts.app', ['title' => 'ช่องทางการติดต่อ'])

@section('content')

<h1>ช่องทางการติดต่อ</h1>

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
                <a href="{{ url('admin/contacts/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มช่องทางการติดต่อ
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-contact">
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>ที่ตั้ง</th>
                    <th>เบอร์ติดต่อ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/contact.min.js') }}"></script>
@endsection