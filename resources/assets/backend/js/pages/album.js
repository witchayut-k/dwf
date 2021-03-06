var Album = function () {

    var moduleUrl = appUrl + '/admin/albums';
    var albumId = $('[name="id"]').val();

    var galleryApp = new Vue({
        el: '.gallery-app',
        data: {
            gallery: {
                processing: true,
                items: []
            },
        },
    });

    var initDatatable = function () {
        datatable = $('#table-album').DataTable({
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
                { data: 'title' },
                {
                    data: 'featured_image',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return `<img src="${data}" style="width: 118px; height: 60px;" />`;
                    }
                },
                {
                    data: 'created_at',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    data: 'view_count',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return data;
                    }
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

    /**
     * Form Section
     */

    var initGalleryImages = function () {
        $.ajax({
            url: `${moduleUrl}/${albumId}/gallery`,
            type: 'GET',
            success: function (resp) {
                galleryApp.gallery.items = resp;
                galleryApp.gallery.processing = false;
            },
            error: function (resp) {
                console.error(resp);
            }
        });
    };

    var initGallery = function () {

        initGalleryImages();

        var galleryImage = $(".btn-add-gallery");

        galleryImage.dropzone({
            url: `${moduleUrl}/${albumId}/uploads/gallery`,
            autoProcessQueue: false,
            uploadMultiple: true,
            // maxFiles: 10,
            maxFilesize: 12288,
            dictRemoveFile: '??????',
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            previewsContainer: '#gallery-preview',
            // previewTemplate: '<div class="gallery-preview"></div>',
            // maxfilesexceeded: function (file) {
            //     this.removeAllFiles();
            //     this.addFile(file);
            // },
            headers: {
                'X-CSRF-TOKEN': token
            },
            init: function () {
                galleryImage = this;
                this.on("addedfile", function (file) {
                    $('#gallery-preview').slideDown();
                });
                this.on("thumbnail", function (file) {
                    setTimeout(() => {
                        this.processFile(file)
                    }, 500);
                    // if (file.accepted && file.size / 1024 <= 12288) {
                    //     // console.log('galleryImage', galleryImage);
                    //     // galleryImage.css('background-image', 'url(' + file.dataURL + ')');
                    //     // galleryImage.addClass('preview');
                    // } else {
                    //     alert('????????????????????????????????????????????????????????????????????????????????????????????????????????? 12MB ?????????')
                    // }
                });
                this.on('error', function (file, resp) {
                    App.error(resp.message);
                });
                this.on("sending", function (file, xhr, formData) {
                    formData.append("id", albumId);
                });
                this.on("queuecomplete", function (file) {
                    // App.toastrSuccess("????????????????????????????????????????????? ??????????????????????????????????????????????????????");
                    initGalleryImages();
                    this.removeAllFiles();
                    $('#gallery-preview').slideUp();
                });
            }
        });

    };

    var handleDeleteGalleryImage = function () {
        $('body').on('click', '.btn-delete-item', function () {
            galleryApp.gallery.processing = true;

            $.ajax({
                url: `${moduleUrl}/${albumId}/gallery`,
                type: 'delete',
                data: {
                    id: $(this).attr('data-id')
                },
                success: function (resp) {
                    initGalleryImages();
                },
                error: function () {
                    alert('Error occured, please contact administrator');
                }
            });
        });
    };

    var handleSubmit = function () {
        var $form = $('#form-album');
        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                // $('<input />').attr('type', 'hidden').attr('name', 'content_type_id').attr('value', searchData.content_type_id).appendTo($form);
                // $('<input />').attr('type', 'hidden').attr('name', 'content_type_id').attr('value', searchData.parent_type_id).appendTo($form);
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


    return {
        init: function () {
            if ($('#table-album').length) {
                initDatatable();
            }

            if ($('#form-album').length) {
                customSubmit = true;
                // initFeaturedImage();
                initGallery();
                handleDeleteGalleryImage();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Album.init();
});
