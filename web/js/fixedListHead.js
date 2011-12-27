// Fixed Floating File Header

$(document).ready(function()
{
  var $header = $('.list_head.scroll');

  var top     = $header.offset().top - parseFloat($header.css('marginTop').replace(/auto/, 0));
  var limit   = $('#comment_component').offset().top - parseFloat($('#comment_component').css('marginTop').replace(/auto/, 0)) - $header.height();

  $(window).scroll(function () {
    var y = $(this).scrollTop();

    if (y >= top && !$header.hasClass('fixed')) {
      $header.addClass('fixed');
    }
    else if (y < top && $header.hasClass('fixed')){
      $header.removeClass('fixed');
      $header.css({'top' : 0});
    }

    if ((y -limit) > 0)     {
      $header.css({'top' : (limit - y)});
    }
    else {
      $header.css({'top' : 0});
    }
  });
});