import { Controller } from "stimulus";

export default class extends Controller {
  connect() {
    const tabs = document.querySelectorAll(".scrollable-tabs-container a");
    const rightArrow = document.querySelector(
      ".scrollable-tabs-container .right-arrow svg"
    );
    const leftArrow = document.querySelector(
      ".scrollable-tabs-container .left-arrow svg"
    );
    const tabsList = document.querySelector(".scrollable-tabs-container ul");
    const container = document.querySelector(".container");

    let totalWidth = 0;
    tabsList.querySelectorAll("li").forEach((li) => {
      totalWidth += li.offsetWidth;
    });

    const leftArrowContainer = document.querySelector(
      ".scrollable-tabs-container .left-arrow"
    );
    const rightArrowContainer = document.querySelector(
      ".scrollable-tabs-container .right-arrow"
    );

    if (totalWidth < tabsList.clientWidth) {
      rightArrowContainer.classList.remove("active");
    }

    const removeAllActiveClasses = () => {
      tabs.forEach((tab) => {
        tab.classList.remove("active");
      });
    };

    tabs.forEach((tab) => {
      tab.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default anchor behavior
        removeAllActiveClasses();
        tab.classList.add("active");

        // Scroll the tab into view
        const tabRect = tab.getBoundingClientRect();
        const containerRect = tabsList.getBoundingClientRect();
        const offset =
          tabRect.left -
          containerRect.left -
          containerRect.width / 2 +
          tabRect.width / 2;

        tabsList.scrollBy({
          left: offset,
          behavior: "smooth",
        });

        // Scroll to the corresponding content
        const targetId = tab.getAttribute("href").slice(1);
        const targetCard = document.getElementById(targetId);
        if (targetCard) {
          const cardOffset = targetCard.offsetTop;
          window.scrollTo({ top: cardOffset, behavior: "smooth" });
        }
      });
    });

    const manageIcons = () => {
      if (tabsList.scrollLeft >= 20) {
        leftArrowContainer.classList.add("active");
      } else {
        leftArrowContainer.classList.remove("active");
      }
      let maxScrollValue = tabsList.scrollWidth - tabsList.clientWidth - 20;

      if (tabsList.scrollLeft >= maxScrollValue) {
        rightArrowContainer.classList.remove("active");
      } else {
        rightArrowContainer.classList.add("active");
      }
    };

    rightArrow.addEventListener("click", () => {
      tabsList.scrollLeft += 200;
      manageIcons();
    });

    leftArrow.addEventListener("click", () => {
      tabsList.scrollLeft -= 200;
      manageIcons();
    });

    tabsList.addEventListener("scroll", manageIcons);

    let dragging = false;
    const drag = (e) => {
      if (!dragging) return;
      tabsList.classList.add("dragging");
      tabsList.scrollLeft -= e.movementX;
    };
    tabsList.addEventListener("mousedown", () => {
      dragging = true;
    });
    tabsList.addEventListener("mousemove", drag);
    document.addEventListener("mouseup", () => {
      dragging = false;
      tabsList.classList.remove("dragging");
    });
  }
}
