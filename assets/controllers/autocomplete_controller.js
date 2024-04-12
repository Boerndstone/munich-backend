// assets/controllers/autocomplete_controller.js
import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["input", "results"];

  connect() {
    document.addEventListener("click", this.closeDropdown.bind(this));
  }

  disconnect() {
    document.removeEventListener("click", this.closeDropdown.bind(this));
  }

  search() {
    fetch(`/search?query=${this.inputTarget.value}`)
      .then((response) => response.json())
      .then((rocks) => {
        this.resultsTarget.innerHTML = rocks
          .map(
            (rock) => `
          <li class="list-group-item" data-action="autocomplete#goToResult" data-url="${rock.url}">
            <a class="d-block" href="${rock.url}">${rock.name}</a>
          </li>
        `
          )
          .join("");
      });
  }

  closeDropdown(event) {
    if (!this.element.contains(event.target)) {
      this.resultsTarget.innerHTML = "";
      this.inputTarget.value = "";
    }
  }

  goToResult(event) {
    window.location.href = event.target.dataset.url;
  }
}
