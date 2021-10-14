
ScrollReveal().reveal('.headline', {
  reset: true,
  distance: '120%',
  origin: 'bottom',
  duration: 1000,
  easing: 'cubic-bezier(0.5, 0, 0, 1)',
  interval: 1
});


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


const tl = gsap.timeline(), 
    title = new SplitText("#hero-text", {type:"words"}), 
    words = title.words;

tl.from(words, {duration: 1.2, opacity:0, x:-40, ease:"back", stagger: 0.2});