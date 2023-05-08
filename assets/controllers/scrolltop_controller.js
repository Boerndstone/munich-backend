import ScrollTo from "stimulus-scroll-to";

export default class extends ScrollTo {
  static targets = ["top"];

  scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      this.topTarget.classList.add("d-block");
    } else {
      this.topTarget.classList.remove("d-block");
    }
  }
}
