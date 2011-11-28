$(document).ready(function() {
  $('.toggle').bind('click', function() {
    var $this = $(this);

    $.ajax({
      type: "POST",
      url: $this.attr('href'),
      success: function(json) {
        $('button', $this.parent('button').parent('.status'))
          .removeClass('enabled')
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
          $this.parent('button').addClass(json.toggleState);
        }
        else if (json.toggleState == 'disabled')
        {
          $this.parent('button').removeClass(json.toggleState);
        }
      }
    });

    return false;
  });
});