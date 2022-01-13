var Froala = function () {

    const uploadURL = `${appUrl}/api/media/uploads/rte`;

    var initTextEditor = function () {

        var getOptions = function (clickInit) {
            var options = {
                initOnClick: clickInit,
                maxCharacters: 190,
                toolbarButtons: [
                    ['bold', 'italic', 'underline', 'subscript', 'superscript'],
                    ['textColor', 'backgroundColor'],
                    ['clearFormatting']
                ],
                enter: FroalaEditor.ENTER_BR,
                multiLine: false,
                // quickInsertButtons: ['image', 'video', 'table', 'ul', 'ol', 'hr'],

                requestHeaders: {
                    'X-CSRF-TOKEN': token
                },
                events: {
                    contentChanged: function () {
                        // var content = this.html.get();
                        // var creditPosition = content.indexOf('<p data-f-id="pbf"');
                        // content = content.substr(0, creditPosition);
                        this.$el.parents('.form-group').find('textarea').html(this.html.get());
                    },
                    focus: function () {
                        this.$el.closest('.fr-wrapper').addClass('active');
                        this.$el.closest('.form-group').addClass('active');
                    },
                },
            };

            return options;
        };

        var editor = new FroalaEditor('div.fr-editor', getOptions(true));

        $('div.fr-editor').on('click', function (e) {
            var editorID = $(this).attr('id');
            if (!editor) {
                editor = new FroalaEditor('#' + editorID, getOptions(false), function () {
                    this.events.focus();
                });
            }
        });
    };

    var initTextAreaEditor = function () {

        var getOptions = function () {
            var options = {
                initOnClick: false,
                placeholderText: 'ยังไม่มีข้อมูล',
                // toolbarVisibleWithoutSelection: true,
                toolbarSticky: true,
                toolbarButtons: {
                    moreText: {
                        buttons: ['bold', 'italic', 'underline', 'subscript', 'superscript', 'clearFormatting'],
                        buttonsVisible: 6
                    },
                    moreParagraph: {
                        buttons: ['alignLeft', 'alignCenter', 'alignRight', 'formatOL', 'formatUL', 'paragraphFormat', 'indent', 'outdent', 'quote']
                    },
                    moreRich: {
                        buttons: ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'insertFile', 'insertHR'],
                        buttonsVisible: 4
                    },
                    moreMisc: {
                        buttons: ['undo', 'redo', 'fullscreen', 'print', 'selectAll', 'html', 'help'],
                        align: 'right',
                        buttonsVisible: 2
                    } 
                },
                enter: FroalaEditor.ENTER_P,

                imageDefaultWidth: 480,
                imageAddNewLine: true,
                imagePasteProcess: true,
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
                imageResizeWithPercent: false,
                imageStyles: {
                    'fr-rounded': 'Rounded',
                    'fr-bordered': 'Bordered'
                },
                // imageSplitHTML: true,

                imageManagerDeleteURL: `${appUrl}/admin/medias`,
                imageManagerDeleteMethod: 'DELETE',
                imageManagerLoadURL: `${appUrl}/admin/medias`,
                // imageManagerDeleteParams: { id: 4219762 },

                videoResponsive: false,
                videoDefaultWidth: 200,
                videoAllowedProviders: ['youtube', 'vimeo'],
                videoInsertButtons: ['videoBack', '|', 'videoByURL'],
                videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign', 'videoSize'],
                videoSizeButtons: ['videoBack'],
                videoResize: true,
                videoUpload: false,

                quickInsertButtons: ['image', 'video', 'table', 'ul', 'ol', 'hr'],

                linkText: true,
                paragraphFormat: {
                    N: 'Normal',
                    H2: 'Heading 2',
                    H3: 'Heading 3',
                },
                paragraphFormatSelection: true,

                imageUploadURL: uploadURL,
                // imageUploadParams: {
                //     id: contentID
                // },
                requestHeaders: {
                    'X-CSRF-TOKEN': token
                },
                events: {
                    initialized: function () {
                        // const editor = this;
                        //document.getElementById('preview').innerHTML = editor.html.get();
                        // $('.fr-wrapper > div').not(".fr-view").remove(); 
                        // $('.fr-wrapper').prepend('<div class="fr-cheat"></div>');
                    },
                    initializationDelayed: function () {

                    },
                    contentChanged: function () {
                        //const editor = this;
                        // var content = this.html.get();
                        // var creditPosition = content.indexOf('<p data-f-id="pbf"');
                        // content = content.substr(0, creditPosition);
                        this.$el.parents('.form-group').find('textarea').html(this.html.get());
                        
                    },
                    blur: function () {
                        // this.$el.find('.fr-wrapper').removeClass('active');
                        // this.$el.parents('.form-group').find('textarea').html(this.html.get());
                        // this.destroy();
                        // editor = null;
                    },
                    focus: function () {
                        this.$el.closest('.fr-wrapper').addClass('active');
                        this.$el.closest('.form-group').addClass('active');
                    },
                },
            };

            return options;
        }

        var editor = new FroalaEditor('div.fr-textarea-editor', getOptions());

        $('div.fr-textarea-editor').on('click', function (e) {
            var editorID = $(this).attr('id');
            if (!editor) {
                editor = new FroalaEditor('#' + editorID, getOptions(), function () {
                    this.events.focus();
                });
            }
        });

    };

    var handleLicenseDetect = function () {
        $('body').on('DOMNodeInserted', '.fr-wrapper > div:not(.fr-view):not(.fr-image-resizer)', function () {
            $('.fr-wrapper').find('.fr-cheat').css('position', 'absolute');
        });
    };

    var handleStickyToolbarPosition = function () {
        // if ($('.page-actions').length) {
        //     $('.fr-sticky-on').css('margin-top', '51px');
        // }
    };

    return {
        init: function () {
            initTextEditor();
            initTextAreaEditor();
            //initPreview();

            handleLicenseDetect();
            handleStickyToolbarPosition();
        }
    }

}();

$(document).ready(function () {
    Froala.init();
});