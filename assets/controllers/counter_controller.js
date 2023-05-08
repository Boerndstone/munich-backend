import { Controller } from "stimulus";

export default class extends Controller {
  count = 0;
  static targets = ["count"];

  //connect() {
  //this.element.innerHTML = "You have clicked me 0 times";
  //const counterNumberElement =
  //this.element.getElementsByClassName("counter-count")[0];
  //this.count = 0;

  /*this.element.addEventListener("click", () => {
      this.count++;
      //this.element.innerHTML = this.count;
      //counterNumberElement.innerHTML = this.count;
      this.countTarget.innerHTML = this.count;
    });*/
  //}

  increment() {
    this.count++;
    this.countTarget.innerHTML = this.count;
  }
}
