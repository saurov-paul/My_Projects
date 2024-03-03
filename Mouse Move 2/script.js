window.addEventListener("mousemove", function (details) {
  let rectangle = document.querySelector("#rectangle");

  let rectval = gsap.utils.mapRange(
    0,
    window.innerWidth,
    100 + rectangle.getBoundingClientRect().width / 2,
    window.innerWidth - (100 + rectangle.getBoundingClientRect().width / 2),
    details.clientX
  );

  gsap.to("#rectangle", {
    left: rectval ,
    ease: Power3,
  });
});
