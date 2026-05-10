function initFormEdit() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    });

    const estados = {};

    document.querySelectorAll(".autores-hidden").forEach((hidden) => {
        const id = hidden.dataset.id;
        const inicial = hidden.dataset.autores;
        if (inicial) {
            try {
                estados[id] = JSON.parse(inicial);
                renderAutores(id);
            } catch (e) {
                estados[id] = [];
            }
        }
    });

    document.querySelectorAll(".btn-buscar").forEach((btn) => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;
            const input = document.querySelector(`.dni-input[data-id="${id}"]`);
            const dni = input.value.trim();

            if (!dni) {
                Toast.fire({ icon: "warning", title: "Debes ingresar un DNI" });
                return;
            }

            if (!estados[id]) estados[id] = [];

            if (estados[id].some((a) => a.dni === dni)) {
                Toast.fire({
                    icon: "info",
                    title: "Este autor ya fue agregado",
                });
                return;
            }

            try {
                const url = document.getElementById("app").dataset.buscarUrl;
                const res = await fetch(
                    `${url}?dni=${encodeURIComponent(dni)}`,
                );
                const data = await res.json();

                if (!res.ok) {
                    Toast.fire({
                        icon: "error",
                        title: data.message || "Autor no encontrado",
                    });
                    return;
                }

                estados[id].push({
                    dni,
                    nombres: data.nombres,
                    apellidos: data.apellidos,
                });
                renderAutores(id);
                input.value = "";
                Toast.fire({ icon: "success", title: "Autor agregado" });
            } catch (e) {
                Toast.fire({ icon: "error", title: "Error del servidor" });
            }
        });
    });

    function renderAutores(id) {
        const container = document.querySelector(
            `.autores-container[data-id="${id}"]`,
        );
        const hidden = document.querySelector(
            `.autores-hidden[data-id="${id}"]`,
        );

        if (!container || !hidden) return;

        container.innerHTML = "";

        estados[id].forEach((a, i) => {
            const div = document.createElement("div");
            div.className = "flex justify-between border-b py-1";
            div.innerHTML = `
                <span>${a.nombres} ${a.apellidos}</span>
                <button type="button"  class="bg-red-600 text-white px-2 py-1 rounded btn-remove" 
                    data-id="${id}" data-index="${i}"> X </button>
            `;
            container.appendChild(div);
        });

        hidden.value = estados[id].map((a) => a.dni).join(",");
    }

    document.addEventListener("click", (e) => {
        if (!e.target.closest(".btn-remove")) return;

        const btn = e.target.closest(".btn-remove");
        const id = btn.dataset.id;
        const index = parseInt(btn.dataset.index);

        Swal.fire({
            icon: "question",
            title: "¿Eliminar autor?",
            text: "Se quitará del listado actual",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#dc2626",
        }).then((result) => {
            if (!result.isConfirmed) return;
            estados[id].splice(index, 1);
            renderAutores(id);
            Toast.fire({ icon: "success", title: "Autor eliminado" });
        });
    });

    // ===== CORREGIDO: CONDICIONALES CON EVENTO CHANGE =====
    document.querySelectorAll(".tipo-select").forEach((select) => {
        const id = select.dataset.id;
        const cajaCarrera = document.querySelector(
            `.caja-carrera[data-id="${id}"]`,
        );
        const cajaModulo = document.querySelector(
            `.caja-modulo[data-id="${id}"]`,
        );

        if (!cajaCarrera || !cajaModulo) return;

        function actualizarCondicionales() {
            const tipo = select.value;

            // Ocultar todo
            cajaCarrera.classList.add("hidden");
            cajaModulo.classList.add("hidden");

            // Mostrar según el tipo
            if (tipo === "1") {
                cajaCarrera.classList.remove("hidden");
                cajaModulo.classList.remove("hidden");
            } else if (tipo === "3" || tipo === "4") {
                cajaCarrera.classList.remove("hidden");
            }
        }

        actualizarCondicionales();
        select.addEventListener("change", actualizarCondicionales);
    });
}

document.addEventListener("DOMContentLoaded", initFormEdit);
document.addEventListener("app:init", initFormEdit);
