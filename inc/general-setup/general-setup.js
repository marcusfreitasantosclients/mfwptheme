jQuery(document).ready(function ($) {
  // Configurações de Mídia
  function setupMediaUploader(buttonId, inputId, titleText, buttonText) {
    $(buttonId).click(function (e) {
      e.preventDefault();
      var custom_uploader = wp
        .media({
          title: titleText,
          button: { text: buttonText },
          multiple: false,
        })
        .on("select", function () {
          var attachment = custom_uploader
            .state()
            .get("selection")
            .first()
            .toJSON();
          $(inputId).val(attachment.url);
        })
        .open();
    });
  }

  // Seta os botões de galeria
  setupMediaUploader(
    "#upload_favicon_button",
    "#site_favicon",
    "Selecionar Favicon",
    "Usar como Favicon"
  );
  setupMediaUploader(
    "#upload_logo_header_button",
    "#site_logo_header",
    "Selecionar Logo Header",
    "Usar como Logo Header"
  );
  setupMediaUploader(
    "#upload_logo_footer_button",
    "#site_logo_footer",
    "Selecionar Logo Footer",
    "Usar como Logo Footer"
  );

  // Tabs
  let navigations = document.querySelectorAll(".tab__navigation a");
  let tabs = document.querySelectorAll(".tab__section");
  if (navigations && tabs) {
    navigations.forEach((item) => {
      item.addEventListener("click", function (e) {
        e.preventDefault();

        // Oculta abas
        tabs.forEach((tab) => {
          tab.style.display = "none";
        });

        // Remove actives
        navigations.forEach((item) => {
          item.classList.remove("active");
        });

        // Atual
        this.classList.add("active");
        document.querySelector(
          ".tab__section" + item.getAttribute("href")
        ).style.display = "block";
      });
    });
  }
});
