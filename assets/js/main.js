jQuery(function ($) {
  /**
   * preload images
   */
  function getBgUrl(el) {
    var bg = "";
    if (el.currentStyle) {
      // IE
      bg = el.currentStyle.backgroundImage;
    } else if (document.defaultView && document.defaultView.getComputedStyle) {
      // Firefox
      bg = document.defaultView.getComputedStyle(el, "").backgroundImage;
    } else {
      // try and get inline style
      bg = el.style.backgroundImage;
    }
    return bg.replace(/url\(['"]?(.*?)['"]?\)/i, "$1");
  }

  var $preloadElements = $(".preload-this:not(.slick-cloned)");

  if ($preloadElements.length !== 0) {
    $preloadElements.each(function () {
      var el = $(this);
      var image = document.createElement("img");
      image.src = getBgUrl(el[0]);
      image.onload = function () {
        el.addClass("loaded");
      };
    });
  }

  // var docu = $(document).width();
  // var wind = $(window).width();
  // var zoom = docu / wind;
  // console.log(zoom + " " + docu + " " + wind);
  // $(window).resize(function() {
  //     var root = document.documentElement;
  //     var docu = $(document).width();
  //     var wind = $(window).width();
  //     var zoomNew = docu / wind;
  //     // console.log(zoomNew + " " + docu + " " + wind);
  //     // console.log("Base Zoom: " + zoom + "\nNew Zoom: " + zoomNew);
  // console.log(document.documentElement.clientWidth + " " + window.innerWidth);
  //     if (zoom != zoomNew) {
  //       $('body').addClass('zoomed');
  //       root.style.setProperty('--zoomed', zoomNew);
  //     } else {
  //       $('body').removeClass('zoomed');
  //       root.style.setProperty('--zoomed', 1);
  //     }
  // });
});
