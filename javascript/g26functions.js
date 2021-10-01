(function () {
 new LocomotiveScroll({
  smooth: true
 });
})();

(() => {
  window.addEventListener("scroll", () => {
    let scroll = this.scrollY;
    const el = document.getElementById('main-header');
   if(scroll <= 100) {
    el.classList.remove('scrolled')
   } else {
     el.classList.add('scrolled')
   }
});
})();