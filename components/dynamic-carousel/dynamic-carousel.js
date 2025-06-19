document.addEventListener("DOMContentLoaded", function () {
  const mfBanners = [...document.querySelectorAll(".mf_dynamic_carousel")];

  mfBanners.forEach((banner, index) => {
    const bannerItems = [...banner.querySelectorAll(".splide__slide")];

    new Splide(banner, {
      type: "loop",
      perPage: 1,
      autoplay: bannerItems.length > 1,
      interval: 5000,
      pagination: bannerItems.length > 1,
      arrows: bannerItems.length > 1,
    }).mount();
  });
});
