$(document).ready(function() {
  $('#context select').bind('change', function() {
    this.form.submit();
  })
});