/**
 * Toggle Password - Funcionalidad global para mostrar/ocultar contraseñas
 * Uso: Agregar clase 'toggle-password' y atributo 'data-target="id_del_input"'
 */

(function () {
    "use strict";

    function initPasswordToggles() {
        const toggles = document.querySelectorAll(".toggle-password");

        toggles.forEach((toggle) => {
            // Evitar duplicar event listeners
            if (toggle.dataset.initialized === "true") return;
            toggle.dataset.initialized = "true";

            toggle.addEventListener("click", function (e) {
                e.preventDefault();

                const targetId = this.dataset.target;
                if (!targetId) {
                    console.warn(
                        "Toggle password: data-target no especificado",
                    );
                    return;
                }

                const input = document.getElementById(targetId);
                if (!input) {
                    console.warn(
                        `Toggle password: Input con id "${targetId}" no encontrado`,
                    );
                    return;
                }

                const isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";

                // Cambiar icono (soporta FontAwesome y Heroicons)
                const icon = this.querySelector("i, svg");
                if (icon) {
                    if (icon.tagName === "I") {
                        // FontAwesome
                        if (isPassword) {
                            icon.classList.remove("fa-eye");
                            icon.classList.add("fa-eye-slash");
                        } else {
                            icon.classList.remove("fa-eye-slash");
                            icon.classList.add("fa-eye");
                        }
                    } else if (icon.tagName === "svg") {
                        // Heroicons - mantener el mismo comportamiento
                        const isOpen = !isPassword;
                        icon.innerHTML = isOpen
                            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>'
                            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                    }
                }

                // Cambiar el texto del tooltip/aria-label si existe
                const ariaLabel = this.getAttribute("aria-label");
                if (ariaLabel) {
                    this.setAttribute(
                        "aria-label",
                        isPassword
                            ? "Ocultar contraseña"
                            : "Mostrar contraseña",
                    );
                }
            });
        });
    }

    // Inicializar cuando el DOM esté listo
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initPasswordToggles);
    } else {
        initPasswordToggles();
    }

    document.addEventListener("htmx:afterSwap", initPasswordToggles);
    document.addEventListener("app:init", initPasswordToggles);
})();
