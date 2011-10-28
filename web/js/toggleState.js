$(document).ready(function() {
  $('.toggle').bind('click', function() {
    var $this = $(this);

    $.ajax({
      type: "POST",
      url: $this.attr('href'),
      success: function(json) {
        $('.toggle', $this.parent('.status'))
          .addClass('disabled')
        ;

        if (json.toggleState == 'blacklisted')
        {
          $this
            .parent('td')
            .parent('tr')
            .remove()
          ;
        }
        else if (json.toggleState == 'enabled')
        {
          $this.removeClass('disabled');
        }
        else
        {
          $this.addClass(json.toggleState);
        }
      }
    });

    return false;
  });
});