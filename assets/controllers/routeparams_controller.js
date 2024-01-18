import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["star", "protection"];

  connect() {
    const ratingValue = this.data.get("rating");
    const protectionValue = this.data.get("protection");
    this.starTarget.innerHTML =
      '<i class="fas fa-star" style="color: rgb(202 138 4)"></i>'.repeat(
        ratingValue
      );
    if (protectionValue == 2) {
      this.protectionTarget.innerHTML =
        '<i class="fa fa-exclamation-triangle text-danger"></i>';
    } else if (protectionValue == 3) {
      this.protectionTarget.innerHTML =
        '<i class="fa fa-ambulance text-danger"></i>';
    }
  }
}
