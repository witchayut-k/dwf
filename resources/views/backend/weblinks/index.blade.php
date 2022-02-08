@extends('backend.layouts.app', ['title' => 'Link Management'])

@section('content')

<h1>Link Management</h1>

<div class="block block-condensed weblink-app">
    <div class="app-heading">
        <div class="d-flex">
            <div class="mr-10">
                <div class="form-group">
                    <label>หมวดหมู่หลัก</label>
                    <select name="parent_type_id" class="selectpicker" title="เลือกหมวดหมู่หลัก" @change="onParentChange($event)">
                        <option value="">แสดงทั้งหมด</option>
                        <option :value="item.id" v-for="(item, index) in parentTypes">@{{ item.title }}</option>
                    </select>
                </div>
            </div>
            <div class="mr-10">
                <div class="form-group">
                    <label>หมวดหมู่ย่อย</label>
                    <select name="weblink_type_id" class="selectpicker" title="เลือกหมวดหมู่ย่อย" @change="onChange($event)">
                        <option value="">แสดงทั้งหมด</option>
                        <option :value="item.id" v-for="(item, index) in types">@{{ item.title }}</option>
                    </select>
                </div>
            </div>
            <div class="mr-10">
                <div class="form-group">
                    <label>ค้นหาจากชื่อ</label>
                    <div class="input-icon">
                        <i class="fa fa-search"></i>
                        <input type="search" class="form-control input-search" placeholder="ค้นหา...">
                    </div>
                </div>
            </div>
            <div class="flex-grow"> </div>
            <div>
                <a href="{{ url('admin/weblinks/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่ม Content
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-weblink">
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>หัวข้อ</th>
                    <th>ภาพ</th>
                    <th>หมวดหมู่หลัก</th>
                    <th>หมวดหมู่ย่อย</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/weblink.min.js') }}"></script>
@endsection