// 
// fullpage.js
// 
$(function () {
  
  let windowWidth = $(window).width();
  let currSlide;
  const navColors = [4, 6];

  const navColor = function () {
    if (windowWidth >= 992) {
      
      if (navColors.includes(currSlide)) {
        $('nav a').css('color', 'black');
        $('#sns img').css('filter', 'invert(100%)');
      } else {
        $('nav a').css('color', 'white');
        $('#sns img').css('filter', 'invert(0%)');
      }
      
    } else {
      $('nav a').css('color', 'white');
      $('#sns img').css('filter', 'invert(0%)');
    }
    
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
    windowWidth < 992 ? navColor('white') : navColor('black');

    // SECTION5 SMARTPHONE IMAGE CROP
    imgCrop();
  });

  $('#fullpage').fullpage({
    afterLoad : function (anchorLink, idx) {
      currSlide = idx;

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
      
      // Change color on nav when white bg
      // only working bigger than md screen size
      currSlide = nextIdx;
      navColor();

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

//
// animation on loading
//

$(function () {
  $('#bootstrap-overrides').removeClass('d-none');
});