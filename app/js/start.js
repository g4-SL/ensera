function getJson(url){ 
  return $.ajax({
    dataType: "json",
    url: "../" + url,
    success: function(data){
      return;
    }
  });
}

function getAnchor(url)
{
  var index = url.lastIndexOf('#');
  if (index != -1)
      return url.substring(index);
}

$(function() {
  $('.accordion-tabs-minimal').on('click', 'figure a', function(event) {
    $(".modal .modal-fade-screen").css({"opacity": "1", "visibility": "visible"});
    $('.modal .modal-fade-screen .modal-inner img').attr("src", $(this).find('img').attr('src'));
  });

  $(".modal-fade-screen, .modal-close").on("click", function() {
    $(".modal .modal-fade-screen").css({"opacity": "0", "visibility": "hidden"});
  });

  $(".modal-inner").on("click", function(e) {
    e.stopPropagation();
  });
});


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


  $.when(getJson("url.json")).done(function(data){
    var temp;
    var res = data.url_group[0].gallery;
    for(var i in res){
      temp = '<figure class="' + res[i].type +'"><a><img src="' + res[i].image + '" alt="" /></a></figure>';
      $('#gallery-section #all .tab-content').append(temp);
      $('#gallery-section #' + res[i].type + ' .tab-content').append(temp);
    }
  });

  $('.gallery-nav').each(function(index) {
    currentAnchor = getAnchor(location.href);
    if(currentAnchor == undefined){
      currentAnchor = "#all";
    }
    $(this).find(currentAnchor).addClass('is-active');
    $('.accordion-tabs-minimal').find(currentAnchor).addClass('is-open').show();
  });

  $('.gallery-nav').on('click', 'li', function(event) {
    if (!$(this).hasClass('is-active')) {
      event.preventDefault();
      var accordionTabs = $('.accordion-tabs-minimal');
      accordionTabs.find('.is-open').removeClass('is-open').hide();

      accordionTabs.find('#' + $(this).attr('id')).addClass('is-open').show();
      $(this).closest('.gallery-nav').find('.is-active').removeClass('is-active');
      $(this).addClass('is-active');
    } else {
      event.preventDefault();
    }
  });
});

