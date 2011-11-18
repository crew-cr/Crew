/**
 * viewFilesInfo.js
 * Defines whether files are visible in the list
 */
$(document).ready(function() {
  $('#view_files_A, #view_files_M, #view_files_D').bind('click', function() {

    // get class type of table line
    var classType = '.state_' + $(this).attr('name').substr(-1);
    var elements  = $(classType, $('#file_list')).parent('td').parent('tr');

    if ($(this).is(':checked')) {
      // show class type item
      elements.show();
    }
    else {
      // hide class type item
      elements.hide();
    }
  });
});