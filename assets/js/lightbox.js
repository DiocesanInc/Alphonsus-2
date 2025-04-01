jQuery(function ($) {
  document.addEventListener("click", function (e) {
    if (
      e.target.matches(
        ".ministry-slider[data-has-lightbox='true'] .ministry-wrapper.slick-active"
      )
    ) {
      document.querySelector(".lightbox").classList.add("open");
      document.querySelector(".lightbox-overlay").style.display = "block";

      $("html, body").toggleClass("no-scroll");
      let title = e.target.dataset.title;
      let excerpt = e.target.dataset.excerpt;
      let contact = e.target.dataset.contact;
      let image = e.target.dataset.image;
      let link = e.target.dataset.link;

      $("input[type=checkbox]").prop("checked", false);
      let clicked = document.querySelector(
        "form input[type='checkbox'][value='${title}']"
      );

      if (clicked !== null) {
        clicked.checked = true;
      }

      let lbTitle = document
        .querySelector(".lightbox")
        .querySelector(".lightbox-title");

      let lbExcerpt = document
        .querySelector(".lightbox")
        .querySelector(".lightbox-excerpt");

      let lbContactPersons = document
        .querySelector(".lightbox")
        .querySelector(".lightbox-contact-persons");

      let lbImage = document
        .querySelector(".lightbox")
        .querySelector(".lightbox-image");

      let lbLink = document
        .querySelector(".lightbox")
        .querySelector(".lightbox-link");

      if (lbTitle) {
        lbTitle.innerHTML = title;
      }

      if (lbExcerpt) {
        lbExcerpt.innerHTML = excerpt;
      }

      if (lbContactPersons) {
        lbContactPersons.innerHTML = contact;
      }

      if (lbImage) {
        lbImage.style.backgroundImage = "url(" + image + ")";
      }

      if (lbLink) {
        lbLink.innerHTML =
          "<a class='read-more-link has-underline-hover has-primary-color-after' href=" +
          link +
          " title='read more'>Learn more ></a>";
      }

      return;
    }
    if (
      e.target.matches(".lightbox-overlay") ||
      e.target.matches(".lightbox-close")
    ) {
      $(".lightbox").removeClass("open");
      $("html, body").toggleClass("no-scroll");
      document.querySelector(".lightbox-overlay").style.display = "none";

      return;
    }
  });
  var checked;

  jQuery(document).on("gform_post_render", function () {
    if (checked !== undefined) {
      checked.each(function () {
        let id = $(this).attr("id");
        document.querySelector(
          "form input[type='checkbox'][id='" + id + "']"
        ).checked = true;
      });
    }

    $("form li.ministry-group").on("click", function () {
      if ($(this).hasClass("active")) return;

      $("form .ministry-group.active").removeClass("active");
      $("form .ministry-list.active").slideUp(400, function () {
        $(this).removeClass("active");
      });
      $(this).addClass("active");
      let id = $(this).attr("data-ministry-list-id");
      $("#ministry-list-" + id)
        .addClass("active")
        .slideDown();
    });

    $("form").on("submit", function () {
      checked = $(this).find(
        ".ministry-group-list input[type=checkbox]:checked"
      );
    });
  });
});
