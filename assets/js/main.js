const siteUrl = current_user_data.site_url;

function insertEsInUrl(url) {
  try {
    const parsedUrl = new URL(url);

    // If the path already starts with /es/, return it unchanged
    if (parsedUrl.pathname.startsWith("/es/")) {
      return url;
    }

    // Insert /es/ after the domain
    parsedUrl.pathname = "/es" + parsedUrl.pathname;

    return parsedUrl.toString();
  } catch (e) {
    console.error("Invalid URL:", url);
    return url;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const currentUrl = window.location.href;

  const languageSelector = [
    ...document.querySelectorAll(".header_language_btn"),
  ];
  languageSelector.forEach((languageBtn) => {
    languageBtn.addEventListener("click", function (e) {
      e.preventDefault();

      if (e.currentTarget.dataset.targetLanguage === "es") {
        window.location.href = insertEsInUrl(currentUrl);
      } else {
        window.location.href = currentUrl.replace("/es/", "/");
      }
    });
  });

  if (currentUrl.includes("/es/")) {
    const links = [...document.querySelectorAll("a")];
    links.forEach((link) => {
      if (
        link.getAttribute("href") !== null &&
        link.getAttribute("href").includes(siteUrl) &&
        !link.getAttribute("href").includes("wp-login.php")
      )
        link.setAttribute("href", insertEsInUrl(link.getAttribute("href")));
    });
  }
});
