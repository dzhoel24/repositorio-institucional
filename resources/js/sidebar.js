(function () {
    "use strict";

    if (window.innerWidth <= 900) {
        document.documentElement.classList.remove("sidebar-collapsed");
    }

    // ===== TEMA =====
    function applyTheme(dark) {
        document.documentElement.classList.toggle("dark", dark);
        const btn = document.getElementById("themeBtn");
        if (btn) {
            btn.setAttribute(
                "aria-label",
                dark ? "Cambiar a tema claro" : "Cambiar a tema oscuro",
            );
        }
        localStorage.setItem("theme", dark ? "dark" : "light");
    }

    window.toggleTheme = function () {
        applyTheme(!document.documentElement.classList.contains("dark"));
    };

    // ===== COLAPSO (solo escritorio) =====
    window.toggleCollapse = function () {
        if (window.innerWidth <= 900) return;

        const isCollapsed =
            document.documentElement.classList.toggle("sidebar-collapsed");
        localStorage.setItem("sidebar-collapsed", isCollapsed);

        // Al colapsar, cerrar todos los submenús abiertos
        if (isCollapsed) {
            document.querySelectorAll(".sub-menu.open").forEach((menu) => {
                menu.classList.remove("open");
                const arrow = document.getElementById(
                    menu.id.replace("sub-", "arr-"),
                );
                if (arrow) arrow.classList.remove("open");
                const trigger = document.querySelector(
                    `[aria-controls="${menu.id}"]`,
                );
                if (trigger) trigger.setAttribute("aria-expanded", "false");
            });
        }
    };

    // ===== DROPDOWN =====
    window.toggleDropdown = function (menuId, arrowId, triggerEl) {
        // Si está colapsado: navegar directo al primer subitem
        if (document.documentElement.classList.contains("sidebar-collapsed")) {
            const firstSubItem = document.querySelector(
                `#${menuId} [data-route]`,
            );
            if (firstSubItem) firstSubItem.click();
            return;
        }

        const menu = document.getElementById(menuId);
        const arrow = document.getElementById(arrowId);

        if (!menu) {
            console.error("Menu no encontrado:", menuId);
            return;
        }

        const isOpen = menu.classList.contains("open");

        if (isOpen) {
            menu.classList.remove("open");
            if (arrow) arrow.classList.remove("open");
            if (triggerEl) triggerEl.setAttribute("aria-expanded", "false");
        } else {
            menu.classList.add("open");
            if (arrow) arrow.classList.add("open");
            if (triggerEl) triggerEl.setAttribute("aria-expanded", "true");
        }
    };

    // ===== SIDEBAR MÓVIL =====
    window.toggleSidebar = function () {
        if (window.innerWidth > 900) return;

        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        const hamburger = document.getElementById("hamburger");

        document.documentElement.classList.remove("sidebar-collapsed");

        const isOpen = sidebar.classList.toggle("open");

        if (hamburger) {
            hamburger.classList.toggle("open", isOpen);
            hamburger.setAttribute("aria-expanded", String(isOpen));
        }
        if (overlay) overlay.classList.toggle("visible", isOpen);
    };

    window.closeSidebar = function () {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        const hamburger = document.getElementById("hamburger");

        if (sidebar) sidebar.classList.remove("open");
        if (overlay) overlay.classList.remove("visible");
        if (hamburger) {
            hamburger.classList.remove("open");
            hamburger.setAttribute("aria-expanded", "false");
        }
    };

    // ===== PERFIL =====
    window.toggleProfile = function () {
        const dropdown = document.getElementById("profileDropdown");
        const btn = document.getElementById("profileBtn");
        if (!dropdown) return;

        const isOpen = dropdown.classList.contains("open");

        document.querySelectorAll(".profile-dropdown.open").forEach((el) => {
            if (el !== dropdown) el.classList.remove("open");
        });

        dropdown.classList.toggle("open", !isOpen);
        if (btn) btn.setAttribute("aria-expanded", String(!isOpen));
    };

    window.closeProfile = function () {
        const dropdown = document.getElementById("profileDropdown");
        const btn = document.getElementById("profileBtn");
        if (dropdown) dropdown.classList.remove("open");
        if (btn) btn.setAttribute("aria-expanded", "false");
    };

    // ===== LOGOUT =====
    window.confirmLogout = function () {
        Swal.fire({
            title: "¿Cerrar sesión?",
            text: "Se cerrará tu sesión actual.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0ea5e9",
            confirmButtonText: "Sí, salir",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed)
                document.getElementById("logout-form").submit();
        });
    };

    document.addEventListener("click", function (e) {
        const link = e.target.closest("nav a, .pagination a");
        if (!link) return;

        const url = link.getAttribute("href");
        if (url && url.includes("page=")) {
            e.preventDefault();
            htmx.ajax("GET", url, {
                target: "#main-content",
                swap: "innerHTML",
                pushUrl: true,
            });
        }
    });

    // ===== ESTADO ACTIVO =====
    function updateActiveState() {
        const current = window.location.pathname;

        document
            .querySelectorAll(".nav-item, .sub-item, .dropdown-trigger")
            .forEach((el) => {
                el.classList.remove("active", "parent-active");
            });

        document.querySelectorAll("[data-route]").forEach((el) => {
            const route = el
                .getAttribute("data-route")
                .replace(window.location.origin, "");

            const isActive =
                current === route ||
                (route !== "/" && current.startsWith(route + "/"));

            if (isActive) {
                el.classList.add("active");

                const submenu = el.closest(".sub-menu");
                if (submenu) {
                    submenu.classList.add("open");

                    const trigger = document.querySelector(
                        `[aria-controls="${submenu.id}"]`,
                    );
                    if (trigger) {
                        trigger.classList.add("parent-active");
                        trigger.setAttribute("aria-expanded", "true");
                    }

                    const arrow = document.getElementById(
                        submenu.id.replace("sub-", "arr-"),
                    );
                    if (arrow) arrow.classList.add("open");
                }
            }
        });
    }

    // ===== BARRA DE PROGRESO =====
    const progressBar = document.createElement("div");
    progressBar.id = "htmx-progress";
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        width: 0%;
        background: #0ea5e9;
        z-index: 9999;
        transition: width 0.2s ease, opacity 0.3s ease;
        opacity: 0;
        pointer-events: none;
    `;
    document.body.appendChild(progressBar);

    let progressTimer = null;

    function startProgress() {
        clearTimeout(progressTimer);
        progressBar.style.opacity = "1";
        progressBar.style.background = "#0ea5e9";
        progressBar.style.width = "0%";
        requestAnimationFrame(() => {
            progressBar.style.width = "70%";
        });
    }

    function finishProgress() {
        progressBar.style.width = "100%";
        clearTimeout(progressTimer);
        progressTimer = setTimeout(() => {
            progressBar.style.opacity = "0";
            progressBar.style.width = "0%";
        }, 300);
    }

    function errorProgress() {
        progressBar.style.background = "#ef4444";
        progressBar.style.width = "100%";
        clearTimeout(progressTimer);
        progressTimer = setTimeout(() => {
            progressBar.style.opacity = "0";
            progressBar.style.width = "0%";
            progressBar.style.background = "#0ea5e9";
        }, 600);
    }

    // ===== INIT =====
    function init() {
        updateActiveState();

        // Actualizar título y breadcrumb desde cada content.blade.php
        document.addEventListener("page:title", function (e) {
            const title = e.detail;
            const breadcrumb = document.getElementById("breadcrumb-title");
            if (breadcrumb) breadcrumb.textContent = title;
            document.title = "Repositorio | " + title;
        });

        // Cerrar perfil al hacer clic fuera
        document.addEventListener("click", function (e) {
            const profileArea = document.getElementById("profileArea");
            if (profileArea && !profileArea.contains(e.target)) {
                window.closeProfile();
            }
        });

        // Cerrar con Escape
        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") {
                window.closeSidebar();
                window.closeProfile();
            }
        });

        // Resize
        window.addEventListener("resize", function () {
            if (window.innerWidth > 900) {
                window.closeSidebar();
            }
        });

        // ===== HTMX: antes de la petición =====
        document.addEventListener("htmx:beforeRequest", function () {
            // Cerrar sidebar en móvil
            if (window.innerWidth <= 900) {
                window.closeSidebar();
            }
            // Iniciar barra de progreso
            startProgress();
        });

        // ===== HTMX: swap completado =====
        document.addEventListener("htmx:afterSwap", function (e) {
            // Re-ejecutar scripts del contenido swapeado
            // Necesario para que page:title y app:init funcionen tras la navegación
            e.detail.target
                .querySelectorAll("script")
                .forEach(function (oldScript) {
                    const newScript = document.createElement("script");
                    Array.from(oldScript.attributes).forEach((attr) => {
                        newScript.setAttribute(attr.name, attr.value);
                    });
                    newScript.textContent = oldScript.textContent;
                    oldScript.parentNode.replaceChild(newScript, oldScript);
                });

            updateActiveState();
            document.dispatchEvent(new Event("app:init"));
        });

        // ===== HTMX: petición terminada (con o sin swap) =====
        // Cubre errores, redirecciones y respuestas sin swap
        document.addEventListener("htmx:afterRequest", function () {
            finishProgress();
        });

        // ===== HTMX: error de respuesta =====
        document.addEventListener("htmx:responseError", function () {
            errorProgress();
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
