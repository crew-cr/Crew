$(document).ready(function() {

  var shiftKeyIsPressed = false;

  $(document)
    .keydown(function(e) {
      var code = e.keyCode || e.which
      if (code == '16') {
        shiftKeyIsPressed = true;
      }
    })
    .keyup(function(e) {
      var code = e.keyCode || e.which
      if (code == '16') {
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