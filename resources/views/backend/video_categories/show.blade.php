@extends('backend.layouts.preview')

@section('content')

<div class="video-category-image">
    <img src="{{ $videoCategory->featured_image }}" alt="{{ $videoCategory->title }}" style="width: 726px; height: 176px;" />
</div>

<br /><br />

<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 200px">หัวข้อ</td>
            <td>{{ $videoCategory->title }}</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>{{ $videoCategory->url }}</td>
        </tr>
        <tr>
            <td>ขนาดไฟล์</td>
            <td>{{ $videoCategory->featured_image_size }}</td>
        </tr>
        <tr>
            <td>สถานะการแสดงผล</td>
            <td>{!! $videoCategory->published ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-grey">ปิดใช้งาน</span>' !!}</td>
        </tr>
    </tbody>
</table>

@endsection