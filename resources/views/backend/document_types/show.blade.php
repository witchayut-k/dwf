@extends('backend.layouts.preview')

@section('content')

<div class="documentType-image">
    <img src="{{ $documentType->featured_image }}" alt="{{ $documentType->title }}" style="width: 726px; height: 176px;" />
</div>

<br /><br />

<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 200px">หัวข้อ</td>
            <td>{{ $documentType->title }}</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>{{ $documentType->url }}</td>
        </tr>
        <tr>
            <td>ขนาดไฟล์</td>
            <td>{{ $documentType->featured_image_size }}</td>
        </tr>
        <tr>
            <td>สถานะการแสดงผล</td>
            <td>{!! $documentType->published ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-grey">ปิดใช้งาน</span>' !!}</td>
        </tr>
    </tbody>
</table>

@endsection