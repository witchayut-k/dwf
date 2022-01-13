@extends('backend.layouts.preview')

@section('content')

<div class="faq-image">
    <img src="{{ $faq->featured_image }}" alt="{{ $faq->title }}" style="width: 726px; height: 176px;" />
</div>

<br /><br />

<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 200px">หัวข้อ</td>
            <td>{{ $faq->title }}</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>{{ $faq->url }}</td>
        </tr>
        <tr>
            <td>ขนาดไฟล์</td>
            <td>{{ $faq->featured_image_size }}</td>
        </tr>
        <tr>
            <td>สถานะการแสดงผล</td>
            <td>{!! $faq->published ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-grey">ปิดใช้งาน</span>' !!}</td>
        </tr>
    </tbody>
</table>

@endsection