import $ from 'jquery'
window.jQuery = $
window.$ = $
import 'bootstrap'
import '../sass/style.scss'
import 'fullpage.js'
import 'fullpage.js/dist/jquery.fullpage.css'
import 'animate.css'
import Shuffle from 'shufflejs'
import 'lightgallery'
import 'lightgallery/dist/css/lightgallery.css';
import 'jquery-mousewheel';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';
import fontawesome from '@fortawesome/fontawesome';
import faUser from '@fortawesome/fontawesome-free-solid/faUser';
fontawesome.library.add(faUser);
import faUserCircle from '@fortawesome/fontawesome-free-solid/faUserCircle';
fontawesome.library.add(faUserCircle);


(function ($) {

  let windowWidth = $(window).width();
  let imgCrops = [];
  let blackNavs = [];
  let currSlide = null;
  let navTooltips = [];
  let pgBars = [];
  let prxBgs = [];

  const device = {
    sm: 576,
    md: 768
  }

  const resize = function () {
    $(window)
      .resize(function (e) {
        windowWidth = $(window).width();
        navColor();
        imgCrop();
        owl();
        navToggle('resize');
      });
  }

  const prxBg = function () {
    if (prxBgs.map(bg => bg.slide).includes(currSlide)) {
      const url = prxBgs.filter(bg => bg.slide === currSlide)[0]['url'];
      const value = `url(${url})`;
      $('#bootstrap-overrides').css('background-image', value);
    }
  }

  const animationEnd = (function (el) {
    const animations = {
      animation: 'animationend',
      OAnimation: 'oAnimationEnd',
      MozAnimation: 'mozAnimationEnd',
      WebkitAnimation: 'webkitAnimationEnd'
    };

    for (var t in animations) {
      if (el.style[t] !== undefined) {
        return animations[t];
      }
    }
  })(document.createElement('div'));

  const titleAnim = function (sId, effectAdd) {
    const all = '.js-title-anim';
    const current = `#${sId}${currSlide} ${all}`;
    const effect = `animated ${effectAdd}`;

    $(all).addClass('invisible'); // back to default(display: hidden;)
    $(current) // animation start
      .removeClass('invisible')
      .addClass(effect)
      .one(animationEnd, function () {
        $(this).removeClass(effect);
      });
  }

  const bgAnim = function (sId, effectAdd) {
    const all = '.js-bg-anim';
    const current = `#${sId}${currSlide} ${all}`;
    const effect = `animated ${effectAdd}`;

    $(all).addClass('invisible'); // back to default(display: hidden;)
    $(current) // animation start
      .removeClass('invisible')
      .addClass(effect)
      .one(animationEnd, function () {
        $(this).removeClass(effect);
      });
  }

  const pgBarAnim = function () {
    if (pgBars.includes(currSlide)) {
      $('.prb-1').css('width', '80%');
      $('.prb-2').css('width', '90%');
      $('.prb-3').css('width', '100%');
    } else {
      $('.progress-bar').css('width', '0%');
    }
  }

  const hoverAnim = function () {
    const anim = 'animated infinite bounce'
    $('#fullpage-front .scroll-down').mouseenter(function () {
      $('.arrow', this).addClass(anim);
    })
      .mouseleave(function () {
        $('.arrow', this).removeClass(anim);
      });
  }

  const navColor = function () {
    const white = function () {
      $('nav a').removeClass('js-color-black');
      $('#sns img').removeClass('js-filter-black');
      $('#fp-nav ul li a span, .fp-slidesNav ul li a span').addClass('js-bg-white');
      $('#fp-nav ul li .fp-tooltip').removeClass('js-color-black');
    };
    const black = function () {
      $('nav a').addClass('js-color-black');
      $('#sns img').addClass('js-filter-black');
      $('#fp-nav ul li a span, .fp-slidesNav ul li a span').removeClass('js-bg-white');
      $('#fp-nav ul li .fp-tooltip').addClass('js-color-black');
    }
    blackNavs.includes(currSlide)
      ? black()
      : white();
  }

  const imgCrop = function () {
    if (imgCrops.length) {
      const hWindow = $(window).height();
      const hNav = $('nav').outerHeight();
      const hBody = $('#s5-body').outerHeight();
      const height = hWindow - hNav - hBody + 'px';
      $('#s5-img').css('height', (windowWidth < device.sm
        ? height
        : 'auto'));
    }
  }

  const fullpage = function () {

    const frontInit = function () {
      blackNavs = [4, 6];
      imgCrops = [5];
      pgBars = [5];
      navTooltips = [
        'Welcome',
        'About us',
        'News',
        'Blog',
        'Skill-set',
        'Our team',
        'Contact'
      ];
      prxBgs = [
        {
          slide: 1,
          class: 'prx-1',
          url: $('#bootstrap-overrides').data('bgImg1')
        }, {
          slide: 5,
          class: 'prx-2',
          url: $('#bootstrap-overrides').data('bgImg2')
        }, {
          slide: 7,
          class: 'prx-3',
          url: $('#bootstrap-overrides').data('bgImg3')
        }
      ];

      $('#fullpage-front').fullpage({
        navigation: true,
        navigationPosition: 'right',
        navigationTooltips: navTooltips,

        afterLoad: function (anchorLink, idx) {
          currSlide = idx;
          navColor();
          pgBarAnim();
          imgCrop();
          titleAnim('section', 'fadeInUp');
          bgAnim('section', 'fadeIn');
          prxBg();
        },
        onLeave: function (idx, nextIdx, direction) { //
          currSlide = nextIdx;
          navColor();
          pgBarAnim();
          prxBg();
        }
      });

    }

    const newsInit = function () {
      $('#fp-news').fullpage({
        navigation: true,
        navigationPosition: 'right',
        afterLoad: function (achorLink, idx) {
          currSlide = idx;
          navColor();
          titleAnim('news-section', 'flipInX');
          bgAnim('news-section', 'fadeIn');
        }
      })
    }

    // Front page
    if ($('#fullpage-front').length) {
      frontInit();
    } else if ($('#fp-news').length) {
      newsInit();
    }
  } // end fulpage

  const shuffle = function () {
    const $sf = $('.my-shuffle');
    const shuffleInit = function () {
      // var Shuffle = window.Shuffle;
      var myShuffle = new Shuffle(document.querySelector('.my-shuffle'), {
        itemSelector: '.image-item',
        sizer: '.my-sizer-element',
        buffer: 1
      });

      $('input[name="shuffle-filter"]').on('change', function (evt) {
        var input = evt.currentTarget;
        if (input.checked) {
          myShuffle.filter(input.value);
        }
      });
    }
    $sf.length
      ? shuffleInit()
      : false;
  }

  const lightGallery = function () {
    const $lg = $('#lightgallery');
    const $here = $('#lg-here');
    // move position to [shortcode]
    $lg
      .appendTo($here)
      .removeClass('d-none');
    const galleryInit = function () {
      $lg.lightGallery();
      $lg.on('onAferAppendSlide.lg', function (event) {
        $('body').addClass('noscroll');
      });
      $lg.on('onBeforeClose.lg', function (event) {
        $('body').removeClass('noscroll');
      });
    }
    $lg.length
      ? galleryInit()
      : false;
  }

  const owl = function () {
    const $owl = $('#owl');

    const owlInit = function () {
      $owl.owlCarousel({items: 1, dots: true, loop: true});
    }

    if ($owl.length && windowWidth < device.md) {
      $owl
        .removeClass('row')
        .addClass('owl-carousel owl-theme');
      owlInit();
    } else {
      $owl
        .trigger('destroy.owl.carousel')
        .removeClass()
        .addClass('row');

    }
  }

  const owlShort = function () {
    const $owl = $('.owl-carousel');
    
    for (let owl of $owl) {
      $(owl).owlCarousel({
        items: 1,
        margin:30,
        loop:true,
      });
    }
  }

  const scrollTop = function () {
    $("a[href='#top']")
      .click(function () {
        $("html, body").animate({
          scrollTop: 0
        }, "slow");
        return false;
      });
  }

  const navToggle = function (param) {
    const dark = '#222222';
    const $navbar = $('nav.navbar');
    const $navButton = $('button.navbar-toggler');
    const $navItems = $('#navbarNavDropdown a');
    const navbarShown = () => !!$('#navbarNavDropdown.show').length;
    const navExpanded = () => {
      return !!$('.navbar-toggler[aria-expanded="true"]').length;
    }

    const navbarOpen = () => {
      $('#nav-icon').addClass('open');
      $navbar.css('background-color', dark);
    }
    const navbarClose = () => {
      $('#nav-icon').removeClass('open');
      setTimeout(function () {
        $navbar.css('background-color', 'transparent')
      }, 300);
    }
    const handleNavbar = () => {
      navbarShown()
        ? navbarClose()
        : navbarOpen();
    }
    $navButton
      .on('click', function () {
        $('.navbar-toggler').attr('aria-expanted');
        handleNavbar();
      })
    $(document).mouseup(function (e) {
      // close when click other area
      if (navExpanded()) {
        if (!$navbar.is(e.target) && $navbar.has(e.target).length === 0 && navbarShown()) {
          $navButton.trigger('click');
        }
        if ($navItems.is(e.target)) {
          $navButton.trigger('click');
        }
      }
    });

    if (param === 'resize') {
      if (navExpanded()) {
        $navButton.trigger('click');
      }
    }
  }

  $(document).ready(function () {
    hoverAnim();
    resize();
    fullpage();
    shuffle();
    lightGallery();
    owl();
    owlShort();
    $('#bootstrap-overrides').css('visibility', 'visible');
    scrollTop();
    navToggle();
    
    console.log(magicalData);
  });
})(jQuery);