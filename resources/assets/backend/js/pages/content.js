var Content = function () {

    var moduleUrl = appUrl + '/admin/contents';
    var contentId = $('[name="id"]').val();;

    var regionalContentId = $('#regional_content_id').data('id');

    var contentApp = new Vue({
        el: '.content-app',
        data: {
            files: {
                items: [],
                processing: false
            },
        },
    });

    var initDatatable = function () {
        datatable = $('#table-content').DataTable({
            rowReorder: {
                update: false
            },
            bSort: false,
            ajax: {
                url: moduleUrl,
                data: function (d) {
                    return $.extend(d, searchData);
                },
                method: 'GET'
            },

            columns: [
                {
                    data: 'DT_RowIndex', sClass: 'text-center'
                },
                {
                    data: 'title',
                    render: function (data, type, row) {
                        let content = row.pinned ? data + ' <i class="fa fa-thumb-tack text-danger tooltips" title="เนื้อหาปักหมุด"></i>' : data;
                        return content;
                    }
                },
                {
                    data: 'featured_image',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return `<img src="${data}" style="width: 118px; height: auto;" />`;
                    }
                },
                {
                    data: 'type_name',
                    sClass: 'text-center',
                },
                {
                    data: 'published', sClass: 'text-center',
                    render: function (data, type, row) {
                        const checked = data ? 'checked' : '';
                        return `<label class="switch"><input type="checkbox" name="status" data-module-url="${moduleUrl}" data-id="${row.id}" ${checked} /></label>`;
                    }
                },
                {
                    data: 'id', sClass: 'text-center',
                    render: function (data, type, row) {
                        var actions = App.renderTableActionsWithPreview(moduleUrl, row.id, row.title);
                        return actions;
                    }
                },
            ],
            columnDefs: [].concat($.fn.dataTable.defaults.columnDefs),
        }).on('draw', function () {
            app_plugins.switch_button();
            $('.tooltips').tooltip();
        });

    };

    var handleFilter = function () {
        $('[name="content_type_id"]').on('change', function () {
            searchData.content_type_id = $(this).val();
            datatable.draw();
        });
    }

    /**
     * Form Section
     */

    var handleContentTypeChange = function () {
        $('[name="content_type_id"]').on('change', function () {
            if ($(this).val() == regionalContentId) {
                $('.center-container').show();
            } else {
                $('.center-container').hide();
            }
        });
    }

    var initFiles = function () {
        if (!contentId) return;
        $.ajax({
            url: `${appUrl}/api/backend/contents/${contentId}/files`,
            type: 'GET',
            success: function (resp) {
                contentApp.files.items = resp;
                contentApp.files.processing = false;
            },
            error: function (resp) {
                console.error(resp);
            }
        });
    };

    var initFilesUpload = function () {

        initFiles();

        var dzFiles = $(".btn-add-files");

        dzFiles.dropzone({
            url: `${moduleUrl}/${contentId}/uploads/files`,
            autoProcessQueue: true,
            uploadMultiple: true,
            // maxFiles: 10,
            // maxFilesize: 12288,
            dictRemoveFile: 'ลบ',
            // acceptedFiles: ".jpeg,.jpg,.png,.gif",
            previewsContainer: '#files-preview',
            // previewTemplate: '<div class="files-preview"></div>',
            // maxfilesexceeded: function (file) {
            //     this.removeAllFiles();
            //     this.addFile(file);
            // },
            headers: {
                'X-CSRF-TOKEN': token
            },
            init: function () {
                dzFiles = this;
                this.on("addedfile", function (file) {
                    $('#files-preview').slideDown();
                });
                this.on("thumbnail", function (file) {
                    // setTimeout(() => {
                    //     this.processFile(file)
                    // }, 500);
                    // if (file.accepted && file.size / 1024 <= 12288) {
                    //     // console.log('filesImage', filesImage);
                    //     // filesImage.css('background-image', 'url(' + file.dataURL + ')');
                    //     // filesImage.addClass('preview');
                    // } else {
                    //     alert('ไม่สามารถอัพโหลดรูปภาพที่มีขนาดเกิน 12MB ได้')
                    // }
                });
                this.on('error', function (file, resp) {
                    App.error(resp.message);
                });
                this.on("sending", function (file, xhr, formData) {
                    formData.append("id", contentId);
                });
                this.on("queuecomplete", function (file) {
                    // App.toastrSuccess("อัพโหลดภาพอื่นๆ เสร็จเรียบร้อยแล้ว");
                    initFiles();
                    this.removeAllFiles();
                    $('#files-preview').slideUp();
                });
            }
        });

    };

    var handleDeleteFiles = function () {
        $('body').on('click', '.btn-delete-item', function () {
            contentApp.files.processing = true;

            $.ajax({
                url: `${moduleUrl}/${contentId}/files`,
                type: 'delete',
                data: {
                    id: $(this).attr('data-id')
                },
                success: function (resp) {
                    initFiles();
                },
                error: function () {
                    alert('Error occured, please contact administrator');
                }
            });
        });
    };

    var handleSubmit = function () {
        var $form = $('#form-content');
        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                $('<input />').attr('type', 'hidden').attr('name', 'published').attr('value', $('[name="published"]').is(':checked')).appendTo($form);
                $('<input />').attr('type', 'hidden').attr('name', 'pinned').attr('value', $('[name="pinned"]').is(':checked')).appendTo($form);
            },
            beforeSubmit: function (arr, $form, options) {
                $inputs.prop("disabled", true);
            },
            success: function (resp) {
                if (submitMethod == 'PUT') {
                    App.showSuccess(resp);
                    setTimeout(function () {
                        $inputs.prop("disabled", false);
                        // if (redirectUrl)
                        //     window.location.href = redirectUrl;
                    }, 500);
                } else {

                    App.showSuccess(resp);

                    var pathArray = location.pathname.split('/');

                    if (redirectUrl) {

                        if (redirectUrl.indexOf('{id}') != -1)
                            redirectUrl = redirectUrl.replace('{id}', resp.id);

                        setTimeout(() => {
                            window.location.href = (redirectUrl || pathArray[1] || '');
                        }, 500);

                    }
                }
            },
            error: function (res) {
                $inputs.prop("disabled", false);
                var errors = res.responseJSON;
                if (res.status === 422) {
                    App.showFormErrors(errors, $form);
                }
            }
        });
    };

    // var handleFileUpload = function () {
    //     $('.btn-delete-file').on('click', function () {
    //         var $form = $('#form-content');
    //         // $form.append()''
    //     });
    // }

    return {
        init: function () {
            if ($('#table-content').length) {
                handleFilter();
                initDatatable();
            }

            if ($('#form-content').length) {
                customSubmit = true;
                // handleFileUpload();
                initFilesUpload();
                handleDeleteFiles();
                handleSubmit();
                handleContentTypeChange();
            }
        }
    }
}();

$(function () {
    Content.init();
});
