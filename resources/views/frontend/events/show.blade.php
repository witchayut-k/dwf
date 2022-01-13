<h5 class="modal-title c-pink text-center pb-2" id="calendarEventTitle">รายละเอียด</h5>

<div class="py-3">
   <h6 class="c-gray font-medium pb-2">ชื่อกิจกรรม :</h6>
   <p class="c-gray">{{ $event->title }}</p>
</div>
<div class="py-3">
    <h6 class="c-gray font-medium pb-2">รายละเอียดกิจกรรม :</h6>
    <p class="c-gray">{!! $event->content !!}</p>
</div>
<div class="py-3">
    <h6 class="c-gray font-medium pb-2">ระยะเวลากิจกรรม :</h6>
    <p class="c-gray">{{ DateHelper::renderDateRange($event->begin_date, $event->end_date) }}</p>
</div>