// require('./bootstrap');

const serverTime = $('meta[name="server-time"]').attr('content');
const appUrl = $('meta[name="site-url"]').attr('content');
const token = $('meta[name="csrf-token"]').attr('content');
const pluck = key => array => Array.from(new Set(array.map(obj => obj[key])));
const getID = pluck('id');
const getChemicalID = pluck('chemical_id');

var dropzone = false;
var customSubmit = false;
var translateApp;
var datatable;
var searchData = {};
var moduleUrl;

var App = function () {
    var debug = true;
    var autonumericFields = [];
    var handleDeleteButton = function () {
        $('body').on('click', 'a.btn-delete', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var actionUrl = $(this).attr('data-action-url');
            var redirectUrl = $(this).attr('data-redirect-url');
            var table = $(this).parents('table');

            var deleteAction = function () {
                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: { _method: 'delete', _token: token },
                    success: function (resp) {
                        if ($.fn.DataTable.isDataTable(table)) {
                            $('.dataTables_processing', table.closest('.dataTables_wrapper')).show();
                            setTimeout(function () {
                                table.dataTable();
                                table.api().ajax.reload();
                                $('.dataTables_processing', table.closest('.dataTables_wrapper')).hide();
                                setTimeout(function () {
                                    App.showSuccess(resp);
                                    if ($('.calendar').length)
                                        window.location.reload();

                                }, 300);
                            }, 100);
                        } else {
                            if (redirectUrl) {
                                window.open(redirectUrl, '_self');
                            } else {
                                window.location.reload();
                            }
                        }
                    },
                    error: function (resp) {

                        var result = resp.responseJSON;

                        if (resp.status == 422) {
                            App.showDeleteDependency(result);
                        } else {
                            if (result.message == 'This action is unauthorized.') {
                                App.show403();
                            } else {
                                App.alert(result.message);
                            }
                        }

                    }
                });
            }

            App.confirm('ต้องการลบ <b>' + name + '</b> ใช่หรือไม่?', deleteAction)
        });
    };

    var handleDeleteImage = function () {
        $('body').on('click', '.btn-delete-image', function (e) {
            const id = $(e.target).data('id');
            $(e.target).prop('disabled', true);
            $(e.target).append(' <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: `${appUrl}/api/backend/medias/${id}`,
                type: 'delete',
                success: function (resp) {
                    $(e.target).prop('disabled', false);
                    const text = $(e.target).text();
                    $(e.target).text(text.replace(' <i class="fa fa-spinner fa-spin"></i>', ''));
                    window.location.reload();
                },
                error: function () {
                    alert('Error occured, please contact administrator');
                }
            });

        })
    }

    var handleTabs = function () {
        //activate tab if tab id provided in the URL
        if (encodeURI(location.hash)) {
            var tabid = encodeURI(location.hash.substr(1));
            if ($('a[href="#' + tabid + '"]').length) {
                $('a[href="#' + tabid + '"]').parents('.tab-pane:hidden').each(function () {
                    var tabid = $(this).attr("id");
                    $('a[href="#' + tabid + '"]').click();
                });
                $('a[href="#' + tabid + '"]').click();
            } else {
                var li = $('ul.nav.nav-tabs').find('li')[0];
                if (li) {
                    $(li).addClass('active');
                }

                var firstTab = $('.tab-content > .tab-pane').first();
                if (firstTab.length) {
                    firstTab.addClass('active in');
                }
            }
        }

        if ($().tabdrop) {
            $('.tabbable-tabdrop .nav-pills, .tabbable-tabdrop .nav-tabs').tabdrop({
                text: '<i class="fa fa-ellipsis-v"></i>&nbsp;<i class="fa fa-angle-down"></i>'
            });
        }

        $('body').on('click', 'a[data-toggle="tab"]', function () {
            if ($(this).data('hash') != false)
                window.location.hash = $(this).attr('href');

            setTimeout(function () {
                $(window).resize();
            }, 100);
        });
    };

    var handleSelectTwo = function () {
        if (jQuery.fn.select2) {
            $('.select2').select2({
                placeholder: $(this).attr('placeholder') || 'Search..',
                // theme: "bootstrap",
                allowClear: false,
                selectOnClose: true
            });
        }
    };

    var handleBootstrapSelect = function () {
        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check',
            placeholder: $(this).attr('placeholder')
        });
    }

    var handleAutoNumeric = function () {
        if (typeof AutoNumeric !== undefined) {
            $('.autonumeric-integer').each(function () {
                var autonumeric = new AutoNumeric(this, {
                    minimumValue: 0,
                    maximumValue: 999999999,
                    decimalPlaces: 0,
                    allowDecimalPadding: false,
                    modifyValueOnWheel: false,
                    unformatOnSubmit: true,
                });
                autonumericFields.push(autonumeric);
            });
            $('.autonumeric').each(function () {
                var autonumeric = new AutoNumeric(this, {
                    // minimumValue: -9999999999999,
                    // maximumValue: 9999999999999,
                    modifyValueOnWheel: false,
                    unformatOnSubmit: true,
                });
                autonumericFields.push(autonumeric);
            });
            $('.autonumeric-percentage').each(function () {
                var autonumeric = new AutoNumeric(this, {
                    minimumValue: 0,
                    maximumValue: 100,
                    modifyValueOnWheel: false,
                    unformatOnSubmit: true,
                });
                autonumericFields.push(autonumeric);
            });
        }
    };

    var handleDatePicker = function () {
        if (jQuery.fn.datepicker) {
            $('.date-picker').datepicker({
                orientation: "bottom",
                autoclose: true,
                language: 'th',
                todayHighlight: true,
                format: "dd/mm/yyyy",
                onSelect: function () {
                    $(this).change();
                }
            });
        }
    };

    var handleThaiDatePicker = function () {
        $.datetimepicker.setLocale('th');

        $('.date-picker-thai').datetimepicker({
            timepicker: false,
            yearOffset: 543,  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
            inline: false,
            format: 'd/m/Y',
            closeOnDateSelect: true
        });
    };

    var handleDateTimePicker = function () {
        $('.datepicker').datetimepicker({
            format: "dd/mm/yyyy",
            minView: 2,
            autoclose: true,
        });

        $('.monthpicker').datetimepicker({
            format: "MM/YYYY",
            viewMode: 'months',
        });

        $(".monthpicker").on("dp.show", function (e) {
            $(e.target).data("DateTimePicker").viewMode("months");
        });
    };

    var handleModalShow = function () {
        // $('.modal').on('shown.bs.modal', function () {
        //     handleAutoNumeric();
        // })
        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 10400 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function () {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);

            var animation = $(event.relatedTarget).data('animation') || 'effect-scale';
            $(this).addClass(animation);

            $('body').addClass('no-scroll');

            setTimeout(() => {
                $('.modal').find('input[type="text"]').first().focus();
            }, 500);

        });
    }

    var handleModalClose = function () {
        $('.modal').on('hidden.bs.modal', function () {
            $(this).find('input, textarea, select').each(function () {
                const ignored = ['_token', '_method'];

                if ($.inArray($(this).attr('name'), ignored) < 0 && !$(this).hasClass('ignore-clear'))
                    $(this).val('');

                if ($(this).hasClass('selectpicker')) {
                    $(this).selectpicker('val', $(this).find('option').first().val());
                }
            });
            $(this).find('input.autonumeric, input.autonumeric-integer, input.autonumeric-percent, input.autonumeric-minute').each(function () {
                $(this).val('0');
            });
            $(this).find('.has-error').each(function () {
                $(this).removeClass('has-error');
            });
            $(this).find('.error-help-block').each(function () {
                $(this).empty();
            });

            // hide modal with effect
            $(this).removeClass(function (index, className) {
                return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
            });

            $('body').removeClass('no-scroll');

            console.log('closed modal!');
        });
    }

    var initFormRequired = function () {
        $('.form-group').each(function () {
            if ($(this).find('[required]').length && !$(this).find('label span.required').length)
                $(this).find('label').append(' <span class="required" aria-required="true">*</span>');
        });
    };

    var handleTableHover = function () {
        $('.table').on('mouseover', 'tbody>tr', function () {
            $(this).find('.table-actions').toggleClass('hidden');
        })
        $('.table').on('mouseout', 'tbody>tr', function () {
            $(this).find('.table-actions').toggleClass('hidden');
        })
    };

    var handleTabToggle = function () {
        $('a[data-toggle="tab"]').on('click', function () {
            window.location.hash = $(this).attr('href');
        });
    };

    var handleInputGroup = function () {
        $(document).on('click', 'input', function (e) {
            var $inputGroup = $(this).parent('.input-group');
            $inputGroup.addClass('active');
        });
        $(document).on('blur', 'input', function (e) {
            var $inputGroup = $(this).parent('.input-group');
            $inputGroup.removeClass('active');
        });
    };

    var handleScrollers = function () {
        if (!$().slimScroll) {
            return;
        }

        $('.scroller').each(function () {
            if ($(this).attr("data-initialized")) {
                return; // exit
            }

            var height;

            if ($(this).attr("data-height")) {
                height = $(this).attr("data-height");
            } else {
                height = $(this).css('height');
            }

            $(this).slimScroll({
                allowPageScroll: true, // allow page scroll when the element scroll is ended
                size: '7px',
                color: ($(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : '#bbb'),
                wrapperClass: ($(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : 'slimScrollDiv'),
                railColor: ($(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : '#eaeaea'),
                position: 'right',
                height: height,
                alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                disableFadeOut: true
            });

            $(this).attr("data-initialized", "1");
        });
    };

    var handleCounterup = function () {
        if (!$().counterUp) {
            return;
        }

        $("[data-counter='counterup']").counterUp({
            delay: 10,
            time: 1000
        });
    };

    var handleTooltip = function () {
        $('.tooltips').tooltip();
    };

    // var handlePortletTools = function () {
    //     // handle portlet remove
    //     $('body').on('click', '.portlet > .portlet-title > .tools > a.remove', function (e) {
    //         e.preventDefault();
    //         var portlet = $(this).closest(".portlet");

    //         if ($('body').hasClass('page-portlet-fullscreen')) {
    //             $('body').removeClass('page-portlet-fullscreen');
    //         }

    //         portlet.find('.portlet-title .fullscreen').tooltip('destroy');
    //         portlet.find('.portlet-title > .tools > .reload').tooltip('destroy');
    //         portlet.find('.portlet-title > .tools > .remove').tooltip('destroy');
    //         portlet.find('.portlet-title > .tools > .config').tooltip('destroy');
    //         portlet.find('.portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');

    //         portlet.remove();
    //     });

    //     // handle portlet fullscreen
    //     $('body').on('click', '.portlet > .portlet-title .fullscreen', function (e) {
    //         e.preventDefault();
    //         var portlet = $(this).closest(".portlet");
    //         if (portlet.hasClass('portlet-fullscreen')) {
    //             $(this).removeClass('on');
    //             portlet.removeClass('portlet-fullscreen');
    //             $('body').removeClass('page-portlet-fullscreen');
    //             portlet.children('.portlet-body').css('height', 'auto');
    //         } else {
    //             var height = App.getViewPort().height -
    //                 portlet.children('.portlet-title').outerHeight() -
    //                 parseInt(portlet.children('.portlet-body').css('padding-top')) -
    //                 parseInt(portlet.children('.portlet-body').css('padding-bottom'));

    //             $(this).addClass('on');
    //             portlet.addClass('portlet-fullscreen');
    //             $('body').addClass('page-portlet-fullscreen');
    //             portlet.children('.portlet-body').css('height', height);
    //         }
    //     });

    //     $('body').on('click', '.portlet > .portlet-title > .tools > .collapse, .portlet .portlet-title > .tools > .expand', function (e) {
    //         e.preventDefault();
    //         var el = $(this).closest(".portlet").children(".portlet-body");
    //         if ($(this).hasClass("collapse")) {
    //             $(this).removeClass("collapse").addClass("expand");
    //             el.slideUp(200);
    //         } else {
    //             $(this).removeClass("expand").addClass("collapse");
    //             el.slideDown(200);
    //         }
    //     });
    // };

    var preventEnterSubmit = function () {
        if (!$('.enable-enter-submit').length) {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        }
    };

    var initAutoSize = function () {
        setTimeout(() => {
            autosize($('.autosize'));
        }, 500);
    }

    var handleSearch = function () {
        var timer, delay = 500;

        $('.input-search').bind('keydown search', function (e) {
            var ignored = [9, 18, 16, 112, 113, 114, 115];
            if (ignored.indexOf(e.which) != -1) return;

            var _this = $(this);
            clearTimeout(timer);
            timer = setTimeout(function () {
                searchData.terms = _this.val();
                datatable.draw();
            }, delay);
        });
    };

    var handleAcfSwitch = function () {
        $('body').on('click', '.acf-switch', function () {
            $(this).toggleClass('-on');
        });
    };

    var initFloatingPortlet = function () {
        var container = $('.portlet.floating');
        if (container.length) {
            $(window).scroll(function () {
                if ($(window).scrollTop() > 225) {
                    var $parent = container.parent();
                    container.addClass("fixed");
                    container.css('width', $parent.width());
                } else {
                    container.removeClass("fixed");
                }
            });
        }
    };

    var initLightbox = function () {
        lightbox.option({
            'resizeDuration': 200,
            // wrapAround: true,
            'alwaysShowNavOnTouchDevices': true,
            'fadeDuration': 150,
            'imageFadeDuration': 150,
            'resizeDuration': 150
        })
    };

    var handleFloatingActions = function () {
        var $container = $('.page-actions');
        if ($container.length)
            $(window).scroll(function () {
                if ($(window).scrollTop() > 255) {
                    var $parent = $container.parent();
                    $container.addClass("fixed");
                    $container.find('.d-flex').css('width', $parent.width());
                    // container.css('width', $parent.width());
                } else {
                    $container.removeClass("fixed");
                }
            });
    };

    // var handleFlashMessage = function () {
    //     app.statusbar.open('#statusbar-success');
    //     $('#statusbar-success').delay(1500).fadeOut(300);

    //     // app.statusbar.open('#statusbar-failed');
    //     // $('#statusbar-failed').delay(2500).fadeOut(300);
    // }

    var handleStatusToggle = function () {
        $('table').on('change', 'input[name="status"]', function (e) {
            const moduleUrl = $(e.target).data('module-url');
            const id = $(e.target).data('id');
            const active = $(e.target).prop('checked');

            $.ajax({
                url: `${moduleUrl}/${id}/status`,
                type: 'post',
                data: { active },
                success: function (resp) {
                    App.showSuccess(resp);
                    console.log(resp);
                },
                error: function () {
                    App.showError('');
                }
            });
        });
    }

    var handlePreviewData = function () {
        $('table').on('click', '.btn-view', function (e) {
            var $el = $(e.target).hasClass('fa') ? $(e.target).parent() : $(this);
            const moduleUrl = $el.data('module-url');

            Loading.show();

            $('#preview-frame').attr('src', moduleUrl + '?_t=' + Date.now());

            setTimeout(() => {
                $('#modal-preview').modal('show');
                setTimeout(() => {
                    Loading.hide();
                }, 300);
            }, 500);
        });
    }

    return {
        init: function () {
            handleTabs();
            handleDeleteButton();
            handleDeleteImage();
            handleSelectTwo();
            handleBootstrapSelect();
            handleAutoNumeric();
            handleDatePicker();
            // handleThaiDatePicker();
            handleDateTimePicker();
            handleModalClose();
            handleTableHover();
            handleTabToggle();
            handleInputGroup();
            handleScrollers();
            handleCounterup();
            // handlePortletTools();
            handleTooltip();
            handleModalShow();
            handleSearch();
            handleAcfSwitch();
            //handleFlashMessage();
            initFormRequired();
            initAutoSize();
            initFloatingPortlet();
            handleFloatingActions();
            handleStatusToggle();
            handlePreviewData();
            // initLightbox();
            //preventEnterSubmit();
        },
        getautonumericFields: function () {
            return autonumericFields;
        },
        scrollTo: function (el, offeset) {
            var pos = (el && el.length > 0) ? el.offset().top : 0;

            if (el) {
                if ($('body').hasClass('page-header-fixed')) {
                    pos = pos - $('.page-header').height();
                } else if ($('body').hasClass('page-header-top-fixed')) {
                    pos = pos - $('.page-header-top').height();
                } else if ($('body').hasClass('page-header-menu-fixed')) {
                    pos = pos - $('.page-header-menu').height();
                }
                pos = pos + (offeset ? offeset : -1 * el.height());
            }

            $('html,body').animate({
                scrollTop: pos
            }, '1500');
        },

        alert: function (msg, title, callback) {
            if (title) {
                swal({
                    title: title,
                    html: msg
                })
                    .then(function (isConfirm) {
                        if (isConfirm && isConfirm.value) {
                            if (callback) {
                                callback()
                            };
                        }
                    });
            } else {
                swal({
                    title: "",
                    html: msg
                })
                    .then(function (isConfirm) {
                        if (isConfirm && isConfirm.value) {
                            if (callback) {
                                callback()
                            };
                        }
                    });
            }
        },

        resetSubmitButton: function (element) {
            element.prop('disabled', false);
            var btnText = element.html().replace('<i class="fa fa-circle-o-notch fa-spin margin-left-10"></i>', '');
            element.html(btnText);
        },

        blockUI: function (options) {
            options = $.extend(true, {}, options);
            var html = '';
            if (options.animate) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>';
            } else if (options.iconOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""></div>';
            } else if (options.textOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            } else {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            }

            if (options.target) { // element blocking
                var el = $(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }
                el.block({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            } else { // page blocking
                $.blockUI({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    css: {
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            }
        },

        // wrApper function to  un-block element(finish loading)
        unblockUI: function (target) {
            // if (target) {
            //     $(target).unblock({
            //         onUnblock: function() {
            //             $(target).css('position', '');
            //             $(target).css('zoom', '');
            //         }
            //     });
            // } else {
            //     $.unblockUI();
            // }
        },

        toLocalDate: function (number) {
            var lang = Lang.app_language;
            moment.locale(lang);
            var date = new Date(number * 1000);
            var result = lang == 'th' ? moment(date).add('years', 543) : moment(date);
            return result;
        },

        getParam: function (name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        },

        getParams: function () {
            var prmstr = window.location.search.substr(1);

            function transformToAssocArray(prmstr) {
                var params = {};
                var prmarr = prmstr.split("&");
                for (var i = 0; i < prmarr.length; i++) {
                    var tmparr = prmarr[i].split("=");
                    params[tmparr[0]] = tmparr[1];
                }
                return params;
            }

            return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};;
        },

        getViewPort: function () {
            var e = window,
                a = 'inner';
            if (!('innerWidth' in window)) {
                a = 'client';
                e = document.documentElement || document.body;
            }

            return {
                width: e[a + 'Width'],
                height: e[a + 'Height']
            };
        },

        showFormErrors: function (errors, form, reload) {
            if (errors && errors['errors'] !== undefined) {
                $.each(errors['errors'], function (key, value) {
                    var formGroup = form.find('#' + key).parents('.form-group');
                    if (!formGroup.length)
                        formGroup = form.find('[name=' + key + ']').parents('.form-group');

                    formGroup.addClass('has-error').removeClass('has-success');

                    var jQueryValidationElm = formGroup.find('.help-block-error');
                    if (jQueryValidationElm.length) {
                        jQueryValidationElm.text(value);
                    } else {
                        formGroup.append('<span class="help-block help-block-error">' + value + '</span>')
                        formGroup.find('.help-block-error').text(value);
                    }
                    formGroup.find('.help-block-error').show();
                });
            } else {
                if (debug && (typeof errors == "object")) {
                    var html = errors.message;
                    if (errors.file)
                        html += ': ' + errors.file;
                    if (errors.line)
                        html += ', Line: ' + errors.line;
                } else {
                    var html = '<strong>Oops!</strong> Something went wrong. Please contact the administrator.';
                }

                noty({
                    text: html,
                    type: 'error',
                    layout: 'top',
                    animation: {
                        open: 'animated fadeInDown',
                        close: 'animated fadeOutUp',
                        speed: 150
                    }
                });

                $('.modal').modal('hide');
            }
        },
        showSuccess: function (resp, reload) {
            noty({
                text: resp.message,
                type: 'success'
            });
        },
        showInfo: function (msg, title) {
            noty({
                text: resp.message,
                type: 'info'
            });
        },
        showSucessOrRedirect: function (id, submitMethod, form) {
            if (submitMethod == 'PUT') {
                var resp = {
                    id: id,
                    message: Lang.get('shared.save_success')
                }
                App.showSuccess(resp);
                App.resetSubmitButton(form.find('[type="submit"]'));
                var inputs = form.find("input, select, button, textarea");
                setTimeout(function () {
                    inputs.prop("disabled", false);
                }, 500);
            } else {
                var pathArray = location.pathname.split('/');
                var redirectUrl = form.attr('redirect-url');
                if (redirectUrl && redirectUrl.indexOf('{id}') != -1) {
                    redirectUrl = redirectUrl.replace('{id}', id);
                }
                location.href = utility.getAppUrl() + (redirectUrl || pathArray[1] || '');
            }
        },
        show403: function () {
            swal({
                html: 'คุณไม่ได้รับอนุญาตให้กระทำการดังกล่าว <br />หรือไม่มีสิทธิ์ในการเข้าถึงข้อมูลส่วนนี้<p>กรุณาติดต่อผู้ดูแลระบบ</p>',
                type: 'warning',
                showCancelButton: false,
            }).then(function () {
                if (callback) {
                    callback();
                }
            });
        },
        showDeleteDependency: function (result) {

            function getTemplate(result) {
                var htmlStr = '<small>ไม่สามารถลข้อมูลได้ เนื่องจากข้อมูลนี้ถูกเลือกใช้งานอยู่ <br>โดยรายการข้อมูลดังต่อไปนี้</small><br><br>' +
                    '<table class="table table-hover table-bordered">' +
                    '<thead><tr><th class="text-center">รายการ</th><th class="text-center">รหัสข้อมูล</th><th class="text-center">ชื่อภาษาไทย</th></tr></thead><tbody>';

                var errors = result.errors;
                var template = $('#template-dependency').html();

                errors.forEach(error => {
                    htmlStr += template.replace(/{group}/g, error.group)
                        .replace(/{id}/g, error.id)
                        .replace(/{url}/g, error.url)
                        .replace(/{name}/g, error.name);
                });

                htmlStr += '</tbody></table>';
                return htmlStr;
            }

            swal({
                html: result.message, //'ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลถูกใช้งานอยู่',
                type: 'warning',
                showCancelButton: false,
            }, function () {
                // if (callback) {
                //     callback();
                // }
            });
        },
        navigation: function () {

            function parseURL(url) {
                parsed_url = {}

                if (url == null || url.length == 0)
                    return parsed_url;

                protocol_i = url.indexOf('://');
                parsed_url.protocol = url.substr(0, protocol_i);

                remaining_url = url.substr(protocol_i + 3, url.length);
                domain_i = remaining_url.indexOf('/');
                domain_i = domain_i == -1 ? remaining_url.length - 1 : domain_i;
                parsed_url.domain = remaining_url.substr(0, domain_i);
                parsed_url.path = domain_i == -1 || domain_i + 1 == remaining_url.length ? null : remaining_url.substr(domain_i + 1, remaining_url.length);

                domain_parts = parsed_url.domain.split('.');
                switch (domain_parts.length) {
                    case 2:
                        parsed_url.subdomain = null;
                        parsed_url.host = domain_parts[0];
                        parsed_url.tld = domain_parts[1];
                        break;
                    case 3:
                        parsed_url.subdomain = domain_parts[0];
                        parsed_url.host = domain_parts[1];
                        parsed_url.tld = domain_parts[2];
                        break;
                    case 4:
                        parsed_url.subdomain = domain_parts[0];
                        parsed_url.host = domain_parts[1];
                        parsed_url.tld = domain_parts[2] + '.' + domain_parts[3];
                        break;
                }

                parsed_url.parent_domain = parsed_url.host + '.' + parsed_url.tld;

                return parsed_url;
            }
            // set openable navigation items
            //$(".app-navigation nav > ul").find("ul").parent("li").addClass("openable");

            // set open element if it's avail

            // if(app.settings.navDetectAuto && !$(".app-navigation").hasClass("app-navigation-minimized")) {

            // }


            // horizontal navigation handler
            // $('.nav-link nav > ul > li > ul").each(function(){
            //     $(this).parent("li").addClass("openable");
            // });

            function buildPage(page, pathArray, i) {
                if (pathArray[i + 1] !== undefined) {
                    return page + buildPage(page, pathArray, i + 1);
                }
                return pathArray[i] + '/';
            }

            // set open element if it's avail
            var uri = parseURL(window.location.href.split(/[?#]/)[0]);
            var path = window.location.href.split(/[?#]/)[0],
                pathArray = path.split("/");

            if ($('a.nav-link[href="' + path + '"]').length) {
                $('a.nav-link[href="' + path + '"]').append('<span class="selected"></span>').parent("li").addClass("active");
            }
            else {
                page = uri.protocol + '://' + uri.domain + '/' + pathArray[3] + '/' + pathArray[4] + '/' + pathArray[5];
                if (!$('a.nav-link[href="' + page + '"]').length) {
                    page = uri.protocol + '://' + uri.domain + '/' + pathArray[3] + '/' + pathArray[4];
                }
                if (!$('a.nav-link[href="' + page + '"]').length) {
                    page = uri.protocol + '://' + uri.domain + '/' + pathArray[3];
                }
                $('a.nav-link[href="' + page + '"]').append('<span class="selected"></span>').parent("li").addClass("active");
            }

            // $('.nav-link .openable > a").on("click",function(e){
            //     e.stopPropagation();

            //     var nav = $(this).parents('.nav-link");
            //     nav.find(".openable").removeClass("active");

            //     $(this).parent(".openable").addClass("active");

            //     return false;
            // });
            // end horizontal navigation handler
        },
        error: function (msg, callback) {
            swal({
                html: msg,
                type: 'error',
                showCancelButton: false,
            }).then(function () {
                if (callback) {
                    callback();
                }
            });
        },

        warning: function (msg, title = '', callback) {
            swal({
                title: title,
                html: msg,
                type: 'warning',
                showCancelButton: false,
            }).then(function () {
                if (callback) {
                    callback();
                }
            });
        },

        confirm: function (msg, callback) {
            swal({
                html: msg,
                //type: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#EF4836",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: true,
                closeOnCancel: true,
                focusCancel: true,
                showCloseButton: true,
                showLoaderOnConfirm: true,
                animation: false

            }, function (isConfirm) {
                if (isConfirm) {
                    if (callback) {
                        callback();
                    }
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                }
                return isConfirm;

            });

        },
        confirmWide: function (msg, callback) {
            swal({
                html: msg,
                //type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF4836",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: false,
                closeOnCancel: false,
                focusCancel: true,
                showCloseButton: true,
                showLoaderOnConfirm: true,
                animation: false,
                customClass: 'swal-wide',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (callback) {
                        callback();
                    }
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                }
                return isConfirm;
            }).catch(swal.noop);
        },
        hideModal: function (elem) {
            // $(elem).removeClass("in");
            // $(".modal-backdrop").remove();
            // $('body').removeClass('modal-open');
            // $('body').css('padding-right', '');
            // $(elem).hide();

            console.log('try hide modal', elem);

            setTimeout(() => {

                console.log($(elem).find('.btn-dismiss'));

                $(elem).find('.btn-dismiss').click();
            }, 150);
        },
        uuid: function () {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        },
        renderDotdotdot: function (data) {
            return data.length > 100 ? data.substr(0, 100) + "..." : data;
        },
        renderTribeNamesTable: function (data) {
            var htmlStr = '';
            var names = JSON.parse(data);
            names.forEach(elem => {
                var property = elem.property;
                var template = property.text ? $('#template-tribe-names').html() : $('#template-tribe-names-only').html();
                var defaultIcon = property.default ? '<span class="font-blue-soft sbold">*</span>' : '';
                var tribeName = property.default ? elem.tribe_name : elem.tribe_name;

                htmlStr += template.replace(/{tribe_name}/g, tribeName)
                    .replace(/{name}/g, property.name)
                    .replace(/{default}/g, defaultIcon)
                    .replace(/{font_family_class}/g, elem.font_family_class);

                if (property.text)
                    htmlStr = htmlStr.replace(/{text}/g, property.text);

            });
            return htmlStr;
        },
        renderTableActions: function (moduleUrl, id, name) {
            var baseUrl = moduleUrl + '/' + id;
            var attrName = ' data-name="' + name + '"';
            var attrActionUrl = ' data-action-url="' + baseUrl + '"';

            var btnEdit = `<a href="${baseUrl}/edit" class="btn btn-icon tooltips btn-edit" data-title="แก้ไข"><i class="fa fa-edit"></i></a>`;
            var btnDel = `<a href="javascript:;" ${attrName} ${attrActionUrl} class="btn btn-icon btn-delete tooltips" data-title="ลบ"><i class="fa fa-trash"></i></a>`;

            var actions = btnEdit + btnDel;
            return actions;
        },
        renderTableActionsWithPreview: function (moduleUrl, id, name) {
            var baseUrl = moduleUrl + '/' + id;
            var attrName = ' data-name="' + name + '"';
            var attrActionUrl = ' data-action-url="' + baseUrl + '"';

            var btnView = `<a href="javascript:;" data-module-url="${baseUrl}" class="btn btn-icon tooltips btn-view" data-title="ดูข้อมูล"><i class="fa fa-search"></i></a>`;
            var btnEdit = `<a href="${baseUrl}/edit" class="btn btn-icon tooltips btn-edit" data-title="แก้ไข"><i class="fa fa-edit"></i></a>`;
            var btnDel = `<a href="javascript:;" ${attrName} ${attrActionUrl} class="btn btn-icon btn-delete tooltips" data-title="ลบ"><i class="fa fa-trash"></i></a>`;

            var actions = btnView + btnEdit + btnDel;
            return actions;
        }

    }

}();

$(function () {
    App.init();
    App.navigation();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    // if (e.keyCode == 27) {
    //     $('.modal').modal('hide');
    // }
});

//handle dropzone set global option for not auto detect
if (typeof Dropzone !== undefined) {
    Dropzone.autoDiscover = false;

    // Dropzone.options.myDropzone = {
    //     autoDiscover: false,
    //     thumbnailWidth: null,
    //     thumbnailHeight: null,
    // };
}

$.noty.defaults = {
    layout: 'topRight',
    theme: 'defaultTheme', // or relax // defaultTheme
    type: 'alert', // success, error, warning, information, notification
    text: '', // [string|html] can be HTML or STRING

    dismissQueue: true, // [boolean] If you want to use queue feature set this true
    force: false, // [boolean] adds notification to the beginning of queue when set to true
    maxVisible: 5, // [integer] you can set max visible notification count for dismissQueue true option,

    template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',

    timeout: 2000, // [integer|boolean] delay for closing event in milliseconds. Set false for sticky notifications
    progressBar: false, // [boolean] - displays a progress bar

    animation: {
        open: 'animated fadeInDown',
        close: 'animated fadeOut',
        // easing: 'swing',
        speed: 150 // opening & closing animation speed
    },
    closeWith: ['backdrop'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications

    modal: false, // [boolean] if true adds an overlay
    killer: false, // [boolean] if true closes all notifications and shows itself

    callback: {
        onShow: function () { },
        afterShow: function () { },
        onClose: function () { },
        afterClose: function () { },
        onCloseClick: function () { },
    },

    buttons: false // [boolean|array] an array of buttons, for creating confirmation dialogs.
};

Number.prototype.toNumber = function (c) {
    var n = this;
    var c = isNaN(c = Math.abs(c)) ? 2 : c;
    return parseFloat(n).toFixed(c).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
};

String.prototype.toNumber = function (c) {
    var n = this;
    var c = isNaN(c = Math.abs(c)) ? 2 : c;
    return parseFloat(n).toFixed(c).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
};

String.prototype.dotdotdot = function () {
    var d = this;
    return d.length > 100 ? '<span class="" data-container="body" data-placement="bottom" data-trigger="hover" data-content="' + d + '">' + d.substr(0, 100) + "...</span>" : d;
};

Number.prototype.getNumber = function (c) {
    var n = this || 0;
    if (c)
        return parseFloat(n.toString().replace(',', '')).toFixed(c);
    else
        return parseFloat(n.toString().replace(',', ''));
};

String.prototype.getNumber = function (c) {
    var n = this || 0;
    if (c)
        return parseFloat(n.toString().replace(',', '')).toFixed(c);
    else
        return parseFloat(n.toString().replace(',', ''));
};

function htmlEncode(value) {
    "use strict";
    //create a in-memory div, set it's inner text(which jQuery automatically encodes)
    //then grab the encoded contents back out.  The div never exists on the page.
    return $('<div/>').text(value).html();
}

function htmlDecode(value) {
    "use strict";
    return $('<div/>').html(value).text();
}
