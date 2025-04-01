jQuery(($) => {
  const theCarousel = () => {
    const $c = $(".page-template-page-homepage .carousel");
    if ($c.length == 0) return;
    $(".page-template-page-homepage .carousel").carousel({
      numVisible: 5,
      padding: 125,
    });
  };

  theCarousel();
  $(window).on("resize orientationchange", () => {
    theCarousel();
  });

  $(".carousel-arrows i").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    const controls = "." + $(this).parent().attr("data-controls");
    $(controls).carousel($(this).attr("data-direction"));
  });
});
