// assets/controllers/navbar_scroll_controller.js

import { Controller } from "stimulus";

export default class extends Controller {
  scrollToCenter() {
    const targetId = this.element.getAttribute("href").substring(1);
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
      targetElement.scrollIntoView({ behavior: "smooth", block: "center" });
    }
  }
}
