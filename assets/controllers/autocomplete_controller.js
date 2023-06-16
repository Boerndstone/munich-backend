import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["input", "results"];

  connect() {
    // Initialize the autocomplete behavior
    this.inputTarget.addEventListener("input", this.search.bind(this));
  }

  search() {
    const query = this.inputTarget.value;

    // Send an AJAX request to the Symfony backend with the search query
    fetch(`/autocomplete?q=${query}`)
      .then((response) => response.json())
      .then((data) => {
        // Update the UI with the autocomplete results
        this.resultsTarget.innerHTML = ""; // Clear previous results

        data.forEach((result) => {
          const option = document.createElement("option");
          option.value = result.value;
          this.resultsTarget.appendChild(option);
        });
      })
      .catch((error) => {
        console.error("Autocomplete request failed", error);
      });
  }
}
