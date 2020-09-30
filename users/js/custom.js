$(document).ready(function(){
  $('.toggle-menu').jPushMenu({closeOnClickLink: false});
  $('.dropdown-toggle').dropdown();
});

(function($) {

  $.fn.jPushMenu = function(customOptions) {
  var o = $.extend({}, $.fn.jPushMenu.defaultOptions, customOptions);
  
  /* add class to the body.*/
  
  $('body').addClass(o.bodyClass);
  $(this).addClass('jPushMenuBtn');
  $(this).click(function() {
  var target         = '',
  push_direction     = '';
  
  
  if($(this).is('.'+o.showLeftClass)) {
    target         = '.cbp-spmenu-left';
    push_direction = 'toright';
  }
  else if($(this).is('.'+o.showRightClass)) {
    target         = '.cbp-spmenu-right';
    push_direction = 'toleft';
  }
  else if($(this).is('.'+o.showTopClass)) {
    target         = '.cbp-spmenu-top';
  }
  else if($(this).is('.'+o.showBottomClass)) {
    target         = '.cbp-spmenu-bottom';
  }
  
  
  $(this).toggleClass(o.activeClass);
  $(target).toggleClass(o.menuOpenClass);
  
  if($(this).is('.'+o.pushBodyClass)) {
    $('body').toggleClass( 'cbp-spmenu-push-'+push_direction );
  }
  
  /* disable all other button*/
  $('.jPushMenuBtn').not($(this)).toggleClass('disabled');
  
  return false;
  });
  var jPushMenu = {
  close: function (o) {
    $('.jPushMenuBtn,body,.cbp-spmenu').removeClass('disabled active cbp-spmenu-open cbp-spmenu-push-toleft cbp-spmenu-push-toright');
  }
  }
  
  if(o.closeOnClickOutside) {
  $(document).click(function() {
    jPushMenu.close();
  });
  
  $(document).on('click touchstart', function(){
    jPushMenu.close();
  });
  
  $('.cbp-spmenu,.toggle-menu').click(function(e){
    e.stopPropagation();
  });
  
  $('.cbp-spmenu,.toggle-menu').on('click touchstart', function(e){
    e.stopPropagation();
  });
  }
  
    // On Click Link
    if(o.closeOnClickLink) {
        $('.cbp-spmenu a').on('click',function(){
            jPushMenu.close();
        });
    }
  };
  
  /* in case you want to customize class name,
  *  do not directly edit here, use function parameter when call jPushMenu.
  */
  $.fn.jPushMenu.defaultOptions = {
  bodyClass       : 'cbp-spmenu-push',
  activeClass     : 'menu-active',
  showLeftClass   : 'menu-left',
  showRightClass  : 'menu-right',
  showTopClass    : 'menu-top',
  showBottomClass : 'menu-bottom',
  menuOpenClass   : 'cbp-spmenu-open',
  pushBodyClass   : 'push-body',
  closeOnClickOutside: true,
  closeOnClickInside: true,
  closeOnClickLink: true
  };
  })(jQuery);
  
  //
  

jQuery( function($) {
'use strict';

/* star Wow */
new WOW().init();

/* back to top */
var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

//slider

var swiper = new Swiper('.swiper-container', {
  pagination: {
    el: '.swiper-pagination',
    dynamicBullets: true,
  },
  loop: false,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

//

var swiper = new Swiper('.swiper-container2', {
  pagination: {
    el: '.swiper-pagination',
    dynamicBullets: true,
  },
  loop: false,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});


var swiper = new Swiper('.swiper-container3', {
  slidesPerView: 3,
  spaceBetween: 30,
  loop: false,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay: {
    delay: 5000,
  },
  breakpoints: {
    1280: {
    slidesPerView: 3
    },
    800: {
    slidesPerView: 1
    },
    640: {
    slidesPerView: 1
    }
  },
});


///
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

//////

jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function() {
  $(this).find('input').attr("max", "500");
  
  var spinner = jQuery(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find('.quantity-up'),
    btnDown = spinner.find('.quantity-down'),
    min = input.attr('min'),
    max = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

});

//////

/* menu */
$('.icon_mobile i').click(function(){
  $('nav').toggle(500);
});

$('.over_hid').click(function(){
  $('.hid-mobile').hide(500);
});

$('.icon_click').click(function(){
  $('.icon_show').toggle(500);
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


$('.logo_link').click(function(){
  $('.header2').hide(2000);
});



$("#lang").on("click", function() {
  $(".lang_down").fadeToggle( "fast");
});

$("#account").on("click", function() {
  $(".account_down").fadeToggle( "fast");
});


$("#cart_down").on("click", function() {
  $("#cart").fadeToggle( "fast");
});



}); /* end js*/