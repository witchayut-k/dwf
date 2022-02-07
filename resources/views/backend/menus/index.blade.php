@extends('backend.layouts.app', ['title' => 'จัดการเมนูเว็บไซต์'])

@section('content')

<h1>จัดการเมนูเว็บไซต์</h1>

<div class="block block-condensed menu-app">
    <div class="app-heading">
        <div class="d-flex justify-between">
            <div class="mr-10">
                <div class="form-group">
                    <label>ตำแหน่งเมนู</label>
                    <select name="menu_position" class="selectpicker">
                        <option value="top_menu">Top Menu</option>
                        <option value="footer_menu">Footer Menu</option>
                    </select>
                </div>
            </div>
            <div class="mr-10">
                <div class="form-group">
                    <label>เมนูหลัก</label>
                    <select name="main_menu_id" class="selectpicker">
                        <option value="">ทั้งหมด</option>
                        <option v-for="(item, index) in menus" v-bind:value="item.id">@{{ item.title_th }}</option>
                    </select>
                </div>
            </div>
            <div class="mr-10">
                <div class="form-group">
                    <label>ค้นหาจากชื่อเมนู</label>
                    <div class="input-icon ">
                        <i class="fa fa-search"></i>
                        <input type="search" class="form-control input-search" placeholder="ค้นหา...">
                    </div>
                </div>
            </div>
            <div class="flex-grow"> </div>
            <div>
                <a href="{{ url('admin/menus/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มเมนู
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-menu">
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อเมนู</th>
                    <th>ประเภท</th>
                    <th style="width: 150px;">หน้า / URL</th>
                    <th>เมนูหลัก</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/menu.min.js') }}"></script>
@endsection