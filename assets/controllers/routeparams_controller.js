import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["star", "protection"];

  connect() {
    const ratingValue = this.data.get("rating");
    const protectionValue = this.data.get("protection");
    this.starTarget.innerHTML =
      '<div class="star d-inline-block"></div>'.repeat(ratingValue);
    if (protectionValue == 2) {
      this.protectionTarget.innerHTML =
        '<div class="exclamation d-inline-block"></div';
    } else if (protectionValue == 3) {
      this.protectionTarget.innerHTML =
        '<div class="skull d-inline-block"></div';
    }
  }
}
