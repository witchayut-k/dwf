const mix = require('laravel-mix');
const glob = require('glob');

mix.options({
    processCssUrls: false
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/**
 * Frontend
 */
mix.sass('resources/assets/frontend/scss/custom.scss', 'public/css/custom.min.css').version();

mix.styles([
    'resources/assets/frontend/css/libs/slick.css',
    'resources/assets/frontend/css/libs/slick-theme.css',
    'resources/assets/frontend/css/bootstrap/bootstrap.min.css',
    'resources/assets/frontend/css/libs/jquery.fancybox.min.css',
    'resources/assets/frontend/css/main.css',
    'resources/assets/frontend/css/team.css',
    'resources/assets/frontend/js/libs/font-awesome/css/font-awesome.css',
    'node_modules/fullcalendar/dist/fullcalendar.min.css',

    'node_modules/modal-video/css/modal-video.css'
], 'public/css/styles.min.css').version();

mix.scripts([
    'resources/assets/frontend/js/libs/jquery-2.2.0.min.js',
    'resources/assets/frontend/js/bootstrap/bootstrap.bundle.min.js',
    'resources/assets/frontend/js/libs/retina.min.js',
    'resources/assets/frontend/js/libs/jquery.browser.min.js',
    'resources/assets/frontend/js/libs/jquery.matchHeight-min.js',
    'resources/assets/frontend/js/libs/slick.js',
    'resources/assets/frontend/js/libs/jquery.fancybox.min.js',
    'vendor/proengsoft/laravel-jsvalidation/public/js/jsvalidation.min.js',
    'resources/assets/backend/js/vendor/moment/moment.min.js',
    'resources/assets/backend/js/vendor/bootstrap-daterange/daterangepicker.js',
    'resources/assets/backend/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js',
    'resources/assets/frontend/js/libs/fontsize.min.js',

    'node_modules/modal-video/js/modal-video.js'
], 'public/js/lib.min.js').version();

mix.scripts([
    'resources/assets/backend/js/vendor/moment/moment.min.js',
    'node_modules/fullcalendar/dist/fullcalendar.min.js',
], 'public/js/fullcalendar.min.js').version();

mix.scripts([
    'resources/assets/frontend/js/main.js',
    'resources/assets/frontend/js/custom.js'
], 'public/js/main.min.js').version();

(glob.sync('resources/assets/frontend/js/pages/**/*.js') || []).forEach(file => {
    mix.js(file, `public/${file.replace('resources/assets/frontend/js/pages', 'js/pages').replace(/\.js$/, '.min.js')}`).version();
});

mix.copyDirectory('resources/assets/frontend/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/frontend/images', 'public/images');

// mix.js('resources/resources/assets/backend/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();

/**
 * Backend
 */
mix.styles([
    'resources/assets/backend/css/styles.css',
    'resources/assets/backend/js/vendor/hierarchy-select/hierarchy-select.min.css',
    'node_modules/fullcalendar/dist/fullcalendar.min.css',
    'node_modules/dropzone/dist/min/dropzone.min.css',
    // 'resources/assets/backend/js/vendor/datatables/datatables.min.css',
    // 'resources/assets/backend/js/vendor/datatables/plugins/bootstrap/datatables.bootstrap.css',
], 'public/backend/css/styles.min.css').version();

mix.sass('resources/assets/backend/sass/apps/auth.scss', 'public/backend/css/auth.min.css').version();
mix.sass('resources/assets/backend/sass/apps/album.scss', 'public/backend/css/album.min.css').version();
mix.sass('resources/assets/backend/sass/apps/content.scss', 'public/backend/css/content.min.css').version();
mix.sass('resources/assets/backend/sass/custom.scss', 'public/backend/css/custom.min.css').version();
mix.sass('resources/assets/backend/sass/rte-content.scss', 'public/backend/css/rte-content.min.css').version();

(glob.sync('resources/assets/backend/js/pages/**/*.js') || []).forEach(file => {
    mix.js(file, `public/backend/${file.replace('resources/assets/backend/js/pages', 'js/pages').replace(/\.js$/, '.min.js')}`).version();
});

mix.scripts([
    'resources/assets/backend/js/app.js',
    'resources/assets/backend/js/boooya.js',
    'resources/assets/backend/js/app_plugins.js',
    'resources/assets/backend/js/datatable.js',
    'resources/assets/backend/js/loading.js',
], 'public/backend/js/app.min.js').version();

mix.scripts([
    'resources/assets/backend/js/vendor/jquery/jquery.min.js',
    'resources/assets/backend/js/vendor/jquery/jquery-ui.min.js',
    'resources/assets/backend/js/vendor/jquery/jquery.form.min.js',
    'resources/assets/backend/js/vendor/bootstrap/bootstrap.min.js',
    'resources/assets/backend/js/vendor/moment/moment.min.js',

    'resources/assets/backend/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js',
    'resources/assets/backend/js/vendor/bootstrap-select/bootstrap-select.js',
    'resources/assets/backend/js/vendor/select2/select2.full.min.js',
    'resources/assets/backend/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js',

    'resources/assets/backend/js/vendor/maskedinput/jquery.maskedinput.min.js',
    'resources/assets/backend/js/vendor/form-validator/jquery.form-validator.min.js',

    'resources/assets/backend/js/vendor/noty/jquery.noty.packaged.js',

    'resources/assets/backend/js/vendor/datatables/datatables.js',
    'resources/assets/backend/js/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js',

    // 'resources/assets/backend/js/vendor/datatables/jquery.dataTables.min.js',
    // 'resources/assets/backend/js/vendor/datatables/dataTables.bootstrap.min.js',

    'resources/assets/backend/js/vendor/limonte-sweetalert2/sweetalert2.js',

    // 'resources/assets/backend/js/vendor/dropzone/dropzone.js',
    // 'resources/assets/backend/js/vendor/nestable/jquery.nestable.js',
    // 'resources/assets/backend/js/vendor/cropper/cropper.min.js',

    'resources/assets/backend/js/vendor/bootstrap-daterange/daterangepicker.js',
    // 'resources/assets/backend/js/vendor/bootstrap-tour/bootstrap-tour.min.js',
    'resources/assets/backend/js/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js',
    // 'resources/assets/backend/js/vendor/fullcalendar/fullcalendar.js',
    'resources/assets/backend/js/vendor/summernote/summernote.min.js',
    // 'resources/assets/backend/js/vendor/summernote/summernote-ext-emoji.js',
    'resources/assets/backend/js/vendor/summernote/summernoteEmoji.js',
    'resources/assets/backend/js/vendor/summernote/summernote-image-attributes.js',
    'resources/assets/backend/js/vendor/summernote/bootstrap-grid.js',
    // 'resources/assets/backend/js/vendor/summernote/summernote-ext-emoji-min.js',
    // 'resources/assets/backend/js/vendor/smartwizard/jquery.smartWizard.js',
    'resources/assets/backend/js/vendor/hierarchy-select/hierarchy-select.min.js',

    'node_modules/feather-icons/dist/feather.min.js',
    'node_modules/autosize/dist/autosize.min.js',
    'node_modules/autonumeric/dist/autoNumeric.min.js',
    'node_modules/dropzone/dist/min/dropzone.min.js',
    // 'node_modules/fullcalendar/dist/locale/th.js',
    'node_modules/fullcalendar/dist/fullcalendar.min.js',

    'vendor/proengsoft/laravel-jsvalidation/public/js/jsvalidation.min.js',

    'node_modules/vue/dist/vue.min.js',

], 'public/backend/js/lib.min.js').version();


/**
 * Froala Plugin
 */
mix.styles([
    'resources/assets/backend/js/vendor/froala-editor/css/froala_editor.min.css',
    'resources/assets/backend/js/vendor/froala-editor/css/froala_style.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/code_view.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/draggable.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/colors.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/emoticons.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/image_manager.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/image.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/line_breaker.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/table.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/char_counter.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/video.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/fullscreen.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/file.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/quick_insert.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/help.css',
    'resources/assets/backend/js/vendor/froala-editor/css/third_party/spell_checker.css',
    'resources/assets/backend/js/vendor/froala-editor/css/plugins/special_characters.css',
], 'public/backend/css/froala.min.css').version();

mix.scripts([
    'resources/assets/backend/js/vendor/froala-editor/js/froala_editor.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/align.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/code_beautifier.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/code_view.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/colors.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/draggable.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/entities.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/font_size.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/fullscreen.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/image.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/image_manager.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/line_breaker.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/link.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/lists.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/paragraph_format.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/paragraph_style.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/print.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/quick_insert.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/quote.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/special_characters.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/table.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/url.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/video.min.js',
    'resources/assets/backend/js/vendor/froala-editor/js/plugins/word_paste.min.js',
], 'public/backend/js/froala.min.js')
    .version();

mix.scripts([
    'resources/assets/backend/js/froala-editor.js',
], 'public/backend/js/froala-editor.min.js')
    .version();

mix.scripts([
    'resources/assets/backend/js/summernote-editor.js',
], 'public/backend/js/summernote-editor.min.js')
    .version();

/**
 * Copies
 */

mix.copyDirectory('resources/assets/img', 'public/img');
// mix.copyDirectory('resources/assets/backend/js/vendor/summernote/pngs', 'public/emoji-icons');
mix.copyDirectory('resources/assets/frontend/images/icon', 'public/images/icon');
mix.copyDirectory('resources/assets/frontend/js/libs/font-awesome/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/backend/img', 'public/backend/img');
mix.copyDirectory('resources/assets/backend/font', 'public/backend/fonts');
