import lightGallery from "lightgallery";

// Plugins
import lgZoom from "lightgallery/plugins/zoom";

function initializeGallery(data) {
  const $dynamicGallery = document.getElementById("open-gallery-btn");

  console.log(galleryData);

  galleryData.forEach((item) => {
    const galleryItem = document.createElement("a");
    galleryItem.setAttribute("href", item.src);
    galleryItem.setAttribute("data-sub-html", item.subHtml);
  });
  const dynamicGallery = lightGallery($dynamicGallery, {
    dynamic: true,
    plugins: [lgZoom],
    licenseKey: "162AFA5B-3E30-4993-830C-377547A29E8B",
    dynamicEl: galleryData,
  });
  $dynamicGallery.addEventListener("click", () => {
    dynamicGallery.openGallery(0);
  });
}
