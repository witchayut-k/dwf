@extends('backend.layouts.app', ['title' => 'RSS Feed'])

@section('content')

<h1>RSS Feed</h1>

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
        <table class="table table-bordered table-striped" id="table-feed">
            <thead>
                <tr>
                    <th style="width: 30px;">ลำดับ</th>
                    <th>หัวข้อ</th>
                    <th style="width: 128px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>                            
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/feed.min.js') }}"></script>
@endsection