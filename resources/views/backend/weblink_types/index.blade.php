@extends('backend.layouts.app', ['title' => 'Link Management'])

@section('content')

<h1>{{ $weblinkType->title }}</h1>

{{ Form::hidden('id', $weblinkType->id) }}

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
                <a href="{{ url("admin/weblink-types/$weblinkType->id/create") }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มหมวดหมู่ย่อย
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-weblink-type">
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่อหมวดหมู่ย่อย</th>
                    <th>สถานะ</th>
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