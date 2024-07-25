import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["childFriendly", "sunny", "rain"];

  connect() {
    this.filterItems();
  }

  filterItems() {
    const showChildFriendly = this.childFriendlyTarget.checked;
    const showSunny = this.sunnyTarget.checked;
    const showRain = this.rainTarget.checked; // Added line
    let visibleCount = 0;

    document.querySelectorAll(".rock-item").forEach((item) => {
      const isChildFriendly = item.dataset.childFriendly === "true";
      const isSunny = item.dataset.rockSunny === "true";
      const isRain = item.dataset.rockRain === "true"; // Assuming you have this data attribute

      let shouldShow = true;
      if (showChildFriendly && !isChildFriendly) {
        shouldShow = false;
      }
      if (showSunny && !isSunny) {
        shouldShow = false;
      }
      if (showRain && !isRain) {
        // New condition for "rain"
        shouldShow = false;
      }

      item.style.display = shouldShow ? "" : "none";

      if (shouldShow) visibleCount++;
    });

    document.getElementById("resultsCount").textContent =
      visibleCount.toString();
  }
}
