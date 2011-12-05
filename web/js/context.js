$(document).ready(function() {
  $('#context select').bind('change', function() {
    this.form.submit();
  });
  $('.clipboard').bind('click', function() {
    window.prompt("Copy to clipboard: Ctrl+C, Enter", this.href);
    return false;
  });
  $('.tooltip').qtip({
    style: {
      classes: 'tooltip'
    },
    position: {
      my: 'top left',
      target: 'mouse',
      viewport: $(window), // Keep it on-screen at all times if possible
      adjust: {
        x: 10,  y: 10
      }
    },
    hide: {
      fixed: true // Helps to prevent the tooltip from hiding ocassionally when tracking!
    }
  });

  var shiftKeyIsPressed = false;

  $(document).keydown(function(e) {
    var code = e.keyCode || e.which
    if (code == '16') {
      shiftKeyIsPressed = true;
     }
  });

  $(document).keyup(function(e) {
    var code = e.keyCode || e.which
    if (code == '16') {
      shiftKeyIsPressed = false;
     }
  });

  $('#window').mousewheel(function(event, delta, deltaX, deltaY) {
    if(shiftKeyIsPressed)
    {
      this.scrollLeft -= (delta * 120);
      event.preventDefault();
    }
  });
});
