$(function() {
    let header = $('.header');
    let logo = $('.header__logo');
    
    $(window).scroll(function() {
      if($(this).scrollTop() > 1) {
       header.addClass('header_activity');
      } else {
       header.removeClass('header_activity');
      }
    });
   });