
(function ($) {
  "use strict";

  $.fn.fileinputThemes.fa = {
      fileActionSettings: {
          removeIcon: '<i class="las la-trash"></i>',
          uploadIcon: '<i class="las la-upload"></i>',
          uploadRetryIcon: '<i class="las la-repeat"></i>',
          zoomIcon: '<i class="las la-search-plus"></i>',
          dragIcon: '<i class="las la-bars"></i>',
          indicatorNew: '<i class="las la-plus-circle text-warning"></i>',
          indicatorSuccess: '<i class="las la-check-circle text-success"></i>',
          indicatorError: '<i class="las la-exclamation-circle text-danger"></i>',
          indicatorLoading: '<i class="las la-hourglass text-muted"></i>'
      },
      layoutTemplates: {
          fileIcon: '<i class="las la-file kv-caption-icon"></i> '
      },
      previewZoomButtonIcons: {
          prev: '<i class="las la-caret-left fa-lg"></i>',
          next: '<i class="las la-caret-right fa-lg"></i>',
          toggleheader: '<i class="las la-arrows-v"></i>',
          fullscreen: '<i class="las la-arrows-alt"></i>',
          borderless: '<i class="las la-external-link"></i>',
          close: '<i class="las la-times"></i>'
      },
      previewFileIcon: '<i class="las la-file"></i>',
      browseIcon: '<i class="las la-folder-open"></i>',
      removeIcon: '<i class="las la-trash"></i>',
      cancelIcon: '<i class="las la-ban"></i>',
      uploadIcon: '<i class="las la-upload"></i>',
      msgValidationErrorIcon: '<i class="las la-exclamation-circle"></i> '
  };
})(window.jQuery);