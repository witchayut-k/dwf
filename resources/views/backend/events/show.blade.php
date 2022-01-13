@extends('backend.layouts.preview')

@section('content')

<table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 200px">ชื่อกิจกรรม</td>
            <td>{{ $event->title }}</td>
        </tr>
        <tr>
            <td>รายละเอียด</td>
            <td>{!! $event->content !!}</td>
        </tr>
        <tr>
            <td>วันที่จัดกิจกรรม</td>
            <td>{{ $event->begin_date->format('d/m/Y')." - ".$event->end_date->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>สถานะการแสดงผล</td>
            <td>{!! $event->published ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-grey">ปิดใช้งาน</span>' !!}</td>
        </tr>
    </tbody>
</table>

@endsection