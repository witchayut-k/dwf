(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function ($) {
    $.extend($.summernote.plugins, {

        'synonym': function (context) {
            var self = this;
            var ui = $.summernote.ui;

            var $editor = context.layoutInfo.editor;
            var options = context.options;

            context.memo('button.synonym', function () {
                return ui.button({
                    contents: '<i class="fa fa-snowflake-o">',
                    tooltip: 'Create Synonym',
                    click: context.createInvokeHandler('synonym.showDialog')
                }).render();
            });

            self.initialize = function () {
                var $container = options.dialogsInBody ? $(document.body) : $editor;

                var body = '<div class="form-group">' +
                    '<label>Add Synonyms (comma - , - seperated</label>' +
                    '<input id="input-synonym" class="form-control" type="text" placeholder="Insert your synonym" />'
                '</div>'
                var footer = '<button href="#" class="btn btn-primary ext-synonym-btn">OK</button>';

                self.$dialog = ui.dialog({
                    title: 'Create Synonym',
                    fade: options.dialogsFade,
                    body: body,
                    footer: footer
                }).render().appendTo($container);
            };

            // You should remove elements on `initialize`.
            self.destroy = function () {
                self.$dialog.remove();
                self.$dialog = null;
            };

            self.showDialog = function () {
                self
                    .openDialog()
                    .then(function (data) {
                        ui.hideDialog(self.$dialog);
                        context.invoke('editor.restoreRange');
                        self.insertToEditor(data);

                        console.log("dialog returned: ", data)
                    })
                    .fail(function () {
                        context.invoke('editor.restoreRange');
                    });
            };

            self.openDialog = function () {
                return $.Deferred(function (deferred) {
                    var $dialogBtn = self.$dialog.find('.ext-synonym-btn');
                    var $synonymInput = self.$dialog.find('#input-synonym')[0];

                    ui.onDialogShown(self.$dialog, function () {
                        context.triggerEvent('dialog.shown');

                        $dialogBtn
                            .click(function (event) {
                                event.preventDefault();

                                deferred.resolve({
                                    synonym: $synonymInput.value
                                });
                            });
                    });

                    ui.onDialogHidden(self.$dialog, function () {
                        $dialogBtn.off('click');

                        if (deferred.state() === 'pending') {
                            deferred.reject();
                        }
                    });

                    ui.showDialog(self.$dialog);
                });
            };

            this.insertToEditor = function (data) {
                console.log("synonym: " + data.synonym)

                var dataArr = data.synonym.split(',');
                var restArr = dataArr.slice(1);

                var $elem = $('<span>', {
                    'data-function': "addSynonym",
                    'data-options': '[' + restArr.join(',').trim() + ']',
                    'html': $('<span>', {
                        'text': dataArr[0],
                        'css': {
                            backgroundColor: 'yellow'
                        }
                    })
                });

                context.invoke('editor.insertNode', $elem[0]);
            };
        }
    });
}));