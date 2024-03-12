import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["input", "results"];

  connect() {
    const tabs = document.querySelectorAll(".tab-navigation a");
  }
}
