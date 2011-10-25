$(document).ready(function() {
  $('#globalCommentComponent').delegate('#globalComment', 'submit', function(e) {
    e.preventDefault();
    var $this = $(this);
    console.log($this.serialize());
    $.ajax({
      type: "POST",
      url: $this.attr('action'),
      data:$this.serialize(),
      success: function(json) {
        $('#globalCommentComponent').html(json.html);
      }
    });
  });
});