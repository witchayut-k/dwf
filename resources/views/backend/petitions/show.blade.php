@extends('backend.layouts.preview')

@section('content')

<div class="petition-image">
    <img src="{{ $petition->featured_image }}" alt="{{ $petition->title }}" style="width: 726px; height: 176px;" />
</div>

<br /><br />

<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 200px">หัวข้อ</td>
            <td>{{ $petition->title }}</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>{{ $petition->url }}</td>
        </tr>
        <tr>
            <td>ขนาดไฟล์</td>
            <td>{{ $petition->featured_image_size }}</td>
        </tr>
        <tr>
            <td>สถานะการแสดงผล</td>
            <td>{!! $petition->published ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-grey">ปิดใช้งาน</span>' !!}</td>
        </tr>
    </tbody>
</table>

@endsection