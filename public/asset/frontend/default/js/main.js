'use strict';

/*
=====================================
Preloader js
=====================================
*/
$( document ).ready(function() {
  $(".preloader-holder").delay(300).animate({
    "opacity" : "0"
    }, 300, function() {
    $(".preloader-holder").css("display","none");
  });
});


/*
=====================================
Sticky Header When Scroll - js
=====================================
*/
$(window).on('scroll',function() {    
  var scroll = $(window).scrollTop();
  if (scroll >= 50) {
    $(".sp_header").addClass("animated fadeInDown header-fixed");
  } else {
    $(".sp_header").removeClass("animated fadeInDown header-fixed");
  }
});


/*
=====================================
Scroll Animation init - js
=====================================
*/
new WOW().init();


/*
=====================================
Parallax init - js
=====================================
*/
$('.paroller').paroller();  


/*
=====================================
Banner section mouse hover moving js
=====================================
*/
$(".sp_banner").on('mousemove',function(e) {
  parallaxIt(e, ".sp_banner_img", -90);
});

function parallaxIt(e, target, movement) {
  var $this = $(".sp_banner");
  var relX = e.pageX - $this.offset().left;
  var relY = e.pageY - $this.offset().top;

  TweenMax.to(target, 1, {
    x: (relX - $this.width() / 2) / $this.width() * movement,
    y: (relY - $this.height() / 2) / $this.height() * movement
  });
}


/*
=====================================
Counter odometer init - js
=====================================
*/
$(".sp_overview_item").each(function () {
  $(this).isInViewport(function (status) {
    if (status === "entered") {
      for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
        var el = document.querySelectorAll('.odometer')[i];
        el.innerHTML = el.getAttribute("data-odometer-final");
      }
    }
  });
});

$('.sidebar-toggeler').on('click', function(){
  $('.user-sidebar').toggleClass('active');
})


/*
=====================================
Testimonial slider - js
=====================================
*/
$('.sp_testimonial_content_slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: true,
  prevArrow: $('.testi-prev'),
  nextArrow: $('.testi-next'),
  dots: false,
  asNavFor: '.sp_testimonial_thumb_slider',
  autoplay: false,
  cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
  speed: 1500,
  autoplaySpeed: 1000
});
$('.sp_testimonial_thumb_slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.sp_testimonial_content_slider',
  dots: false,
  arrows: false,
});


/*
=====================================
Team Slider - js
=====================================
*/
$('.sp_team_slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  autoplay: true,
  cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
  speed: 1500,
  autoplaySpeed: 1000,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});


/*
=====================================
Brand slide - js
=====================================
*/
$('.sp_brand_slider').slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  autoplay: false,
  cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
  speed: 1500,
  autoplaySpeed: 1000,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 5
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2
      }
    }
  ]
});


/*
=====================================
Recent post slide - js
=====================================
*/
$('.recent-post-slider').slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  autoplay: false,
  cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
  speed: 1500,
  autoplaySpeed: 1000,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});