let time = 90;
let score = 0;
let randomHit = 0;

function makeBubble() {
  let clutter = "";
  for (i = 0; i < 160; i++) {
    let randomNumber = Math.floor(Math.random() * 10);
    clutter += `<div class="bubble">${randomNumber}</div>`;
  }
  document.querySelector("#displayBubble").innerHTML = clutter;
}

function hit() {
  randomHit = Math.floor(Math.random() * 10);
  document.querySelector("#hit").textContent = randomHit;
}

function timer() {
  let timeInterval = setInterval(function () {
    if (time > 0) {
      time--;
      document.querySelector("#timer").textContent = time;
    } else {
      clearInterval(timeInterval);
      document.querySelector(
        "#displayBubble"
      ).innerHTML = `<h1>GAME OVER</h1> <br> <h2 style="color:Tomato;">Your score is ${score}</h2>`;
    }
  }, 1000);
}

function incraseScore() {
  score += 10;
  document.querySelector("#score").textContent = score;
}

document
  .querySelector("#displayBubble")
  .addEventListener("click", function (details) {
    let getNumber = Number(details.target.textContent);
    if (getNumber === randomHit) {
      incraseScore();
      hit();
      makeBubble();
    }
  });

hit();

timer();

makeBubble();
