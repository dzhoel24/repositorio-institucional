document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll("[data-tab]");

    function switchTab(tabId, activeTab) {
        // Ocultar todos los contenidos
        document.querySelectorAll(".tab-content").forEach((content) => {
            content.classList.add("hidden");
        });

        // Mostrar el contenido seleccionado
        const selectedContent = document.getElementById(tabId);
        if (selectedContent) {
            selectedContent.classList.remove("hidden");
        }

        // Actualizar estilos de los tabs
        tabs.forEach((tab) => {
            tab.classList.remove("text-sky-600", "border-sky-600");
            tab.classList.add("text-slate-500", "border-transparent");
        });

        activeTab.classList.remove("text-slate-500", "border-transparent");
        activeTab.classList.add("text-sky-600", "border-sky-600");
    }

    // Agregar event listeners
    tabs.forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();
            const tabId = this.getAttribute("data-tab");
            if (tabId) {
                switchTab(tabId, this);
            }
        });
    });
});
