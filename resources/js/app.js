import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Toastify from "toastify-js"
import "toastify-js/src/toastify.css"
import Pikaday from "pikaday";
import dayjs from "dayjs";

// Ejemplo global para usar en todo el proyecto
window.Toastify = Toastify;

// Inicializador con Pikaday
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("input[data-min], input[data-max]").forEach((el) => {
    new Pikaday({
      field: el,
      format: "YYYY-MM-DD",
      toString(date) {
        return dayjs(date).format("YYYY-MM-DD");
      },
      parse(dateString) {
        return dayjs(dateString, "YYYY-MM-DD").toDate();
      },
      minDate: el.dataset.min ? new Date(el.dataset.min) : null,
      maxDate: el.dataset.max ? new Date(el.dataset.max) : null,
      firstDay: 1, // lunes
      theme: document.documentElement.classList.contains("dark") ? "dark-theme" : "light-theme",
      // 🔹 Agregar selectores de año y mes
      yearRange: [1900, new Date().getFullYear()], // rango de años (ajústalo a tus reglas)
      showMonthAfterYear: false,
      i18n: {
        previousMonth: "Anterior",
        nextMonth: "Siguiente",
        months: [
          "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
          "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ],
        weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        weekdaysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"]
      }
    });
  });
});