import { Controller } from "stimulus";
import lightGallery from "lightgallery";
import lgThumbnail from "lightgallery/plugins/thumbnail";
import lgZoom from "lightgallery/plugins/zoom";

export default class extends Controller {
  static targets = ["open-gallery-btn"];

  connect() {
    const galleryData = JSON.parse(this.element.dataset.galleryData);
    const $dynamicGallery = document.getElementById("open-gallery-btn");

    galleryData.forEach((item) => {
      const galleryItem = document.createElement("a");
      galleryItem.setAttribute("href", item.src);
      galleryItem.setAttribute("data-sub-html", item.subHtml);

      // Add srcset attribute for different resolutions
      galleryItem.setAttribute("srcset", `${item.src} @1x, ${item.src2x} @2x`);

      // Append the anchor element to the gallery container
      $dynamicGallery.appendChild(galleryItem);
    });
    const dynamicGallery = lightGallery($dynamicGallery, {
      dynamic: true,
      plugins: [lgZoom, lgThumbnail],
      licenseKey: "162AFA5B-3E30-4993-830C-377547A29E8B",
      dynamicEl: galleryData,
    });
    $dynamicGallery.addEventListener("click", () => {
      dynamicGallery.openGallery(0);
    });
  }
}
