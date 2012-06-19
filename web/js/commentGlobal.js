$(document).ready(function() {
  $('#comment_component').delegate('#commentGlobal', 'submit', function(e) {
    e.preventDefault();
    var $this = $(this);

    if (this.comment_value.value == '')
    {
      $(this.comment_value).css({'background-color': '#FDD', 'border': '1px solid #FAA'});
      $(this.comment_value).bind('click', function() {
        $(this).css({'background-color': '#FFF', 'border': '1px solid #DEDEDE'});
      });
    }
    else
    {
      $.ajax({
        type: "POST",
        url: $this.attr('action'),
        data:$this.serialize(),
        success: function(json) {
          $('#comment_component').html(json.html);
        }
      });
    }
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

  $('#comment_component').delegate('.clipboard', 'click', function() {
    window.prompt("Copy to clipboard: Ctrl+C, Enter", this.href);
    return false;
  });

  $('.list').click(function(event) {
    if($(event.target).hasClass('todo'))
    {
      var input = $(event.target);
      $.ajax({
        type: "POST",
        url: input.attr('data-url'),
        data: ({comment_id: input.attr('data-id'), status: (input.is(':checked')) ? 1 : 0}),
        dataType: "json",
        cache: false,
        success: function(json) {
          var info = "";
          if(json != undefined && (info = eval(json)) != undefined) {
            if(info.status) {
              $('#comment-' + info.id).addClass('done');
            } else {
              $('#comment-' + info.id).removeClass('done');
            }
            $('#comment-' + info.id + ' .todo').prev().text(info.message);
          }
        }
      });
    }
  });

  $(".popup").click(function() {
    modalPopup(url('default/cimeHelp'));
    return false;
  });

  $(document).keyup(function(e) {
    if (e.keyCode == 27) {
      closePopup();
    }
  });
});
