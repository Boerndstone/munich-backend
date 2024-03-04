"use strict";

// /////////////////////////////////////////
// Required
// /////////////////////////////////////////
const gulp = require("gulp");
const imagemin = require("gulp-imagemin");
const imageminWebp = require("imagemin-webp");
const imageResize = require("gulp-image-resize");
const extReplace = require("gulp-ext-replace");
const webp = require("gulp-webp");
const rename = require("gulp-rename");
const del = require("del");

// /////////////////////////////////////////
// IMAGES Task
// /////////////////////////////////////////
gulp.task("areaImagesWebp", () => {
  const sizes = [
    { width: 400, quality: 100, suffix: "" },
    { width: 800, quality: 100, suffix: "@2x" },
    { width: 1200, quality: 80, suffix: "@3x" },
  ];
  let stream;
  sizes.forEach((size) => {
    stream = gulp
      .src("assets/images/areas/**/*.jpg")
      .pipe(imageResize({ width: size.width }))
      .pipe(
        rename((path) => {
          path.basename += `${size.suffix}`;
        })
      )
      .pipe(
        imagemin([
          imageminWebp({
            quality: size.quality,
          }),
        ])
      )
      .pipe(webp())
      .pipe(gulp.dest("public/build/images/areas"));
  });
  return stream;
});

gulp.task("rocksForMap", () =>
  gulp
    .src("src/images/rocksmap/**/*.jpg")
    .pipe(
      imageResize({
        width: 150,
        height: 150,
        crop: true,
        upscale: false,
        imageMagick: true,
      })
    )
    .pipe(webp())
    .pipe(gulp.dest("dist/images/rocksmap"))
);

gulp.task("navigationThumbsJPG", () =>
  gulp
    .src("src/images/areas/**/*.jpg")
    .pipe(
      imageResize({
        width: 24,
        height: 24,
        crop: true,
        upscale: false,
        imageMagick: true,
      })
    )
    .pipe(imagemin())
    .pipe(gulp.dest("dist/images/navigationThumbs"))
);
gulp.task("navigationThumbsWebP", () =>
  gulp
    .src("src/images/areas/**/*.jpg")
    .pipe(
      imageResize({
        width: 24,
        height: 24,
        crop: true,
        upscale: false,
        imageMagick: true,
      })
    )
    .pipe(webp())
    .pipe(gulp.dest("dist/images/navigationThumbs"))
);

gulp.task("galerieImages", () =>
  gulp
    .src(["assets/images/galerie/**/*.jpg", "assets/images/galerie/**/*.JPG"])
    .pipe(
      imageResize({
        width: 1000,
        height: 563,
        crop: true,
        upscale: false,
        imageMagick: true,
      })
    )
    .pipe(webp())
    .pipe(gulp.dest("public/build/images/galerie"))
);
gulp.task("convertImages", () => {
  const sizes = [
    { width: 200, quality: 100, suffix: "low" },
    { width: 1000, quality: 100, suffix: "high" },
  ];
  let stream;
  sizes.forEach((size) => {
    stream = gulp
      .src("src/images/**/*.jpg")
      .pipe(imageResize({ width: size.width }))
      .pipe(
        rename((path) => {
          path.basename += `-${size.suffix}`;
        })
      )
      .pipe(
        imagemin(
          [
            imageminMozjpeg({
              quality: size.quality,
            }),
          ],
          {
            verbose: true,
          }
        )
      )
      .pipe(gulp.dest("dist/images"));
  });
  return stream;
});
gulp.task("imagesWebp", function () {
  let src = "src/images/**/*.jpg";
  let dest = "dist/images";
  return gulp
    .src(src)
    .pipe(
      imagemin([
        imageminWebp({
          quality: 70,
        }),
      ])
    )
    .pipe(extReplace(".webp"))
    .pipe(gulp.dest(dest));
});
gulp.task("delImages", async function () {
  const del = await import("del").then((mod) => mod.default);
  return del(["public/build/images/areas/**/*", "!public/build/images/"]);
});
gulp.task(
  "galerieImages",
  gulp.series(
    "delImages",
    // "convertImages",
    "imagesWebp",
    // "navigationThumbsJPG",
    // "navigationThumbsWebP",
    "areaImagesWebp",
    "galerieImages"
  )
);

// Generate Images for Maps
gulp.task("delImagesMaps", async function () {
  const del = await import("del").then((mod) => mod.default);
  return del(["dist/images/rocksmap/**/*", "!dist/images/"]);
});

gulp.task("generateImagesForMaps", gulp.series("delImagesMaps", "rocksForMap"));

gulp.task("imagesTopos", function () {
  let src = "src/images/topos/schwedenfels.jpg";
  let dest = "dist/images/test";
  return gulp
    .src(src)
    .pipe(
      imagemin([
        imageminWebp({
          quality: 10,
        }),
      ])
    )
    .pipe(extReplace(".webp"))
    .pipe(gulp.dest(dest));
});
