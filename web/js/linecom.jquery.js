/**
 * User: mbrunot
 * Date: 21/10/11
 * Time: 10:01
 * jQuery plugin
 */

(function($){
  $.linecom = function(el, options){
    var base = this;

    base.$el          = $(el);
    base.el           = el;
    base.visibled     = false;
    base.commented    = false;
    base.formVisibled = false;
    base.bloc         = null;

    base.$el.data("linecom", base);

    base.init = function(){
      base.options = $.extend({},$.linecom.defaultOptions, options);

      // initialize visibility
      base.visibled = base.$el.hasClass('disabled');

      // initialize commented status
      base.commented = base.$el.hasClass('commented');

      // initialize bloc
      if (base.visibled) {
        base.bloc = base.$el
          .parent('td')
          .parent('tr')
          .next()
        ;

        base.bindingBloc();
      }

      base.$el.bind('click', function(event) {
        base.displayLineCommentForm();
      });
    };

    base.bindingBloc = function() {

      $('.close', base.bloc).bind('click', function() {
        base.closeForm();
      });

      $('form', base.bloc).bind('submit', function(e) {
        e.preventDefault();
        base.submitForm(this);
      });

      $('.add_comment', base.bloc).bind('click', function(event) {
        event.preventDefault();
        $('.comment_add', base.bloc).hide();
        $('.comment_form', base.bloc).show();
      });

      $('.delete', base.bloc).bind('click', function(event) {
        event.preventDefault();
        base.deleteComment(this);
      });
    };

    base.displayLineCommentForm = function() {
      $.ajax({
        type: "GET",
        url: base.$el.attr('data'),
        success: function(json) {
          // in cases where the element is visible
          if (base.visibled) {
            var tmpBaseBloc = base.bloc;
            base.bloc = $(json.html);
            tmpBaseBloc.after(base.bloc);
            tmpBaseBloc.remove();
          }
          // in cases where the element is invisible
          else {
            base.bloc = base.$el
              .parent('td')
              .parent('tr')
              .after($(json.html))
              .next()
            ;

            base.visibled = !base.visibled;
            base.formVisibled = true;
            base.$el
              .addClass('disabled')
              .removeClass('enabled')
            ;
          }

          base.bindingBloc();
        }
      });
    };

    base.submitForm = function(form) {
      if (form.comment_value.value == '')
      {
        $(form.comment_value).css({'background-color': '#FDD', 'border': '1px solid #FAA'});
        $(form.comment_value).bind('click', function() {
          $(this).css({'background-color': '#FFF', 'border': '1px solid #DEDEDE'});
        });
      }
      else
      {
        $.ajax({
          type: "POST",
          url: $(form).attr('action'),
          data: $(form).serialize(),
          success: function(json) {
            var tmpBaseBloc = base.bloc;
            base.bloc = $(json.html);
            tmpBaseBloc.after(base.bloc);
            tmpBaseBloc.remove();
            base.commented = true;

            base.bindingBloc();
          }
        });
      }

      return false;
    };

    base.deleteComment = function(element) {
      if (confirm('Are you sure you want to delete this comment ?'))
      {
        $.ajax({
          type: "POST",
          url: $(element).attr('data'),
          success: function(json) {
            var tmpBaseBloc = base.bloc;
            base.bloc = $(json.html);
            tmpBaseBloc.after(base.bloc);
            tmpBaseBloc.remove();
            base.commented = true;

            base.bindingBloc();
          }
        });
      }
    };

    base.closeForm = function() {
      var commentForm = $('.comment_form', base.bloc);
      var commentContent = commentForm.find('#comment_value').val();

      if(commentContent == '' || (commentContent != '' && confirm('Are you sure you want to close this comment form ?\nYou will loose all your modification if you do.')))
      {
        if (base.commented) {
          commentForm.hide();
          $('.comment_add', base.bloc).show();
        }
        else {
          base.bloc.remove();
          base.bloc = null;
          base.visibled = false;
        }
      }
    };

    base.init();
  };

  $.linecom.defaultOptions = {
  };
  
  $.fn.linecom = function(options){
    return this.each(function(){
      (new $.linecom(this, options));
    });
  };
})(jQuery);

$(document).ready(function() {
  $('.add_bubble').linecom();
});
