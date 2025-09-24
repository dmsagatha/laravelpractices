import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';
import Pikaday from 'pikaday';
import dayjs from 'dayjs';

// Ejemplo global para usar en todo el proyecto
window.Toastify = Toastify;

// Inicializador con Pikaday
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[data-mode]').forEach((el) => {
    let minDate = null;
    let maxDate = null;
    let yearRange = null;
    const today = dayjs();

    switch (el.dataset.mode) {
      case 'age':
        minDate = today.subtract(65, 'year').toDate();
        maxDate = today.subtract(18, 'year').toDate();
        yearRange = [today.year() - 65, today.year() - 18];
        break;

      case 'warranty':
        minDate = today.subtract(10, 'year').toDate();
        maxDate = today.add(5, 'year').toDate();
        yearRange = [today.year() - 10, today.year() + 5];
        break;

      default: // custom
        minDate = el.dataset.min ? new Date(el.dataset.min) : null;
        maxDate = el.dataset.max ? new Date(el.dataset.max) : null;
        yearRange = [
          minDate ? new Date(minDate).getFullYear() : 1900,
          maxDate ? new Date(maxDate).getFullYear() : today.year(),
        ];
    }

    new Pikaday({
      field: el,
      format: 'YYYY-MM-DD',
      toString(date) {
        return dayjs(date).format('YYYY-MM-DD');
      },
      parse(dateString) {
        return dayjs(dateString, 'YYYY-MM-DD').toDate();
      },
      minDate: minDate,
      maxDate: maxDate,
      yearRange: yearRange,
      showMonthAfterYear: false,
      firstDay: 1,
      i18n: {
        previousMonth: 'Anterior',
        nextMonth: 'Siguiente',
        months: [
          'Enero',
          'Febrero',
          'Marzo',
          'Abril',
          'Mayo',
          'Junio',
          'Julio',
          'Agosto',
          'Septiembre',
          'Octubre',
          'Noviembre',
          'Diciembre',
        ],
        weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
      },
      theme: document.documentElement.classList.contains('dark') ? 'dark-theme' : 'light-theme',
    });
  });
});
