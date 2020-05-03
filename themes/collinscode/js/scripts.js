jQuery(document).ready(function($) {
  // placeholder for header
  let header = $("header").height() + "px";
  $("#headerPlaceholder").height(header);
  console.log(header);

  // on scroll watch header
  $(window).on("scroll ready", function() {
    if ($(window).scrollTop() > 50) {
      $(".header").addClass("active");
    } else {
      $(".header").removeClass("active");
    }
  });

  // toggle sub menu
  $(".menu-item-has-children").hover(function() {
    $(this)
      .children(".sub-menu")
      .toggleClass("active");
  });

  // mobile menu toggle
  $(".mobile-button").click(function() {
    // toggle mobile menu
    $(".mobile-menu, .mobile-button").toggleClass("active");
    // html overflow
    $("html, body").toggleClass("no-scroll");
  });
}); //close all jquery
