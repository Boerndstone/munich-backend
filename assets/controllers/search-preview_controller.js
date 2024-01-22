import { event } from "jquery";
import { Controller } from "stimulus";
//useDebounce does not work
//import { useClickOutside } from "stimulus-use";
//import { useClickOutside, useDebounce } from "stimulus-use";
export default class extends Controller {
  onSearchInput(event) {
    console.log(event);
  }

  // static values = {
  //   url: String,
  // };
  // static targets = ["result"];
  // async onSearchInput(event) {
  //   const params = new URLSearchParams({
  //     q: event.currentTarget.value,
  //     preview: 1,
  //   });
  //   const response = await fetch(`${this.urlValue}?${params.toString()}`);
  //   this.resultTarget.innerHTML = await response.text();
  //   //console.log(await response.text());
  // }
  /*onSearchInput(event) {
    console.log(this.urlValue);
  }*/
  /*
  async search(query) {
    const params = new URLSearchParams({
      q: query,
      preview: 1,
    });
    const response = await fetch(`${this.urlValue}?${params.toString()}`);
    this.resultTarget.innerHTML = await response.text();
  }
  clickOutside(event) {
    this.resultTarget.innerHTML = "";
  }*/
}
