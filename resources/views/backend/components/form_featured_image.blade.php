<div class="form-group">
    <label for="" class="control-label">@isset($label) {{ $label }} @else รูปภาพ @endisset</label>
    <div class="file-input">
        <input type="file" class="file" name="file" accept="image/*" />
        @if ($model->has_featured_image)
        <span class="file-input-name">{{ $model->featured_image_name }} ({{ $model->featured_image_size }})</span>
        @endif
    </div>
    <span class="help-block">@isset($help) {{ $help }} @else *รองรับไฟล์ JPG, PNG, GIF @endisset</span>
    <img src="{{ $model->featured_image_resized }}" alt="preview" class="preview-image" />


    <div class="img-action" style="margin-top: 10px; display: {{ $model->has_featured_image ? 'block' : 'none' }}">
        <button type="button" data-id="{{ $model->image_id }}" class="btn btn-xs btn-danger btn-delete-image">ลบรูปภาพ</button>
    </div>

</div>