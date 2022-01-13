@extends('backend.layouts.app', ['title' => 'ระบบปฏิทินกิจกรรม'])

@section('content')

<h1>ระบบปฏิทินกิจกรรม</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>ระบบปฏิทินกิจกรรม</h2>
            <p><i class="fa fa-home"></i> - ระบบปฏิทินกิจกรรม - {{ empty($event->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/events/$event->id"), 'id' => 'form-event', 'class'=>'form', 'files'=>true, 'redirect-url'=>route('events.index')]) }}
        @method($event->id ? 'PUT' : 'POST')
        
        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อกิจกรรม', $event->title, ['required'=>'required']) !!}
            {!! Form::groupSummernoteEditor('content', 'รายละเอียด', $event->content) !!}

            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>วันเริ่มต้น</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" name="begin_date" class="form-control bs-datepicker" value="{{ $event->begin_date ? $event->begin_date->format('d/m/Y') : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>วันสิ้นสุด</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" name="end_date" class="form-control bs-datepicker" value="{{ $event->end_date ? $event->end_date->format('d/m/Y') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>เลือกสี</label>
                @foreach (Config::get('colors') as $key => $color)
                <div class="radio-color"> 
                    <label>
                        <input type="radio" name="color" id="color-{{ $key }}" value="{{ $color }}" {{ $event->color == $color ? 'checked' : '' }}>  
                        <span class="color" style="background-color: {{ $color }}" for="color-{{ $key }}">{{ $color }}</span>
                    </label> 
                </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $event->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/events') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/summernote-editor.min.js') }}"></script>
<script src="{{ mix('backend/js/pages/event.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\EventRequest', '#form-event') !!}

@endsection