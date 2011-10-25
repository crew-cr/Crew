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

        $('.add_comment', base.bloc).bind('click', function(event) {
          event.preventDefault();

          base.displayLineCommentForm();
        });
      }

      base.$el.bind('click', function(event) {
        base.displayLineCommentForm();
      });
    };

    base.displayLineCommentForm = function() {
      $.ajax({
        type: "POST",
        url: "/crew/_lineForm",
        data: base.$el.attr('data'),
        success: function(html) {
          if (base.visibled) {
            var tmpBaseBloc = base.bloc;
            base.bloc = $(html);
            tmpBaseBloc.after(base.bloc);
            tmpBaseBloc.remove();
          }
          else {
            base.bloc = base.$el
              .parent('td')
              .parent('tr')
              .after($(html))
              .next()
            ;

            base.formVisibled = true;
            base.changeVisibility();
          }

          $('.close', base.bloc).bind('click', function() {
            base.closeForm();
          });

          $('form', base.bloc).bind('submit', function(event) {
            event.preventDefault();

            base.submitForm(this);
          });
        }
      });
    };

    base.submitForm = function(form) {
      if (form.lineCommentAdd.value == '')
      {
        $(form.lineCommentAdd).css({'background-color': '#FDD', 'border': '1px solid #FAA'});
        $(form.lineCommentAdd).bind('click', function() {
          $(this).css({'background-color': '#FFF', 'border': '1px solid #DEDEDE'});
        });
      }
      else
      {
        var dataString = $(form).serialize();
        $.ajax({
          type: "POST",
          url: "/crew/lineAddComment",
          data: dataString,
          success: function(html) {
            var tmpBaseBloc = base.bloc;
            base.bloc = $(html);
            tmpBaseBloc.after(base.bloc);
            tmpBaseBloc.remove();

            $('.add_comment', base.bloc).bind('click', function() {
              base.displayLineCommentForm();
            });
          }
        });
      }
    };

    base.closeForm = function() {
      if (base.commented) {
        $.ajax({
          type: "POST",
          url: "/crew/_lineComment",
          data: base.$el.attr('data'),
          success: function(html) {
            if (base.visibled) {
              var tmpBaseBloc = base.bloc;
              base.bloc = $(html);
              tmpBaseBloc.after(base.bloc);
              tmpBaseBloc.remove();
              
              $('.add_comment', base.bloc).bind('click', function() {
                base.displayLineCommentForm();
              });
            }
            else {
              base.bloc = base.$el
                .parent('td')
                .parent('tr')
                .after($(html))
                .next()
              ;

              base.formVisibled = true;
              base.changeVisibility();
            }
          }
        });
      }
      else {
        base.bloc.remove();
        base.bloc = null;
      }
    };

    base.changeVisibility = function() {
      base.$el
        .addClass('disabled')
        .removeClass('enabled')
      ;

      base.visibled = !base.visibled;
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