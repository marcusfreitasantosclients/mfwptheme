document.addEventListener("DOMContentLoaded", function () {
  const mfcarousels = [
    ...document.querySelectorAll(".mf_single_product_carousel"),
  ];

  mfcarousels.forEach((carousel, index) => {
    const carouselItems = [...carousel.querySelectorAll(".splide__slide")];

    const otherProductsCarousel = carousel.classList.contains("other_products");

    new Splide(carousel, {
      type: "loop",
      perPage: otherProductsCarousel ? 4 : 1,
      autoplay: carouselItems.length > 1,
      interval: 5000,
      pagination: false,
      arrows: carouselItems.length > 1,
      gap: 12,
    }).mount();
  });
});
