var GalleryApp = function () {

    var moduleName = $('.gallery-app').data('module');
    var moduleUrl = $('.gallery-app').data('module-url');
    var modelID = $('.gallery-app').data('id');

    var galleryApp = new Vue({
        el: '.gallery-app',
        data: {
            item: {
                id: null,
                name: '',
                imageUrl: ''
            },
            gallery: {
                processing: true,
                items: []
            },
        },
    });

    var initGalleryImages = function () {
        $.ajax({
            url: appUrl + '/api/gallery/' + moduleName + '/' + modelID,
            type: 'GET',
            success: function (resp) {
                galleryApp.gallery.items = resp;
                galleryApp.gallery.processing = false;

                setTimeout(() => {
                    $.fancybox.defaults.btnTpl.delete = '<button data-fancybox-delete class="fancybox-button fancybox-button--delete" title="ลบภาพนี้" >' +
                        '<img src="/img/trash.png" class="roundbutton" alt="ลบ" title="ลบ" height="22">' +
                        '</button>';

                    $('[data-fancybox]').fancybox({
                        buttons: [
                            'delete',
                            'close'
                        ],
                        iframe: {
                            preload: true
                        },
                        afterShow: function (instance, slide) {
                            var id = slide.opts.$orig.attr('data-id');
                            var featuredImage = slide.opts.$orig.attr('data-featured-image');
                            var $stage = slide.$slide.parent('.fancybox-stage');
                            $stage.attr('data-id', id);
                            $stage.attr('data-featured-image', featuredImage);
                        }
                    });

                    $('.tooltips').tooltip();

                }, 500);
            },
            error: function (resp) {
                console.error(resp);
            }
        });
    };

    var initGallery = function () {

        if (!$(".btn-add-gallery").length) return;

        initGalleryImages();

        $('body').on('click', '[data-fancybox-delete]', function () {
            var $parent = $(this).parent().siblings('.fancybox-stage');
            var id = $parent.attr('data-id');
            var isFeaturedImage = $parent.attr('data-featured-image');

            var deleteFn = function () {
                $.ajax({
                    url: appUrl + '/api/gallery/' + id,
                    type: 'delete',
                    success: function (resp) {
                        App.toastrSuccess('ดำเนินการลบรูปภาพเรียบร้อยแล้ว');

                        if (isFeaturedImage) {
                            $('.featured > .btn-add-featured').show();
                            $('.featured > div').hide();
                            $.fancybox.close(true);
                        } else {
                            initGalleryImages();
                            setTimeout(() => {
                                $.fancybox.close(true);
                            }, 300);
                        }
                    },
                    error: function (resp) {
                        console.error(resp);
                    }
                });
            };

            App.confirm('ต้องการลบภาพนี้ใช่หรือไม่?', deleteFn);

        });

        var galleryImage = $(".btn-add-gallery");

        galleryImage.dropzone({
            url: moduleUrl + '/uploads/gallery',
            autoProcessQueue: false,
            uploadMultiple: true,
            // maxFiles: 10,
            maxFilesize: 12288,
            dictRemoveFile: 'ลบ',
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
                    //     alert('ไม่สามารถอัพโหลดรูปภาพที่มีขนาดเกิน 12MB ได้')
                    // }
                });
                this.on('error', function (file, resp) {
                    App.error(resp.message);
                });
                this.on("sending", function (file, xhr, formData) {
                    formData.append("id", modelID);
                });
                this.on("queuecomplete", function (file) {
                    App.toastrSuccess("อัพโหลดภาพอื่นๆ เสร็จเรียบร้อยแล้ว");
                    initGalleryImages();
                    this.removeAllFiles();
                    $('#gallery-preview').slideUp();
                });
            }
        });

    };

    return {
        init: function () {
            initGallery();
        }
    }
}();


$(document).ready(function () {
    GalleryApp.init();
});

