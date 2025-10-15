let cardsList = [];
const pop_outs = document.querySelectorAll(".pop-out");
const background = document.querySelector(".gray-background");
const closes = document.querySelectorAll(".close");
const cards = document.querySelectorAll(".card");
const header = document.querySelector(".header");
const cards2 = document.querySelectorAll(".card2");
const cardActive = document.querySelectorAll(".card-active");
const cardtext = document.querySelectorAll(".card-active-text-main");

for (let i = 0; i < cards2.length; i++) {
  cards2[i].addEventListener("click", () => {
    if (cards2[i].classList.contains("active")) {
      cards2[i].classList.remove("active");
      cardActive[i].classList.remove("active");
      cardtext[i].classList.remove("active");
    } else {
      for (let j = 0; j < cards2.length; j++) {
        cards2[j].classList.remove("active");
        cardActive[j].classList.remove("active");
        cardtext[j].classList.remove("active");
      }
      cards2[i].classList.add("active");
      cardActive[i].classList.add("active");
      cardtext[i].classList.add("active");
    }
  });
}

closes.forEach((close) => {
  close.addEventListener("click", () => {
    pop_outs.forEach((popout) => {
      popout.classList.remove("active");
      background.classList.remove("active");
    });
  });
});

window.addEventListener("load", () => {
  cards.forEach((card) => {
    cardsList.push(card.firstElementChild);
  });

  cardsList.forEach((card) => {
    card.addEventListener("click", (e) => {
      console.log("pop-" + cardsList.indexOf(e.target));
      pop_outs.forEach((popOut) => {
        if (popOut.classList.contains("pop-" + cardsList.indexOf(e.target))) {
          console.log(popOut.classList.contains("pop-" + cardsList.indexOf(e.target)));
          popOut.classList.add("active");
          background.classList.add("active");
        }
      });
    });
  });
});
