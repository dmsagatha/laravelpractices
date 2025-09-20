import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Toastify from "toastify-js"
import "toastify-js/src/toastify.css"
import flatpickr from "flatpickr"

// Ejemplo global para usar en todo el proyecto
window.Toastify = Toastify;

/* flatpickr(".datepicker", {
  dateFormat: "Y-m-d",
}); */

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("input.flatpickr-input").forEach((el) => {
    flatpickr(el, {
      dateFormat: "Y-m-d",
      allowInput: true,
      minDate: el.dataset.min || null,
      maxDate: el.dataset.max || null,
      locale: {
        firstDayOfWeek: 1 // Lunes
      }
    });

    // Detectar modo oscuro inicial
    if (document.documentElement.classList.contains("dark")) {
      fp.calendarContainer.classList.add("dark-theme");
    }

    // Escuchar cambios de tema (cuando el usuario cambia)
    const observer = new MutationObserver(() => {
      if (document.documentElement.classList.contains("dark")) {
        fp.calendarContainer.classList.add("dark-theme");
      } else {
        fp.calendarContainer.classList.remove("dark-theme");
      }
    });

    observer.observe(document.documentElement, { attributes: true, attributeFilter: ["class"] });
  });
});