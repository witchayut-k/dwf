@extends('backend.layouts.preview')

@section('content')

<div class="user-image">
    <img src="{{ $user->featured_image }}" alt="{{ $user->title }}" style="width: 726px; height: 176px;" />
</div>

<br /><br />

<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 200px">หัวข้อ</td>
            <td>{{ $user->title }}</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>{{ $user->url }}</td>
        </tr>
        <tr>
            <td>ขนาดไฟล์</td>
            <td>{{ $user->featured_image_size }}</td>
        </tr>
        <tr>
            <td>สถานะการแสดงผล</td>
            <td>{!! $user->published ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-grey">ปิดใช้งาน</span>' !!}</td>
        </tr>
    </tbody>
</table>

@endsection