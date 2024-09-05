/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

window.addEventListener("scroll", () => stickyHeader());

const stickyHeader = () => {
  if (!document.getElementById("masthead")) return;
  const header = document.getElementById("masthead");
  const sticky = header.offsetTop;
  const hcl = header.classList;
  const tb = document.querySelector("#header-top-bar");
  const tbcl = tb.classList;
  if (window.scrollY > sticky) {
    hcl.add("sticky");
    tbcl.add("hidden");
  } else {
    hcl.remove("sticky");
    tbcl.remove("hidden");
  }
};
