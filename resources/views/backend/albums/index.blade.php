@extends('backend.layouts.app', ['title' => 'ระบบคลังภาพ'])

@section('content')

<h1>ระบบคลังภาพ</h1>

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
                {{-- <a href="{{ url('admin/albums/create') }}" class="btn btn-create">
                    <i class="fa fa-plus"></i> เพิ่มอัลบั้ม
                </a> --}}
                <a href="#modal-simple-create" class="btn btn-create" data-toggle="modal" data-animation="effect-scale">
                    <i class="fa fa-plus"></i> เพิ่มอัลบั้ม 
                </a>
            </div>
        </div>
    </div>

    <div class="block-content">
        <table class="table table-bordered table-striped" id="table-album">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>ชื่ออัลบั้ม</th>
                    <th>ภาพปก</th>
                    <th>วันที่สร้าง</th>
                    <th>View</th>
                    <th>สถานะ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>

@include('backend.components.modal_simple_create_form', [
    'action' => url('admin/albums'),
    'id' => 'form-album',
    'title' => 'คลังภาพ',
    'redirectUrl' => url('admin/albums/{id}/edit')
])

@endsection

@section('scripts')

<script src="{{ mix('backend/js/pages/album.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\AlbumRequest', '#form-album') !!}
@endsection