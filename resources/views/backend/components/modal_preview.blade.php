<div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1024px; margin-top: 20px;">

        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">แสดงตัวอย่าง</h2>
                <a href="javascript:;" class="btn-close-dialog" title="Close" data-dismiss="modal"></a>
            </div>

            <div class="modal-body">
                <div class="scroll-wrapper" style="width:100%;height:calc(100vh - 200px);">
                    <iframe id="preview-frame" name="preview-frame" frameborder="0"
                        style="border:1px solid #cccccc; border-radius:2px; width:100%; height:100%;">
                        <p>It appears your web browser does not support iframes.</p>
                    </iframe>
                </div>
                <iframe id="toprint" width="100%" height="50%" frameborder="0" style="display: none;"></iframe>
                <div class="loader"
                    style="text-align: center; position: absolute; top: 50%; margin: auto; width: 100%; padding-right: 100px; display: none;">
                    <img src="{{ asset('backend/img/loading.gif') }}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-dismiss" data-dismiss="modal">ปิด</button>
            </div>

        </div>

    </div>
</div>
