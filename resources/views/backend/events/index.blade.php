@extends('backend.layouts.app', ['title' => 'ระบบปฏิทินกิจกรรม'])

@section('content')

<h1>ระบบปฏิทินกิจกรรม</h1>

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
                <a href="{{ url('admin/events/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มกิจกรรม
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">

        <div class="calendar"></div>

        <table class="table table-bordered table-striped" id="table-event">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>วันที่จัดกิจกรรม</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/event.min.js') }}"></script>
@endsection