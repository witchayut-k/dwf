<div class="modal fade " id="modal-simple-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content" >
            {{ Form::open(['url'=>$action, 'id'=>$id, 'redirect-url'=>$redirectUrl]) }}
            @method("POST")
            <div class="modal-header">
                <h3 class="modal-title"> เพิ่ม{{ $title }}</h3>
            </div>

            <div class="modal-body">

                <div class="form-body" style="padding: 10px;">

                    @if (isset($contentTypes))
                    <div class="form-group">
                        <label for="tribe_id" class="control-label">หมวดหมู่เนื้อหา</label>
                        <select name="content_type_id" id="content-type-id" class="selectpicker" data-subtext="true" data-live-search="true">
                            @foreach ($contentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    {!! Form::groupText('title', 'ชื่อเรื่อง', NULL, ['required']) !!}

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-dismiss" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
            {{ Form::close() }}
        </div>

    </div>
</div>
