let rectangle = document.querySelector("#rectangle");

rectangle.addEventListener("mousemove", function (details) {
  let rectangleLocation = rectangle.getBoundingClientRect();
  let mouseLocationOnRect = details.clientX - rectangleLocation.left;

  if (mouseLocationOnRect < rectangleLocation.width / 2) {
    let redColor = gsap.utils.mapRange(
      0,
      rectangleLocation.width / 2,
      255,
      0,
      mouseLocationOnRect
    );
    gsap.to(rectangle, {
      backgroundColor: `rgb(${redColor},0,0)`,
      ease: Power4,
    });
  } else {
    let blueColor = gsap.utils.mapRange(
      rectangleLocation.width / 2,
      rectangleLocation.width,
      0,
      255,
      mouseLocationOnRect
    );
    gsap.to(rectangle, {
      backgroundColor: `rgb(0,0,${blueColor})`,
      ease: Power4,
    });
  }
});

rectangle.addEventListener("mouseleave", function () {
  gsap.to(rectangle, {
    backgroundColor: "white",
  });
});
