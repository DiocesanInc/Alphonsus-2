jQuery(function ($) {
  /**
   * Simple Calendar (list view) skips days with no events.
   * This script reconstructs missing days by resolving real dates from the day labels,
   * using event text only as a month/year anchor when it matches the rendered day.
   * It then inserts placeholder days with "No Events" and proceeds with your Slick setup.
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

  function startOfDay(d) {
    const x = new Date(d);
    x.setHours(0, 0, 0, 0);
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

  function getDayNumberFromLabel($dt) {
    const text = $dt.find(".simcal-date-format").first().text().trim();
    const match = text.match(/\b(\d{1,2})\b/);
    if (!match) return null;

    const day = parseInt(match[1], 10);
    return day >= 1 && day <= 31 ? day : null;
  }

  function nextOccurrenceOfDay(afterDate, dayNumber) {
    let cursor = startOfDay(addDays(afterDate, 1));
    let safety = 370;

    while (safety > 0) {
      if (cursor.getDate() === dayNumber) return cursor;
      cursor = addDays(cursor, 1);
      safety--;
    }

    return null;
  }

  function previousOccurrenceOfDay(beforeDate, dayNumber) {
    let cursor = startOfDay(addDays(beforeDate, -1));
    let safety = 370;

    while (safety > 0) {
      if (cursor.getDate() === dayNumber) return cursor;
      cursor = addDays(cursor, -1);
      safety--;
    }

    return null;
  }

  function resolveCalendarDates($dts) {
    const yearGuess = new Date().getFullYear();
    const today = startOfDay(new Date());
    const records = [];

    $dts.each(function () {
      const $dt = $(this);
      const $dd = $dt.next("dd.simcal-day");
      if (!$dd.length) return;

      const dayNumber = getDayNumberFromLabel($dt);
      if (!dayNumber) return;

      const parsedDate = parseDateFromDayDd($dd, yearGuess);
      const isTrustedAnchor =
        parsedDate && startOfDay(parsedDate).getDate() === dayNumber;

      records.push({
        $dt,
        $dd,
        dayNumber,
        date: isTrustedAnchor ? startOfDay(parsedDate) : null,
      });
    });

    if (!records.length) return records;

    let firstKnownIndex = records.findIndex((record) => record.date);

    if (firstKnownIndex === -1) {
      const todayIndex = records.findIndex(
        (record) => record.dayNumber === today.getDate(),
      );

      if (todayIndex !== -1) {
        records[todayIndex].date = startOfDay(today);
        firstKnownIndex = todayIndex;
      } else {
        let fallback = startOfDay(
          new Date(today.getFullYear(), today.getMonth(), records[0].dayNumber),
        );

        while (fallback < today) {
          fallback = startOfDay(
            new Date(
              fallback.getFullYear(),
              fallback.getMonth() + 1,
              records[0].dayNumber,
            ),
          );
        }

        records[0].date = fallback;
        firstKnownIndex = 0;
      }
    }

    for (let i = firstKnownIndex - 1; i >= 0; i--) {
      records[i].date = previousOccurrenceOfDay(
        records[i + 1].date,
        records[i].dayNumber,
      );
    }

    for (let i = firstKnownIndex + 1; i < records.length; i++) {
      const expectedDate = nextOccurrenceOfDay(
        records[i - 1].date,
        records[i].dayNumber,
      );

      if (!records[i].date) {
        records[i].date = expectedDate;
        continue;
      }

      if (records[i].date <= records[i - 1].date) {
        records[i].date = expectedDate;
      }
    }

    return records.filter((record) => record.date);
  }

  /**
   * Fill gaps between existing dt/dd pairs after resolving the actual date for each day.
   * Inserts missing dt/dd pairs with a "No Events" placeholder.
   *
   * IMPORTANT: This runs BEFORE we assign data-simcal indices and before we move
   * elements into Slick containers.
   */
  function normalizeCalendarDays() {
    const $inner = $(".calendar-inner");
    const $dts = $inner.find("dt.simcal-day-label");
    if (!$dts.length) return;

    // Resolve each day from its label order first.
    // The event body can be misleading for expanded multi-day events because it
    // often repeats the original event date instead of the rendered calendar day.
    const records = resolveCalendarDates($dts);
    if (!records.length) return;

    records.forEach(({ $dt, date }) => {
      $dt.attr("data-iso", toISO(date));
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

  function getEventCalendarIds(className) {
    const matches =
      String(className || "").match(/simcal-events-calendar-(\d+)/g) || [];

    return matches.map((match) => match.replace("simcal-events-calendar-", ""));
  }

  function getActiveCalendarIds($container) {
    return $container
      .find(".calendar-filter__input:checked")
      .map(function () {
        return String($(this).val());
      })
      .get();
  }

  function eventMatchesActiveCalendars(className, activeCalendarSet) {
    const eventCalendarIds = getEventCalendarIds(className);

    return (
      !eventCalendarIds.length ||
      eventCalendarIds.some((calendarId) => activeCalendarSet.has(calendarId))
    );
  }

  function getFilterEmptyStateMarkup(message) {
    return $(`
      <li class="simcal-event simcal-no-events simcal-filter-empty-state">
        <div class="simcal-event-details">
          <div class="event-item">
            <div class="event-title">${message}</div>
          </div>
        </div>
      </li>
    `);
  }

  function getPopupEmptyStateMarkup(message) {
    return $(`
      <div class="simcal-filter-empty-message">${message}</div>
    `);
  }

  function applyListCalendarFilters($container) {
    const activeCalendarIds = getActiveCalendarIds($container);
    const activeCalendarSet = new Set(activeCalendarIds);
    const emptyMessage = activeCalendarIds.length
      ? "No matching events"
      : "No calendars selected";

    $container.find(".calendar-event-slick ul.simcal-events").each(function () {
      const $list = $(this);
      const $realEvents = $list
        .children("li.simcal-event")
        .not(".simcal-no-events, .simcal-filter-empty-state");
      const $nativeEmptyState = $list
        .children("li.simcal-no-events")
        .not(".simcal-filter-empty-state");
      let $generatedEmptyState = $list.children(".simcal-filter-empty-state");

      if (!$generatedEmptyState.length) {
        $generatedEmptyState = getFilterEmptyStateMarkup(emptyMessage).appendTo(
          $list,
        );
      }

      $generatedEmptyState.find(".event-title").text(emptyMessage);

      $realEvents.each(function () {
        $(this).toggleClass(
          "simcal-filter-hidden",
          !eventMatchesActiveCalendars(this.className, activeCalendarSet),
        );
      });

      const visibleRealEvents = $realEvents.not(".simcal-filter-hidden").length;
      const hasRealEvents = $realEvents.length > 0;
      const showGeneratedEmptyState =
        activeCalendarIds.length === 0 ||
        (hasRealEvents && visibleRealEvents === 0);
      const showNativeEmptyState =
        activeCalendarIds.length > 0 && !hasRealEvents;

      $nativeEmptyState.toggleClass(
        "simcal-filter-hidden",
        !showNativeEmptyState,
      );
      $generatedEmptyState.toggleClass(
        "simcal-filter-hidden",
        !showGeneratedEmptyState,
      );
    });
  }

  function applyGridPopupCalendarFilters($container, activeCalendarSet) {
    const activeCalendarIds = Array.from(activeCalendarSet);
    const emptyMessage = activeCalendarIds.length
      ? "No matching events"
      : "No calendars selected";

    $(".qtip.simcal-event-bubble").each(function () {
      const $popup = $(this);
      const $events = $popup.find(".simcal-event");
      if (!$events.length) return;

      $events.each(function () {
        $(this).toggleClass(
          "simcal-filter-hidden",
          !eventMatchesActiveCalendars(this.className, activeCalendarSet),
        );
      });

      const $content = $popup.find(".qtip-content").first().length
        ? $popup.find(".qtip-content").first()
        : $popup;
      let $emptyState = $content.find(".simcal-filter-empty-message");

      if (!$emptyState.length) {
        $emptyState = getPopupEmptyStateMarkup(emptyMessage).appendTo($content);
      }

      $emptyState.text(emptyMessage);
      $emptyState.toggleClass(
        "simcal-filter-hidden",
        $events.not(".simcal-filter-hidden").length > 0,
      );
    });
  }

  function applyGridCalendarFilters($container) {
    const activeCalendarIds = getActiveCalendarIds($container);
    const activeCalendarSet = new Set(activeCalendarIds);
    const $grid = $container.find(".simcal-default-calendar-grid");

    if (!$grid.length) return;

    $grid.find(".simcal-event").each(function () {
      $(this).toggleClass(
        "simcal-filter-hidden",
        !eventMatchesActiveCalendars(this.className, activeCalendarSet),
      );
    });

    $grid.find("td, .simcal-day").each(function () {
      const $day = $(this);
      const $dayEvents = $day.find(".simcal-event");

      if (!$dayEvents.length) return;

      const visibleEvents = $dayEvents.not(".simcal-filter-hidden").length;
      const $dots = $day.find(".simcal-events-dots").first();

      $day.toggleClass("simcal-filter-day-empty", visibleEvents === 0);

      if ($dots.length) {
        $dots.toggleClass("simcal-filter-hidden", visibleEvents === 0);
      }
    });

    applyGridPopupCalendarFilters($container, activeCalendarSet);
  }

  $("[data-simcal-filter-root]").each(function () {
    const $container = $(this);
    const $filters = $container.find(".calendar-filter__input");

    if (!$filters.length) return;

    const syncCalendarFilters = function () {
      applyListCalendarFilters($container);
      applyGridCalendarFilters($container);
    };

    $filters.on("change", syncCalendarFilters);
    syncCalendarFilters();
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

              $("[data-simcal-filter-root]").each(function () {
                const $container = $(this);
                const $filters = $container.find(".calendar-filter__input");

                if (
                  !$filters.length ||
                  !$container.find(".simcal-default-calendar-grid").length
                ) {
                  return;
                }

                applyGridPopupCalendarFilters(
                  $container,
                  new Set(getActiveCalendarIds($container)),
                );
              });
            }
          });
        }
      }
    };

    var observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
  }
});
