import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Toastify from "toastify-js"
import "toastify-js/src/toastify.css"

// Ejemplo global para usar en todo el proyecto
window.Toastify = Toastify;