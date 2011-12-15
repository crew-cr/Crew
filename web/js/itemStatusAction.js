$(document).ready(function() {
  $('.dropdown-action').dropdown();

  $('.dropdown-action').delegate('.item-status-action', 'click', function(e) {
    e.preventDefault();

    var base = $(this);

    $.ajax({
      type: "POST",
      url: base.attr('href'),
      success: function(json) {
        base
          .removeClass('item-status-action')
          .addClass('dropdown-toggle')
        ;

        var itemContainer = base.parent('li');

        var dropdownContainer = itemContainer
          .parent('ul.dropdown-menu')
          .parent('li.dropdown')
          .removeClass('open')
        ;

        var dropdownToggle = dropdownContainer
          .children('.dropdown-toggle')
          .removeClass('dropdown-toggle')
          .addClass('item-status-action')
        ;

        dropdownContainer.prepend(base);
        itemContainer.prepend(dropdownToggle);
      }
    });

    return false;
  });
});