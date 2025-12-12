(function ($) {
  "use strict";
  $(function () {
    $("#copy-btn").on("click", function (e) {
      e.preventDefault();
      copyShortcode();
    });
  });
  function copyShortcode() {
    const input = document.getElementById("car-loan-shortcode");
    const button = document.getElementById("copy-btn");
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard
      .writeText(input.value)
      .then(() => {
        button.textContent = "Copied";
        setTimeout(() => {
          button.textContent = "Copy";
        }, 3000);
      })
      .catch((err) => {
        alert("Failed to copy shortcode");
      });
  }
  document.addEventListener("DOMContentLoaded", function () {
    const colorSyncFields = [
      "ace_heading_color",
      "ace_button_color",
      "ace_heading_textcolor",
    ];

    colorSyncFields.forEach((fieldId) => {
      const picker = document.getElementById(`${fieldId}_picker`);
      const text = document.getElementById(`${fieldId}_text`);

      if (picker && text) {
        picker.addEventListener("input", () => {
          text.value = picker.value;
        });

        text.addEventListener("input", () => {
          if (/^#[0-9A-Fa-f]{6}$/.test(text.value)) {
            picker.value = text.value;
          }
        });
      }
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".color-picker").forEach(function (el) {
      let input = el.nextElementSibling;
      let initialColor = input.value;

      const pickr = Pickr.create({
        el: el,
        theme: "classic",
        default: initialColor,
        components: {
          preview: true,
          opacity: true,
          hue: true,

          interaction: {
            hex: true,
            rgba: true,
            input: true,
            clear: true,
            save: true,
          },
        },
      });

      pickr.on("save", (color) => {
        let hex = color.toHEXA().toString();
        input.value = hex;
        pickr.hide();
      });

      pickr.on("clear", () => {
        input.value = "";
      });

      input.addEventListener("input", () => {
        if (/^#([0-9A-F]{3}){1,2}$/i.test(input.value)) {
          pickr.setColor(input.value);
        }
      });
    });
  });
})(jQuery);
