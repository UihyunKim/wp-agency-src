(function ($) {

  let windowWidth = $(window).width();
  let imgCrops = [];
  let blackNavs = [];
  let currSlide = null;
  let navTooltips = [];
  let pgBars = [];
  let prxBgs = [];

  const resize = function () {
    $(window)
      .resize(function (e) {
        windowWidth = $(window).width();
        navColor();
        imgCrop();
      });
  }

  const prxBg = function () {
    if (prxBgs.map(bg => bg.slide).includes(currSlide)) {
      const prx = prxBgs.filter(bg => bg.slide === currSlide)[0]['class'];
      $('#bootstrap-overrides')
        .removeClass()
        .addClass(prx);
    }
  }

  var animationEnd = (function (el) {
    var animations = {
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
      $('#s5-img').css('height', (windowWidth < 576
        ? height
        : 'auto'));
    }
  }

  const fullpage = function () {
    // Front page
    if ($('#fullpage-front').length) {
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
          class: 'prx-1'
        }, {
          slide: 5,
          class: 'prx-2'
        }, {
          slide: 7,
          class: 'prx-3'
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
        },
        onLeave: function (idx, nextIdx, direction) { //
          currSlide = nextIdx;
          navColor();
          pgBarAnim();
          prxBg();
        }
      });
    } else if ($('#fp-news').length) {
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
  } // end fulpage

  $(document).ready(function () {
    hoverAnim();
    resize();
    fullpage();
    $('#bootstrap-overrides').removeClass('d-none');
  });

})(jQuery);