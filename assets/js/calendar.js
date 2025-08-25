jQuery(function ($) {
  var dateArray = new Array();

  //Links each day to its set of events
  var count = 0;
  $(".simcal-day-label").each(function () {
    $(this).attr("data-simcal", count);
    $(this)
      .next(".simcal-day")
      .find("ul.simcal-events")
      .attr("data-simcal", count);
    count++;
  });

  //Add class to today's date
  $('.simcal-day-label[style*="border-bottom: 1px solid #dedede;"]').each(
    function () {
      $(this).addClass("simcal-today");
      $(this).find("> span").addClass("simcal-today");
      var current = $(this).attr("data-simcal");
      $(".calendar-inner ul.simcal-events").removeClass("simcal-visible");
      $(
        ".calendar-inner ul.simcal-events[data-simcal=" + current + "]"
      ).addClass("simcal-visible");
    }
  );

  //Moves active class to selected date
  $(".simcal-day-label > span").on("click", function () {
    $(".simcal-day-label > span").each(function () {
      $(this).removeClass("simcal-current");
    });
    $(this).addClass("simcal-current");

    var current = $(this).parent().attr("data-simcal");
    $(".calendar-inner ul.simcal-events").removeClass("simcal-visible");
    $(".calendar-inner ul.simcal-events[data-simcal=" + current + "]").addClass(
      "simcal-visible"
    );
  });

  //Shorthand day names to 2 letters, then move them to slider
  $(".simcal-day-label").each(function () {
    switch($("html").attr("lang")) {
      case 'en-US':    
        var dayArray = new Array("SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT");
        break;
      case 'es':    
        var dayArray = new Array("DOM", "LUN", "MAR", "MI&#xC9;", "JUE", "VIE", "S&#xC1;B");
        break;
        
      default:
        var dayArray = new Array("SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT");
    }
    var i;
    for (i = 0; i < 7; i++) {
      if (
        $(this)
          .next(".simcal-day")
          .hasClass("simcal-weekday-" + i)
      ) {
        $(this).find(".simcal-date-format").prepend(`${dayArray[i]}<br/>`);
      }
    }

    $(".calendar-weekday-slick").append($(this));
  });

  //Moves each date's events to the slick slider
  $("dd.simcal-day").each(function () {
    $(".calendar-event-slick").append($(this));
  });

  let slidesMobile = 3;
  let slidesLaptop = 5;
  let slidesDesktop = 7;

  if ($(".calendar-weekday-slick").parents(".homepage-section-cols").length) {
    slidesLaptop = 5;
    slidesDesktop = 5;
  }

  $(".page-template-homepage .calendar-weekday-slick").slick({
    autoplay: false,
    arrows: true,
    cssEase: "linear",
    dots: false,
    fade: false,
    infinite: true,
    slidesToShow: slidesMobile,
    slidesToScroll: 1,
    useTransform: false,
    swipeToSlide: true,
    touchThreshold: 10,
    initialSlide: $("dt.simcal-today").index(),
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: slidesLaptop,
        },
      },
      {
        breakpoint: 1280,
        settings: {
          slidesToShow: slidesDesktop,
        },
      },
    ],
  });

  /**
   * Close button on mobile full calendar popups(qtips)
   */
  if ($("body:has(.simcal-default-calendar-grid)")) {
    // Select the target node
    var targetNode = document.querySelector("body");

    // Options for the observer (which mutations to observe)
    var config = { childList: true, subtree: true };

    // Callback function to execute when mutations are observed
    var callback = function (mutationsList, observer) {
      for (var mutation of mutationsList) {
        if (mutation.type === "childList") {
          // Check if .qtip element is added
          if (mutation.addedNodes && mutation.addedNodes.length) {
            mutation.addedNodes.forEach(function (node) {
              if (node.classList && node.classList.contains("qtip")) {
                // Append close button to .qtip
                var closeButton = document.createElement("div");
                closeButton.classList.add("close-button");
                closeButton.innerHTML = "<i class='fa-solid fa-xmark'></i>";
                closeButton.addEventListener("click", function () {
                  node.style.removeProperty("top");
                  node.style.removeProperty("left");
                  node.style.removeProperty("display");
                  node.classList.remove("qtip-focus");
                });
                node.appendChild(closeButton);
              }
            });
          }
        }
      }
    };

    // Create a MutationObserver instance
    var observer = new MutationObserver(callback);

    // Start observing the target node for configured mutations
    observer.observe(targetNode, config);
  }
});
