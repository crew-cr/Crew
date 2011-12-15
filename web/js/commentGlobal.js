$(document).ready(function() {
  $('#comment_component').delegate('#commentGlobal', 'submit', function(e) {
    e.preventDefault();
    var $this = $(this);
    $.ajax({
      type: "POST",
      url: $this.attr('action'),
      data:$this.serialize(),
      success: function(json) {
        $('#comment_component').html(json.html);
      }
    });
  });

  $('#comment_component').delegate('.delete', 'click', function(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to delete this comment ?'))
    {
      $.ajax({
        type: "POST",
        url: $(this).attr('data'),
        success: function(json) {
          $('#comment_component').html(json.html);
        }
      });
    }
  });

  $('#comment_component').delegate('.clipboard', 'click', function(e) {
    window.prompt("Copy to clipboard: Ctrl+C, Enter", this.href);
    return false;
  });
});
