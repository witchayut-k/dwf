
/*
 * @package summernoteEmoji.js
 * @version 1.0
 * @author Jessica GonzΓ‘lez <suki@missallsunday.com>
 * @copyright Copyright (c) 2017, Jessica GonzΓ‘lez
 * @license https://opensource.org/licenses/MIT MIT
 */

(function() {
  (function(factory) {
    if (typeof define === 'function' && define.amd) {
      define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
      module.exports = factory(require('jquery'));
    } else {
      factory(window.jQuery);
    }
  })(function($) {
    $.extend($.summernote.options, {
      sEmoji: {
        icon: 'π',
        tooltip: 'Insert Emoji',
        list: ['π', 'π', 'π', 'π', 'π', 'π', 'π', 'π', 'π‘', 'π', 'π²', 'π±', 'π΄', 'π ', 'π']
      }
    });
    return $.extend($.summernote.plugins, {
      'sEmoji': function(context) {
        var options, sEmojiOptions, ui;
        ui = $.summernote.ui;
        options = context.options;
        sEmojiOptions = options.sEmoji;
        return context.memo('button.sEmoji', function() {
          var buttonIcon, emojiButton;
          buttonIcon = sEmojiOptions.icon ? sEmojiOptions.icon : sEmojiOptions.list[0];
          emojiButton = ui.buttonGroup([
            ui.button({
              className: 'dropdown-toggle',
              contents: "<span class='note-current-emoji'>" + buttonIcon + "</span>",
              tooltip: sEmojiOptions.tooltip,
              data: {
                toggle: 'dropdown'
              }
            }), ui.dropdownCheck({
              className: 'dropdown-emoji',
              items: sEmojiOptions.list,
              template: function(item) {
                return item;
              },
              callback: function($dropdown) {
                $dropdown.find('a').each(function() {
                  var selfButton;
                  selfButton = $(this);
                  return selfButton.on('click', function(e) {
                    e.preventDefault();
                    context.invoke('editor.restoreRange');
                    context.invoke('editor.focus');
                    context.invoke('editor.insertText', selfButton.text());
                    $('.note-btn-group').removeClass('open');
                    return false;
                  });
                });
              }
            })
          ]);
          return emojiButton.render();
        });
      }
    });
  });

}).call(this);
