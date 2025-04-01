//vanilla javascript on document loaded
document.addEventListener("DOMContentLoaded", function () {
  //set isIos to true if the user agent indicates an iPad, iPhone, or iPod and we’re not on a Windows device
  const isIos =
    /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
  if (isIos) {
    document.body.classList.add("ios");
  }
});
