jQuery(document).ready(function ($) {
  const tablet = 768;
  const laptop = 992;
  const desktop = 1279;

  function isParallax($slider) {
    $slider.on("init", function (event, slick) {
      $(this).find(".slick-list").css("transform", "none");
      $(this).find(".slick-track").css("transform", "none");
    });
  }

  /** Hero Slider */
  const $hero_slider = $(".page-template-homepage .hero-slider");
  const hero_parallax = $hero_slider.data("parallax");
  const hero_autoplay = $hero_slider.data("autoplay");
  const show_welcome = $(".page-template-homepage .hero").data("showWelcome");
  const hero_has_dots = show_welcome ? $hero_slider.data("hasDots") : false;
  const hero_has_arrows = $hero_slider.data("hasArrows");

  if (hero_parallax) {
    isParallax($hero_slider);
  }

  $hero_slider.slick({
    autoplay: hero_autoplay,
    arrows: hero_has_arrows,
    cssEase: "linear",
    dots: hero_has_dots,
    fade: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    useTransform: false,
    useCss: false,
  });

  /**Content Slider */
  const $content_slider = $(
    ".page-template-homepage .content-slider-container [data-is-slider='true']"
  );

  // isParallax($content_slider);

  $content_slider.on(
    "beforeChange",
    function (event, slick, currentSlide, nextSlide) {
      $content_slider.find(".slick-dots li").removeClass("slick-dot-active");
      $content_slider
        .find(`.slick-dots li:nth-child(${nextSlide + 1})`)
        .addClass("slick-dot-active");
    }
  );

  isParallax($content_slider);

  $content_slider.slick({
    autoplay: false,
    arrows: true,
    dots: true,
    cssEase: "linear",
    fade: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    appendDots: $(".slick-dots-wrapper"),
    useTransform: false,
    useCss: false,
  });

  /** News Slider */
  let newsSlidesMobile = 1;
  let newsSlidesLaptop = 2;
  let newsSlidesDesktop = 3;

  if ($(".calendar-weekday-slick").parents(".homepage-section-cols").length) {
    newsSlidesDesktop = 1;
    newsSlidesLaptop = 1;
  }

  $(".page-template-homepage .news-posts").slick({
    autoplay: false,
    arrows: true,
    cssEase: "linear",
    dots: false,
    fade: false,
    infinite: true,
    slidesToShow: newsSlidesMobile,
    slidesToScroll: 1,
    useTransform: false,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: tablet,
        settings: {
          slidesToShow: newsSlidesLaptop,
        },
      },
      {
        breakpoint: desktop,
        settings: {
          slidesToShow: newsSlidesDesktop,
        },
      },
    ],
  });

  /** Ministry Slider */
  const $ministryGroups = $(
    ".ministries-container .ministry-slider .ministry-group"
  );

  $ministryGroups.slick({
    autoplay: false,
    arrows: true,
    dots: false,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    mobileFirst: true,
    slide: ".ministry-wrapper",
    responsive: [
      {
        breakpoint: tablet,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: laptop,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: desktop,
        settings: {
          slidesToShow: 4,
        },
      },
    ],
  });
});
