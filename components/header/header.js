document.addEventListener("DOMContentLoaded", function () {
  const dropdowns = document.querySelectorAll(".navbar .dropdown");

  dropdowns.forEach((dropdown) => {
    const toggle = dropdown.querySelector(".dropdown-toggle");
    const menu = dropdown.querySelector(".dropdown-menu");

    if (window.innerWidth >= 992) {
      dropdown.addEventListener("mouseenter", () => {
        toggle.classList.add("show");
        menu.classList.add("show");
        toggle.setAttribute("aria-expanded", "true");
      });

      dropdown.addEventListener("mouseleave", () => {
        toggle.classList.remove("show");
        menu.classList.remove("show");
        toggle.setAttribute("aria-expanded", "false");
      });
    }
  });
});

window.addEventListener("load", () => {
  const inputs = document.querySelectorAll(
    ".wc-block-components-quantity-selector__input"
  );

  const quantityBtn = [
    ...document.querySelectorAll(
      ".wc-block-components-quantity-selector__button"
    ),
  ];

  const removeItemBtn = [
    ...document.querySelectorAll(".wc-block-cart-item__remove-link"),
  ];

  const cartIcon = document.querySelector(".cart_count");

  const countCartItems = () => {
    setTimeout(() => {
      let cartCount = 0;

      const updatedInputs = document.querySelectorAll(
        ".wc-block-components-quantity-selector__input"
      );

      updatedInputs.forEach((input) => {
        cartCount += Number(input.value);
      });

      cartIcon.innerText = cartCount;
    }, 1000);
  };

  quantityBtn.forEach((btn) => {
    btn.addEventListener("click", function () {
      countCartItems();
    });
  });

  removeItemBtn.forEach((btn) => {
    btn.addEventListener("click", function () {
      countCartItems();
    });
  });

  inputs.forEach((input) => {
    input.addEventListener("input", () => {
      countCartItems();
    });
  });
});
