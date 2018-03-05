// 
// fullpage.js
// 
$(function () {
  
  let windowWidth = $(window).width();
  let slideIndex;
  const navBgs = [4, 6];

  const navBg = function (param) {
    param == 'on' ? $('nav').css('background-color', 'rgba(0,0,0,0.7)') : '';
    param == 'off' ? $('nav').css('background-color', 'rgba(0,0,0,0)') : '';
  }

  const imgCrop = function () {
    // Crop image
    if (windowWidth < 576) {
      // measure height
      const hWindow = $(window).height();
      const hNav = $('nav').outerHeight(); 
      const hBody = $('#s5-body').outerHeight();
      const height = hWindow - hNav - hBody +'px';

      $('#s5-img').css('height', height);
    }

    // No-crop image
    else {
      $('#s5-img').css('height', 'auto');
    }
  }

  $(window).resize(function (e) {
    windowWidth = $(window).width();

    // NAV BG COLOR
    windowWidth < 992 ? navBg('off') : navBg('on');

    // SECTION5 SMARTPHONE IMAGE CROP
    imgCrop();
  });

  $('#fullpage').fullpage({
    afterLoad : function (anchorLink, idx) {
      slideIndex = idx;

      // progress bar animation start
      if (idx == 5) {
        $('.prb-1').css('width', '80%');
        $('.prb-2').css('width', '90%');
        $('.prb-3').css('width', '100%');
      } else {
        $('.progress-bar').css('width', '0%');
      }

      // SECTION5 IMAGE CROP
      imgCrop();
    },

    onLeave: function(idx, nextIdx, direction){
      
      // add bg-color on nav when white bg
      // only working bigger than md screen size
      if (windowWidth >= 992) {
        if (navBgs.includes(idx)) { navBg('off'); }
        else if (navBgs.includes(nextIdx)) { navBg('on'); }
      }

      // change parallax background image
      if (nextIdx == 1) {
        $('#bootstrap-overrides')
          .removeClass()
          .addClass('prx-1');
      } 
      else if (nextIdx == 5) {
        $('#bootstrap-overrides')
          .removeClass()
          .addClass('prx-2');
      }
      else if (nextIdx == 7) {
        $('#bootstrap-overrides')
          .removeClass()
          .addClass('prx-3');
      }

    },

  });
});


//
// animate.js
//
$(function() {
  $('#fullpage .scroll-down')
    .mouseenter(function() {
      $('.arrow', this).addClass('animated infinite bounce');
    })
    .mouseleave(function() {
      $('.arrow', this).removeClass('animated infinite bounce');
    });

});
