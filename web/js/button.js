$(document).ready(function(){
  $('button').bind('click', function(e) {
    if (e.target.nodeName == 'BUTTON') {
      var link = $('a', $(this));
      if (link != undefined){
        $('a', $(this)).trigger('click');
      }
    }
  });
});
