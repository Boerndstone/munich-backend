import { Controller } from "stimulus";
import { Modal } from "bootstrap";

export default class extends Controller {
  static targets = ["modal"];
  fixedNavbar;
  modal;

  openModal(event) {
    this.fixedNavbar = document.querySelector("header nav");
    this.modal = new Modal(this.modalTarget);
    this.fixedNavbar.classList.remove("fixed-top");
    this.modal.show();

    // Listen for the modal hide event
    this.modalTarget.addEventListener("hide.bs.modal", () => {
      this.fixedNavbar.classList.add("fixed-top");
    });
  }
}
