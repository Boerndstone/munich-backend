import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["star", "protection", "route-rock-quality"];

  connect() {
    const ratingValue = this.data.get("rating");
    const rockQuality = this.data.get("route-rock-quality");
    const protectionValue = this.data.get("protection");
    this.starTarget.innerHTML =
      '<div class="star d-inline-block"></div>'.repeat(ratingValue);
    if (protectionValue == 2) {
      this.protectionTarget.innerHTML =
        '<div class="exclamation d-inline-block"></div>';
    } else if (protectionValue == 3) {
      this.protectionTarget.innerHTML =
        '<div class="skull d-inline-block"></div>';
    }
    if (rockQuality == 1) {
      this.protectionTarget.innerHTML =
        '<div class="loose-rock d-inline-block"></div>';
    }
  }
}
