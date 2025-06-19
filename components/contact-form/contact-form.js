document.addEventListener("DOMContentLoaded", function () {
  const contactForms = [...document.querySelectorAll(".mf_contact_form")];

  const sendFormData = async (formData, form) => {
    const loadingSpinner = form.querySelector(".mf_loading_spinner");

    try {
      loadingSpinner.style.display = "flex";

      const response = await fetch(
        `${current_user_data.site_url}/wp-json/forms/v2/send-form-data`,
        {
          method: "POST",
          body: JSON.stringify(formData),
        }
      );

      if (response.status === 200) {
        alert("Your message was received");
        form.reset();
      } else {
        alert("Oops! Something is wrong, try again later.");
      }
    } catch (e) {
      console.log(e);
      alert("Oops! Something is wrong, try again later.");
    } finally {
      loadingSpinner.style.display = "none";
    }
  };

  contactForms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const targetEmails = form.dataset.targetEmails;
      const formData = new FormData(form);

      const requestBody = {
        targetEmails,
      };

      formData.forEach((value, field) => {
        requestBody[field] = value;
      });

      sendFormData(requestBody, form);
    });
  });
});
