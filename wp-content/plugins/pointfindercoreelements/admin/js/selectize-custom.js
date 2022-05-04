(function($) {
  "use strict";

  $(function(){

    $("#pfupload_listingtypes").selectize({
      plugins: ['remove_button'],
      allowEmptyOption: true,
      highlight: true,
      create: false,
      diacritics: true,
      maxItems: null,
      labelField: 'title',
      searchField: 'title',
    });

  });

})(jQuery);