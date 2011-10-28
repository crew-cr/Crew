$(document).ready(function() {
  $('#globalCommentComponent').delegate('#globalComment', 'submit', function(e) {
    e.preventDefault();
    var $this = $(this);
    $.ajax({
      type: "POST",
      url: $this.attr('action'),
      data:$this.serialize(),
      success: function(json) {
        $('#globalCommentComponent').html(json.html);
      }
    });
  });
  
  $('#globalCommentComponent').delegate('.delete', 'click', function(element) {
    $.ajax({
      type: "POST",
      url: $(this).attr('data'),
      success: function(json) {
        $('#globalCommentComponent').html(json.html);
      }
    });
  });
});