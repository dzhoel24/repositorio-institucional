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

    // ===== COLAPSO PARA MÓVIL (cierra el sidebar) =====
    window.toggleCollapseMobile = function () {
        if (window.innerWidth <= 900) {
            window.closeSidebar();
        } else {
            window.toggleCollapse();
        }
    };

    // ===== DROPDOWN =====
    window.toggleDropdown = function (menuId, arrowId) {
        if (document.documentElement.classList.contains("sidebar-collapsed")) {
            const firstSubItem = document.querySelector(
                `#${menuId} [data-route]`,
            );
            if (firstSubItem) firstSubItem.click();
            return;
        }

        const menu = document.getElementById(menuId);
        const arrow = document.getElementById(arrowId);
        const trigger = document.querySelector(`[aria-controls="${menuId}"]`);

        if (!menu) return;

        const isOpen = menu.classList.contains("open");

        menu.classList.toggle("open", !isOpen);
        if (arrow) arrow.classList.toggle("open", !isOpen);
        if (trigger) trigger.setAttribute("aria-expanded", String(!isOpen));
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

        if (isOpen) {
            document.body.style.overflow = "hidden";
            document.body.classList.add("sidebar-open-mobile");
        } else {
            document.body.style.overflow = "";
            document.body.classList.remove("sidebar-open-mobile");
        }
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

        document.body.style.overflow = "";
        document.body.classList.remove("sidebar-open-mobile");
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
            confirmButtonColor: "#4f46e5",
            confirmButtonText: "Sí, salir",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed)
                document.getElementById("logout-form").submit();
        });
    };

    // ===== MANEJO DE PAGINACIÓN HTMX =====
    let navClickPending = false;

    document.addEventListener("click", function (e) {
        const link = e.target.closest("nav a, .pagination a");
        if (!link) return;

        const href = link.getAttribute("href");
        if (!href || !href.includes("page=")) return;

        if (navClickPending) {
            e.preventDefault();
            return;
        }

        e.preventDefault();
        navClickPending = true;
        setTimeout(() => {
            navClickPending = false;
        }, 500);

        let url;
        try {
            url = new URL(href).pathname + new URL(href).search;
        } catch {
            url = href;
        }

        htmx.ajax("GET", url, {
            target: "#main-content",
            swap: "innerHTML",
            pushUrl: true,
        });
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
            let route = el.getAttribute("data-route");
            if (route && route.startsWith(window.location.origin)) {
                route = route.replace(window.location.origin, "");
            }

            const isActive =
                current === route ||
                (route !== "/" && current.startsWith(route + "/"));

            if (isActive) {
                el.classList.add("active");

                const submenu = el.closest(".sub-menu");
                if (
                    submenu &&
                    window.innerWidth > 900 &&
                    !document.documentElement.classList.contains(
                        "sidebar-collapsed",
                    )
                ) {
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
        background: #4f46e5;
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
        progressBar.style.background = "#4f46e5";
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
            progressBar.style.background = "#4f46e5";
        }, 600);
    }

    // ===== ACCESO RÁPIDO CON TECLA '/' =====
    document.addEventListener("keydown", function (e) {
        if (
            e.key === "/" &&
            document.activeElement.tagName !== "INPUT" &&
            document.activeElement.tagName !== "TEXTAREA"
        ) {
            e.preventDefault();
            const searchInput = document.querySelector(
                'input[type="search"], input[placeholder*="buscar"], input[placeholder*="Buscar"]',
            );
            if (searchInput) searchInput.focus();
        }
    });

    // ===== EVENTOS GLOBALES =====
    function init() {
        updateActiveState();

        document.addEventListener("page:title", function (e) {
            const title = e.detail;
            const breadcrumb = document.getElementById("breadcrumb-title");
            if (breadcrumb) breadcrumb.textContent = title;
            document.title = "Repositorio | " + title;
        });

        document.addEventListener("click", function (e) {
            const profileArea = document.getElementById("profileArea");
            if (profileArea && !profileArea.contains(e.target)) {
                window.closeProfile();
            }
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") {
                window.closeSidebar();
                window.closeProfile();
            }
        });

        let resizeTimer;
        window.addEventListener("resize", function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth > 900) {
                    window.closeSidebar();
                    document.body.style.overflow = "";
                } else {
                    const isCollapsed =
                        localStorage.getItem("sidebar-collapsed");
                    if (isCollapsed === "true") {
                        document.documentElement.classList.remove(
                            "sidebar-collapsed",
                        );
                    }
                }
            }, 150);
        });

        window.addEventListener(
            "scroll",
            function () {
                if (window.innerWidth > 900) {
                    window.closeProfile();
                }
            },
            { passive: true },
        );

        document.addEventListener("htmx:beforeRequest", function () {
            if (window.innerWidth <= 900) window.closeSidebar();
            startProgress();
        });

        document.addEventListener("htmx:afterSwap", function (e) {
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

        document.addEventListener("htmx:afterRequest", function () {
            finishProgress();
        });

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
