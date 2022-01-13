@extends('backend.layouts.app', ['title' => 'ระบบติดต่อสอบถาม'])

@section('content')

<h1>ระบบติดต่อสอบถาม</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>การติดต่อจากหน้าเว็บ</h2>
            <p><i class="fa fa-home"></i> - ระบบติดต่อสอบถาม</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/messages/$message->id"), 'id' => 'form-message', 'class'=>'form', 'files'=>true, 'redirect-url'=>route('messages.index')]) }}
        {{-- @method($message->id ? 'PUT' : 'POST') --}}
        
        <div class="form-body">
            {!! Form::groupText('subject', 'เรื่อง', $message->subject, ['readonly']) !!}
            {!! Form::groupText('department', 'หน่วยงาน', $message->department, ['readonly']) !!}
            {!! Form::groupText('created_at', 'เวลาที่ส่ง', $message->created_at->addYear(543)->translatedFormat('j F Y - H:i น.'), ['readonly']) !!}
            {!! Form::groupText('sender_name', 'ชื่อผู้ส่ง', $message->sender_name, ['readonly']) !!}
            {!! Form::groupText('sender_email', 'อีเมลผู้ส่ง', $message->sender_email, ['readonly']) !!}
            {!! Form::groupText('sender_tel', 'เบอรืโทรผู้ส่ง', $message->sender_tel, ['readonly']) !!}
            {!! Form::groupTextArea('note', 'ข้อความ', $message->note, ['readonly']) !!}
           
        </div>
        <div class="form-action">
            <a href="{{ url('admin/messages') }}" class="btn btn-default">ยกเลิก</a>
            {{-- <button type="submit" class="btn btn-submit">บันทึก</button> --}}
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection