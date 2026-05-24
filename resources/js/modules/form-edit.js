function initFormEdit() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    });

    const estados = {};

    // Inicializar autores desde campos ocultos
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

    // Buscar y agregar autor
    document.querySelectorAll(".btn-buscar").forEach((btn) => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;
            const input = document.querySelector(`.dni-input[data-id="${id}"]`);
            const dni = input.value.trim();

            if (!dni) {
                Toast.fire({
                    icon: "warning",
                    title: "DNI requerido",
                    text: "Debes ingresar un DNI válido",
                });
                return;
            }

            if (!estados[id]) estados[id] = [];

            if (estados[id].some((a) => a.dni === dni)) {
                Toast.fire({
                    icon: "info",
                    title: "Autor duplicado",
                    text: "Este autor ya fue agregado a la lista",
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
                        title: "No encontrado",
                        text:
                            data.message ||
                            "No se encontró un autor con ese DNI",
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

                Toast.fire({
                    icon: "success",
                    title: "Autor agregado",
                    text: `${data.nombres} ${data.apellidos}`,
                });
            } catch (e) {
                Toast.fire({
                    icon: "error",
                    title: "Error del servidor",
                    text: "No se pudo completar la búsqueda. Intenta nuevamente.",
                });
            }
        });
    });

    // Renderizar lista de autores
    function renderAutores(id) {
        const container = document.querySelector(
            `.autores-container[data-id="${id}"]`,
        );
        const hidden = document.querySelector(
            `.autores-hidden[data-id="${id}"]`,
        );

        if (!container || !hidden) return;

        container.innerHTML = "";

        if (estados[id].length === 0) {
            const emptyDiv = document.createElement("div");
            emptyDiv.className =
                "text-center py-4 text-slate-400 dark:text-slate-500 text-sm";
            emptyDiv.textContent = "No hay autores agregados";
            container.appendChild(emptyDiv);
        } else {
            estados[id].forEach((a, i) => {
                const div = document.createElement("div");
                div.className =
                    "flex items-center justify-between gap-3 border-b border-slate-100 py-2.5 last:border-0 dark:border-slate-700";
                div.innerHTML = `
                    <div class="flex items-center gap-2">
                        <div class="h-7 w-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs dark:bg-indigo-900/40 dark:text-indigo-400">
                            ${a.nombres?.charAt(0) || "A"}
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                            ${a.nombres} ${a.apellidos}
                        </span>
                    </div>
                    <button type="button" class="btn-remove rounded-md bg-red-100 px-2 py-1 text-xs font-semibold text-red-600 transition-all hover:bg-red-200 hover:scale-95 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50" 
                        data-id="${id}" data-index="${i}">
                        ✕ Eliminar
                    </button>
                `;
                container.appendChild(div);
            });
        }

        hidden.value = estados[id].map((a) => a.dni).join(",");
    }

    // Eliminar autor
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".btn-remove")) return;

        const btn = e.target.closest(".btn-remove");
        const id = btn.dataset.id;
        const index = parseInt(btn.dataset.index);
        const autorNombre = estados[id]?.[index]?.nombres || "";

        Swal.fire({
            icon: "question",
            title: "¿Eliminar autor?",
            text: `¿Seguro que deseas quitar a ${autorNombre} del listado?`,
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#dc2626",
        }).then((result) => {
            if (!result.isConfirmed) return;

            estados[id].splice(index, 1);
            renderAutores(id);

            Toast.fire({
                icon: "success",
                title: "Autor eliminado",
                text: "Se ha removido de la lista",
            });
        });
    });

    // Manejar condicionales de tipo_informe
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
