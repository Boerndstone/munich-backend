fetch("/gallery-data")
  .then((response) => response.json())
  .then((data) => {
    // Process fetched data here
    console.log(data);
  })
  .catch((error) => console.error("Error fetching gallery data:", error));

import lightGallery from "lightgallery";

// Plugins
import lgZoom from "lightgallery/plugins/zoom";

const $dynamicGallery = document.getElementById("open-gallery-btn");
const dynamicGallery = lightGallery($dynamicGallery, {
  dynamic: true,
  plugins: [lgZoom],
  licenseKey: "162AFA5B-3E30-4993-830C-377547A29E8B",
  dynamicEl: [
    {
      src: "https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1400&q=80",
      responsive:
        "https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=480&q=80 480, https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=800&q=80 800",
      subHtml: `<div class="lightGallery-captions">
                <h4>Photo by <a href="https://unsplash.com/@brookecagle">Brooke Cagle</a></h4>
                <p>Description of the slide 1</p>
            </div>`,
    },
    {
      src: "https://images.unsplash.com/photo-1477322524744-0eece9e79640?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1400&q=80",
      responsive:
        "https://images.unsplash.com/photo-1477322524744-0eece9e79640?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=480&q=80 480, https://images.unsplash.com/photo-1477322524744-0eece9e79640?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80 800",
      subHtml: `<div class="lightGallery-captions">
                <h4>Photo by <a href="https://unsplash.com/@brookecagle">Brooke Cagle</a></h4>
                <p>Description of the slide 1</p>
            </div>`,
    },
  ],
});
$dynamicGallery.addEventListener("click", () => {
  dynamicGallery.openGallery(0);
});
