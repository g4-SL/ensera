function omegaReset(){
  $('figure.current').removeAttr('style');
  $('figure.current').filter(':visible').each(function(i) {
    var modulus = (i + 1) % 3;
    if (modulus === 0) { 
        $(this).css("margin-right", 0);
    }
  });
}

function scaleDown() {
  $('#gallery-pic > figure').removeClass('current').addClass('not-current');
  $('nav > ul > li').removeClass('current-li');
}

function show(category) {
  scaleDown();

  if (category == "all") {
      $('#all').addClass('current-li');
      $('#gallery-pic > figure').removeClass('not-current');
      $('#gallery-pic > figure').addClass('current');
      return;
  }

  $('#' + category).addClass('current-li');
  $('.' + category).removeClass('not-current');
  $('.' + category).addClass('current');
}

$(document).ready(function() {
  $("#highlight").owlCarousel({
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
  show('all');
  omegaReset();
 
  $("nav > ul > li").click(function(){
    show(this.id);
    omegaReset();
  });


  $('.accordion-tabs-minimal').each(function(index) {
    $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
  });
  $('.accordion-tabs-minimal').on('click', 'li > a.tab-link', function(event) {
    if (!$(this).hasClass('is-active')) {
      event.preventDefault();
      var accordionTabs = $(this).closest('.accordion-tabs-minimal');
      accordionTabs.find('.is-open').removeClass('is-open').hide();

      $(this).next().toggleClass('is-open').toggle();
      accordionTabs.find('.is-active').removeClass('is-active');
      $(this).addClass('is-active');
    } else {
      event.preventDefault();
    }
  });
});

