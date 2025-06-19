const closeWhatsappPopup = document.querySelector(
  ".whatsapp__popup .custom__popup_close"
);
const whatsappPopup = document.querySelector(".whatsapp__popup");

closeWhatsappPopup.addEventListener("click", function () {
  whatsappPopup.style.display = "none";
});
