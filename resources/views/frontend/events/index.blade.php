@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white">
    <div class="container">

        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ปฏิทินกิจกรรม</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">ปฏิทินกิจกรรม</h1>
            </div>
            <div class="col-12">
                <div class="calendar-custom mt-3">
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal Calendar Event -->
<div class="modal modal-custom modal-calendar fade" id="calendarEventModal" tabindex="-1" role="dialog" aria-labelledby="calendarEventTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="content"></div>
                <button type="button" class="btn btn-pink w-100 mt-3" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ mix('js/fullcalendar.min.js') }}"></script>
<script src="{{ mix('js/pages/calendar.min.js') }}"></script>
@endsection