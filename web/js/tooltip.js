$(document).ready(function() {
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
});
