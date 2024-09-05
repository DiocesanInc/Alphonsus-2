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
});
