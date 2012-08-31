$(document).ready(function(){

  $('.toggle-diff-range').click(function() {
    $('.diff-range').toggle();
  });
  
  
  $(".select2").select2({
    width: 'resolve',
    formatResult: function(object, container, query) {
      var result = object.text;
      
      if ("undefined" !== typeof object.element[0].attributes['data-review-request']) {
        result = '<span class="ricon" title="Review Request">Ð </span>' + result;
      }
      
      return result;
    }
  })
});