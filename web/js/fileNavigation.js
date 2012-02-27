$(document).ready(function() {

  var shiftKeyIsPressed = false;

  var scrollToDiff = function(type) {
    var
      scrollPosition = $(document).scrollTop(),
      nextPos = 0,
      currentPosition = 0,
      margin = 100
      ;
    $(".added, .deleted").each(function() {
        currentPosition = $(this).offset().top;
        if (
            (type == 'bottom' && currentPosition  > (scrollPosition + margin))
            || (type == 'top' && currentPosition  < (scrollPosition + margin))
        ) {
          nextPos = currentPosition;
          return false;
        }
    });
    if (nextPos > 0) {
      var position = nextPos - margin;
      $(document).scrollTop(position);
    }
  };

  var changeFile = function(selector) {
    var location = $(selector).click().first().attr('href');
    if (typeof location != 'undefined') {
      window.location = location;
    }
  };

  $(document)
    .keydown(function(e) {
      if (e.target.type == 'textarea')
      {
        return true;
      }
      var code = e.keyCode || e.which;
      switch (code) {
        case 16: //shift
          shiftKeyIsPressed = true;
          break;
        case 75: //k
          scrollToDiff('top');
          break;
        case 74: //j
          scrollToDiff('bottom');
          break;
        case 72: //h
          changeFile('a.previous');
          break;
        case 76: //l
          changeFile('a.next');
          break;
      }
    })
    .keyup(function(e) {
      var code = e.keyCode || e.which
      if (code == '16') { //shift
        shiftKeyIsPressed = false;
      }
    })
  ;

  $('#window').mousewheel(function(event, delta, deltaX, deltaY) {
      if(shiftKeyIsPressed) {
        event.preventDefault();
        this.scrollLeft -= (delta * 120);
      }
    })
  ;
});
