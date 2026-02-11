jQuery(function ($) {
  /**
   * Simple Calendar (list view) skips days with no events.
   * This script reconstructs missing days (based on dates found in each day's <dd>)
   * and inserts placeholder days with "No Events", then proceeds with your Slick setup.
   *
   * Settings for Simple Calendar Plugin:
   * Calendar View: List
   *
   * Events:
   *     - Calendar Start: Today makes the most sense, but can be anything
   *     - Earliest Event: Same as start date
   *     - Latest Event: Doesn't matter, as long as it's after the start date
   *
   * Advanced:
   *     - Date Format: Custom (PHP format) -> d
   */

  // -----------------------------
  // Helpers
  // -----------------------------
  function pad2(n) {
    return String(n).padStart(2, "0");
  }

  function toISO(d) {
    return `${d.getFullYear()}-${pad2(d.getMonth() + 1)}-${pad2(d.getDate())}`;
  }

  function addDays(d, days) {
    const x = new Date(d);
    x.setDate(x.getDate() + days);
    return x;
  }

  function monthMapForLang() {
    const lang = $("html").attr("lang") || "en-US";

    if (lang === "es") {
      // lowercase, to match normalized parsing
      return [
        "enero",
        "febrero",
        "marzo",
        "abril",
        "mayo",
        "junio",
        "julio",
        "agosto",
        "septiembre",
        "octubre",
        "noviembre",
        "diciembre",
      ];
    }

    // default English
    return [
      "january",
      "february",
      "march",
      "april",
      "may",
      "june",
      "july",
      "august",
      "september",
      "october",
      "november",
      "december",
    ];
  }

  /**
   * Parses a real JS Date from a dd.simcal-day by looking for a month name + day number.
   * Works for patterns like:
   * - "February 24 | 9:00 am - 10:00 am"
   * - "24 febrero | 9:00 - 10:00"
   *
   * If your format differs (e.g. "Feb 24, 2026"), tweak this function.
   */
  function parseDateFromDayDd($dd, currentYearGuess) {
    const months = monthMapForLang();
    const text = $dd.text().replace(/\s+/g, " ").trim().toLowerCase();

    let monthIndex = -1;
    let monthWord = null;

    for (let i = 0; i < months.length; i++) {
      if (text.includes(months[i])) {
        monthIndex = i;
        monthWord = months[i];
        break;
      }
    }
    if (monthIndex === -1) return null;

    // month then day: "february 24"
    let m = text.match(new RegExp(`${monthWord}\\s+(\\d{1,2})`, "i"));
    // day then month: "24 february"
    if (!m) m = text.match(new RegExp(`(\\d{1,2})\\s+${monthWord}`, "i"));
    if (!m) return null;

    const day = parseInt(m[1], 10);
    if (!day || day < 1 || day > 31) return null;

    return new Date(currentYearGuess, monthIndex, day);
  }

  /**
   * Fill gaps between existing dt/dd pairs by reading the real date from each dd.
   * Inserts missing dt/dd pairs with a "No Events" placeholder.
   *
   * IMPORTANT: This runs BEFORE we assign data-simcal indices and before we move
   * elements into Slick containers.
   */
  function normalizeCalendarDays() {
    const $inner = $(".calendar-inner");
    const $dts = $inner.find("dt.simcal-day-label");
    if (!$dts.length) return;

    const yearGuess = new Date().getFullYear();

    // Build ordered records of existing days with parsed real dates
    const records = [];
    $dts.each(function () {
      const $dt = $(this);
      const $dd = $dt.next("dd.simcal-day");
      if (!$dd.length) return;

      const realDate = parseDateFromDayDd($dd, yearGuess);
      if (!realDate) return;

      $dt.attr("data-iso", toISO(realDate));
      records.push({ $dt, $dd, date: realDate });
    });

    // If we only have ONE event day, generate the full month around it
    if (records.length === 1) {
      const only = records[0];

      // Render a rolling window so we always have "future" days even if the lone event is late-month.
      // Tune the window size as you like.
      const windowDaysBefore = 7; // show a little past
      const windowDaysAfter = 30; // show a decent future

      const today = new Date();
      today.setHours(0, 0, 0, 0);

      const rangeStart = addDays(today, -windowDaysBefore);
      const rangeEnd = addDays(today, windowDaysAfter);

      // Fill days BEFORE the existing day (insert *before* that dt)
      let cursor = new Date(rangeStart);
      while (cursor < only.date && cursor <= rangeEnd) {
        const weekday = cursor.getDay();
        const dayNum = pad2(cursor.getDate());
        const iso = toISO(cursor);

        const $newDt = $(`
      <dt class="simcal-day-label" data-iso="${iso}">
        <span>
          <span class="simcal-date-format" data-date-format="d">${dayNum}</span>
        </span>
      </dt>
    `);

        const $newDd = $(`
      <dd class="simcal-day simcal-weekday-${weekday}">
            <ul class="simcal-events">
              <li class="simcal-no-events simcal-event">
                <div class="simcal-event-details">
                  <div class="event-item">
                    <div class="event-title">No Events</div>
                  </div>
                </div>
              </li>
            </ul>
          </dd>
    `);

        // Insert before the existing dt (and its dd)
        only.$dt.before($newDt);
        only.$dt.before($newDd);

        cursor = addDays(cursor, 1);
      }

      // Fill days AFTER the existing day (insert after its dd)
      cursor = addDays(only.date, 1);
      let anchorDd = only.$dd;
      while (cursor <= rangeEnd) {
        const weekday = cursor.getDay();
        const dayNum = pad2(cursor.getDate());
        const iso = toISO(cursor);

        const $newDt = $(`
      <dt class="simcal-day-label" data-iso="${iso}">
        <span>
          <span class="simcal-date-format" data-date-format="d">${dayNum}</span>
        </span>
      </dt>
    `);

        const $newDd = $(`
      <dd class="simcal-day simcal-weekday-${weekday}">
            <ul class="simcal-events">
              <li class="simcal-no-events simcal-event">
                <div class="simcal-event-details">
                  <div class="event-item">
                    <div class="event-title">No Events</div>
                  </div>
                </div>
              </li>
            </ul>
          </dd>
    `);

        anchorDd.after($newDd);
        anchorDd.after($newDt);

        anchorDd = $newDd;
        cursor = addDays(cursor, 1);
      }

      // Done, don't run the "gap between records" logic
      return;
    }

    // Otherwise (2+ days), fill gaps between consecutive records as before
    if (records.length < 2) return;

    // Handle year rollover (Dec -> Jan) while walking in DOM order
    for (let i = 1; i < records.length; i++) {
      const prev = records[i - 1].date;
      const cur = records[i].date;

      // If we go from December to January, bump year
      if (prev.getMonth() === 11 && cur.getMonth() === 0 && cur < prev) {
        cur.setFullYear(prev.getFullYear() + 1);
        records[i].date = cur;
        records[i].$dt.attr("data-iso", toISO(cur));
      }
    }

    // Fill gaps between consecutive records
    for (let i = 1; i < records.length; i++) {
      // Anchor insertion after the "previous" day
      let anchorDt = records[i - 1].$dt;
      let anchorDd = records[i - 1].$dd;
      const nextDate = records[i].date;

      let cursor = addDays(records[i - 1].date, 1);
      while (cursor < nextDate) {
        const weekday = cursor.getDay(); // 0-6 (Sun-Sat)
        const dayNum = pad2(cursor.getDate());
        const iso = toISO(cursor);

        // Create placeholder dt/dd pair compatible with your existing logic
        const $newDt = $(`
          <dt class="simcal-day-label" data-iso="${iso}">
            <span>
              <span class="simcal-date-format" data-date-format="d">${dayNum}</span>
            </span>
          </dt>
        `);

        const $newDd = $(`
          <dd class="simcal-day simcal-weekday-${weekday}">
            <ul class="simcal-events">
              <li class="simcal-no-events simcal-event">
                <div class="simcal-event-details">
                  <div class="event-item">
                    <div class="event-title">No Events</div>
                  </div>
                </div>
              </li>
            </ul>
          </dd>
        `);

        // Insert after the current anchor dd so order stays intact
        anchorDd.after($newDd);
        anchorDd.after($newDt);

        // Move anchor forward for multiple missing days
        anchorDt = $newDt;
        anchorDd = $newDd;

        cursor = addDays(cursor, 1);
      }
    }
  }

  // -----------------------------
  // 0) Fill missing days first
  // -----------------------------
  normalizeCalendarDays();

  // -----------------------------
  // 1) Link each day to its set of events
  // -----------------------------
  var count = 0;
  $(".simcal-day-label").each(function () {
    $(this).attr("data-simcal", count);
    $(this)
      .next(".simcal-day")
      .find("ul.simcal-events")
      .attr("data-simcal", count);
    count++;
  });

  // -----------------------------
  // 2) Mark today (dynamic, no hardcoded index)
  // -----------------------------
  const now = new Date();
  const todayISO = toISO(now);

  const $todayDt = $(`.simcal-day-label[data-iso="${todayISO}"]`).first();
  if ($todayDt.length) {
    $todayDt.addClass("simcal-today");
    $todayDt.find("> span").addClass("simcal-today");

    const current = $todayDt.attr("data-simcal");
    $(".calendar-inner ul.simcal-events").removeClass("simcal-visible");
    $(`.calendar-inner ul.simcal-events[data-simcal="${current}"]`).addClass(
      "simcal-visible",
    );
  } else {
    // Fallback: show first day
    const $first = $(".simcal-day-label").first();
    $first.addClass("simcal-today");
    $first.find("> span").addClass("simcal-today");

    const current = $first.attr("data-simcal");
    $(".calendar-inner ul.simcal-events").removeClass("simcal-visible");
    $(`.calendar-inner ul.simcal-events[data-simcal="${current}"]`).addClass(
      "simcal-visible",
    );
  }

  // -----------------------------
  // 3) Move active class to selected date
  // -----------------------------
  $(".simcal-day-label > span").on("click", function () {
    $(".simcal-day-label > span").removeClass("simcal-current");
    $(this).addClass("simcal-current");

    var current = $(this).parent().attr("data-simcal");
    $(".calendar-inner ul.simcal-events").removeClass("simcal-visible");
    $(`.calendar-inner ul.simcal-events[data-simcal="${current}"]`).addClass(
      "simcal-visible",
    );
  });

  // -----------------------------
  // 4) Shorthand day names to 2 letters, then move them to slider
  // -----------------------------
  $(".simcal-day-label").each(function () {
    let dayArray;
    switch ($("html").attr("lang")) {
      case "en-US":
        dayArray = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
        break;
      case "es":
        dayArray = ["DOM", "LUN", "MAR", "MI&#xC9;", "JUE", "VIE", "S&#xC1;B"];
        break;
      default:
        dayArray = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
    }

    for (let i = 0; i < 7; i++) {
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

  // -----------------------------
  // 5) Move each date's events to the slick slider
  // -----------------------------
  $("dd.simcal-day").each(function () {
    $(".calendar-event-slick").append($(this));
  });

  // -----------------------------
  // 6) Slick init
  // -----------------------------
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
    infinite: false,
    slidesToShow: slidesMobile,
    slidesToScroll: 1,
    useTransform: false,
    swipeToSlide: true,
    touchThreshold: 10,
    initialSlide:
      $("dt.simcal-today").index() >= 0 ? $("dt.simcal-today").index() : 0,
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

  // -----------------------------
  // 7) Close button on mobile full calendar popups (qTips)
  // -----------------------------
  if ($("body:has(.simcal-default-calendar-grid)")) {
    var targetNode = document.querySelector("body");
    var config = { childList: true, subtree: true };

    var callback = function (mutationsList) {
      for (var mutation of mutationsList) {
        if (
          mutation.type === "childList" &&
          mutation.addedNodes &&
          mutation.addedNodes.length
        ) {
          mutation.addedNodes.forEach(function (node) {
            if (node.classList && node.classList.contains("qtip")) {
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
    };

    var observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
  }
});
