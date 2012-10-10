$(document).ready(function(){

  $('.toggle-diff-range').click(function() {
    $(this).toggleClass('icon-caret-down icon-caret-up');
    $('.diff-range').toggle();
  });
  
  
  $(".select2").select2({
    width: 'resolve',
    formatResult: function(object, container, query) {
      var result = object.text;
      
      if ("undefined" !== typeof object.element[0].attributes['data-review-request']) {
        result = '<span class="icon-share" title="Review Request"> </span>' + result;
      } else {
        result = '<span class="icon-nothing"> </span>' + result;
      }
      
      return result;
    }
  })
});