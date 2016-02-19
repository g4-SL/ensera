function scaleDown() {
  $('#gallery-pic > figure').removeClass('current').addClass('not-current');
  $('nav > ul > li').removeClass('current-li');
}

function show(category) {
  scaleDown();

  $('#' + category).addClass('current-li');
  $('.' + category).removeClass('not-current');
  $('.' + category).addClass('current');

  if (category == "all") {
      $('nav > ul > li').removeClass('current-li');
      $('#all').addClass('current-li');
      $('#gallery-pic > figure').removeClass('current, not-current');
  }
}

$(document).ready(function() {
  $("#owl-example").owlCarousel({
    slideSpeed : 300,
    paginationSpeed : 400,
    singleItem: true,
    autoPlay: true

    // "singleItem:true" is a shortcut for:
    // items : 1, 
    // itemsDesktop : false,
    // itemsDesktopSmall : false,
    // itemsTablet: false,
    // itemsMobile : false
  });
  var menuToggle = $('#js-mobile-menu').unbind();
  $('#js-navigation-menu').removeClass("show");

  menuToggle.on('click', function(e) {
    e.preventDefault();
    $('#js-navigation-menu').slideToggle(function(){
      if($('#js-navigation-menu').is(':hidden')) {
        $('#js-navigation-menu').removeAttr('style');
      }
    });
  });    

  $('#all').addClass('current-li');
 
  $("nav > ul > li").click(function(){
    show(this.id);
  });
});
