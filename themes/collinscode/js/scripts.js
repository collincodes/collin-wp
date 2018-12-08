jQuery(document).ready(function( $ ) {

// on scroll watch header
$(window).on("scroll ready", function() {
  if ( $(window).scrollTop() > 50 ) {
    $(".header").addClass("active");
  } else {
     $(".header").removeClass("active");
  }
});

// mobile menu toggle
$('.mobile-button').click(function() {
  // toggle mobile menu
  $('.mobile-menu').toggleClass('active');
  // html overflow
  $('html').toggleClass('stopScroll');
});

// off click closes any sub menu
$('html').click(function(e) {
  if ( !$(e.target).hasClass('menu-item-has-children') && e.target.tagName.toLowerCase() !== 'a' ) {
    $('.sub-menu').removeClass('active');
    $('.menu-item-has-children').removeClass('rotate');
  }
});

});//close all jquery
