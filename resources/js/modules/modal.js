const MODAL_ANIMATION_TIME = 180;

/********* IMAGE PREVIEW *********/
window.previewImage = function (event, id = null) {
    const input = event.target;
    const img = id
        ? document.getElementById(`imgPreview${id}`)
        : document.getElementById("imgPreview");

    if (!input.files.length) {
        if (img) {
            img.src = "";
            img.classList.add("hidden");
        }
        return;
    }

    if (img) {
        img.src = URL.createObjectURL(input.files[0]);
        img.classList.remove("hidden");
    }
};

/********* RESET MODAL *********/
function resetModal(modal) {
    if (!modal) return;

    const form = modal.querySelector("form");
    if (form) form.reset();

    const img = modal.querySelector("#imgPreview");
    if (img) {
        img.src = "";
        img.classList.add("hidden");
    }

    const autores = modal.querySelector("#autores-container");
    if (autores) autores.innerHTML = "";

    modal
        .querySelectorAll('input[type="file"]')
        .forEach((input) => (input.value = ""));

    const cajaCarrera = modal.querySelector("#cajaCarrera");
    const cajaModulo = modal.querySelector("#cajaModulo");
    const tipo = modal.querySelector("#tipo_informe");
    const carrera = modal.querySelector("#carrera");
    const modulo = modal.querySelector("#modulo");

    if (cajaCarrera) cajaCarrera.classList.add("hidden");
    if (cajaModulo) cajaModulo.classList.add("hidden");
    if (tipo) tipo.selectedIndex = 0;
    if (carrera) carrera.selectedIndex = 0;
    if (modulo) {
        modulo.selectedIndex = 0;
        modulo.disabled = true;
    }
}

/********* OPEN MODAL *********/
function openModal(modal) {
    if (!modal) return;
    modal.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
    const content = modal.querySelector(".modal-animate");
    if (content) {
        content.classList.remove("modal-animate-out");
        content.classList.add("modal-animate-in");
    }
}

/********* CLOSE MODAL *********/
function closeModal(modal) {
    if (!modal) return;
    const content = modal.querySelector(".modal-animate");
    if (content) {
        content.classList.remove("modal-animate-in");
        content.classList.add("modal-animate-out");
    }
    setTimeout(() => {
        modal.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
        if (content) content.classList.remove("modal-animate-out");
        resetModal(modal);
    }, MODAL_ANIMATION_TIME);
}

/********* INIT — se ejecuta en carga normal y después de cada swap HTMX *********/
function initModals() {
    // Botones de apertura
    document.querySelectorAll('[data-tw-toggle="modal"]').forEach((btn) => {
        const clone = btn.cloneNode(true);
        btn.replaceWith(clone);
        clone.addEventListener("click", () => {
            const target = document.querySelector(clone.dataset.twTarget);
            openModal(target);
        });
    });

    // Image preview dentro de modales
    document.querySelectorAll('input[name="caratula"]').forEach((input) => {
        const clone = input.cloneNode(true);
        input.replaceWith(clone);
        clone.addEventListener("change", (event) => {
            const modal = clone.closest(".modal");
            const img = modal?.querySelector("#imgPreview");
            if (!img) return;
            const file = event.target.files[0];
            if (!file) {
                img.src = "";
                img.classList.add("hidden");
                return;
            }
            const url = URL.createObjectURL(file);
            img.src = url;
            img.classList.remove("hidden");
            img.onload = () => URL.revokeObjectURL(url);
        });
    });
}

document.addEventListener("DOMContentLoaded", initModals);
document.addEventListener("app:init", initModals);

/********* CLOSE BUTTONS — delegados, no necesitan re-init *********/
document.addEventListener("click", (e) => {
    const closeBtn = e.target.closest('[data-tw-dismiss="modal"]');
    if (!closeBtn) return;
    const modal = closeBtn.closest(".modal");
    closeModal(modal);
});

/********* CLICK OUTSIDE *********/
document.addEventListener("click", (e) => {
    const modal = e.target.closest(".modal");
    if (!modal) return;

    // Si el clic fue en un radio button o en su label, no cerrar
    if (e.target.closest('input[type="radio"]') || e.target.closest("label")) {
        return;
    }

    const content = e.target.closest(".modal-animate");
    if (!content) closeModal(modal);
});

/********* ESC KEY *********/
document.addEventListener("keydown", (e) => {
    if (e.key !== "Escape") return;
    document
        .querySelectorAll(".modal:not(.hidden)")
        .forEach((modal) => closeModal(modal));
});
