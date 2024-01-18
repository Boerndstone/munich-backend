import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["star"];

  connect() {
    const ratingValue = this.data.get("rating");
    this.starTarget.innerHTML =
      '<i class="fas fa-star" style="color: rgb(202 138 4)"></i>'.repeat(
        ratingValue
      );
  }
}
