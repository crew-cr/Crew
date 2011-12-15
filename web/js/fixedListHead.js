// Fixed Floating File Header

$(document).ready(function()
{
  var top = $('.list_head.scroll').offset().top - parseFloat($('.list_head.scroll').css('marginTop').replace(/auto/, 0));
  var limit = $('#comment_component').offset().top - parseFloat($('#comment_component').css('marginTop').replace(/auto/, 0)) - $('.list_head.scroll').height();

  $(window).scroll(function (event)
  {
    var y = $(this).scrollTop();

    if (y >= top && !$('.list_head.scroll').hasClass('fixed'))
    {
      $('.list_head.scroll').addClass('fixed');
    }
    else if (y < top && $('.list_head').hasClass('fixed'))
    {
      $('.list_head.scroll').removeClass('fixed');
      $('.list_head.scroll').css({'top' : 0});
    }

    if ((y -limit) > 0)
    {
      $('.list_head.scroll').css({'top' : (limit - y)});
    }
    else
    {
      $('.list_head.scroll').css({'top' : 0});
    }
  });
});