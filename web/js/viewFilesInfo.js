/**
 * viewFilesInfo.js
 * Defines whether files are visible in the list
 */
$(document).ready(function() {
  $('#view_files_A, #view_files_M, #view_files_D').bind('click', function() {

    // get class type of table line
    var classType = '.state_' + $(this).attr('name').substr(-1);
    var elements  = $(classType, $('#file_list')).parent('tr');

    var directoryClass = '.path_directory';
    var directoryPathElements = $(directoryClass, $('#file_list'));
    if ($(this).is(':checked')) {
      // show class type item
      elements.show();
      showDirectoryPath(directoryPathElements);
    }
    else {
      // hide class type item
      elements.hide();
      hideDirectoryPath(directoryPathElements);
    }
  });

  $('#view_files_tree').bind('click', function() {

    // get class type of table line
    var classType = '.path_directory';
    var elements  = $(classType, $('#file_list'));
    var fullpathSpan  = $('td.file_name span', $('#file_list'));

    if ($(this).is(':checked')) {
      // show directory tree
      showDirectoryPath(elements);
      // hide fullpath
      fullpathSpan.hide();
    }
    else {
      // hide directory tree
      hideDirectoryPath(elements);
      // show fullpath
      fullpathSpan.show();
    }
  });

  function hideDirectoryPath(directoryPathElements) {
    directoryPathElements.each(function(index, element) {
      if(!$('#view_files_tree').is(':checked') || $(element).nextAll(':visible').length == 0 || $(element).nextAll(':visible').first().hasClass('path_directory')) {
        $(element).hide();
      }
    });
  }

  function showDirectoryPath(directoryPathElements) {
    for(var i = directoryPathElements.length - 1; i >= 0 ; i--) {
      var element = directoryPathElements.get(i);
      if($('#view_files_tree').is(':checked') && $(element).nextAll(':visible').length != 0 && !$(element).nextAll(':visible').first().hasClass('path_directory')) {
        $(element).show();
      }
    }
  }
});