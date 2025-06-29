document.addEventListener("DOMContentLoaded", function () {
  const submitBtn = document.querySelector(
    ".filter_content_column .mf_default_btn"
  );
  const loadingSpinner = document.querySelector(".mf_loading_spinner");
  const contentContainer = document.querySelector(".filtered_content");
  const loadMoreBtn = document.querySelector(".btn_load_more");
  let currentPage = 1;
  let totalPosts = 0;

  const getSearchQuery = () => {
    const searchInput = document.querySelector(
      ".filter_content_column .searchform input"
    );
    const value = searchInput ? searchInput.value.trim() : "";
    return value !== "" ? `name=${encodeURIComponent(value)}` : null;
  };

  const getCheckedValuesQuery = (selector, key) => {
    const inputs = document.querySelectorAll(selector);
    const selectedValues = [...inputs]
      .filter((input) => input.checked)
      .map((input) => input.value);

    return selectedValues.length > 0
      ? `${key}=${selectedValues.join(",")}`
      : null;
  };

  const buildQueryString = () => {
    const queryParts = [
      getSearchQuery(),
      getCheckedValuesQuery(".filter_content_categories input", "categories"),
    ].filter(Boolean);

    return queryParts.length ? `&${queryParts.join("&")}` : "";
  };

  const getPosts = async (page = 1, append = false) => {
    try {
      loadMoreBtn.style.display = "flex";
      loadingSpinner.style.display = "flex";

      const queryString = buildQueryString();
      const baseUrl = `${current_user_data.site_url}/wp-json/content/v2/get-content/?page=${page}&post_type=product${queryString}`;

      const response = await fetch(baseUrl);
      const responseJson = await response.json();

      totalPosts = responseJson.posts_total;

      if (totalPosts < 12) {
        loadMoreBtn.style.display = "none";
      }

      if (totalPosts > 0) {
        if (append) {
          contentContainer.innerHTML += responseJson.content_cards;
        } else {
          contentContainer.innerHTML = "";
          contentContainer.innerHTML = responseJson.content_cards;
        }
      } else {
        contentContainer.innerHTML = "<span>Nothing found.</span>";
      }
    } catch (e) {
      console.log(e);
    } finally {
      loadingSpinner.style.display = "none";
    }
  };

  submitBtn?.addEventListener("click", function (e) {
    e.preventDefault();
    getPosts();
  });

  loadMoreBtn?.addEventListener("click", function () {
    currentPage++;
    getPosts(currentPage, true);
  });
});
