jQuery(document).ready(function ($) {
  let mediaUploader;

  const uploadBtn = document.querySelector("#upload_image");
  $("#upload_image").on("click", function (e) {
    e.preventDefault();

    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media({
      title: "Choose Attribute Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    mediaUploader.on("select", function () {
      const attachment = mediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#finish_attribute_image").val(attachment.id);
      $("#image_preview").attr("src", attachment.url).show();
    });

    mediaUploader.open();
  });
});
