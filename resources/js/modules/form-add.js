function initFormAdd() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    });

    const tipo = document.getElementById("tipo_informe");
    const carrera = document.getElementById("carrera");
    const modulo = document.getElementById("modulo");
    const cajaCarrera = document.getElementById("cajaCarrera");
    const cajaModulo = document.getElementById("cajaModulo");
    const dniInput = document.getElementById("dni");
    const buscarBtn = document.getElementById("buscar");
    const container = document.getElementById("autores-container");
    const dniOculto = document.getElementById("autores-crear");

    let dniList = [];

    // Mostrar/ocultar campos según tipo de informe
    if (tipo) {
        tipo.addEventListener("change", function () {
            if (carrera) carrera.selectedIndex = 0;
            if (modulo) modulo.selectedIndex = 0;

            if (this.value === "1") {
                cajaCarrera?.classList.remove("hidden");
                cajaModulo?.classList.remove("hidden");
            } else if (this.value === "3" || this.value === "4") {
                cajaCarrera?.classList.remove("hidden");
                cajaModulo?.classList.add("hidden");
            } else {
                cajaCarrera?.classList.add("hidden");
                cajaModulo?.classList.add("hidden");
            }
        });
    }

    // Manejar opciones de módulo según carrera
    if (carrera && modulo) {
        carrera.addEventListener("change", function () {
            const ivOption = modulo.querySelector('option[value="IV"]');
            modulo.selectedIndex = 0;

            if (this.value === "7" || this.value === "8") {
                ivOption?.classList.remove("hidden");
            } else {
                ivOption?.classList.add("hidden");
            }
            modulo.disabled = false;
        });
    }

    // Buscar y agregar autor
    if (buscarBtn && dniInput && container && dniOculto) {
        buscarBtn.addEventListener("click", async () => {
            const dni = dniInput.value.trim();

            if (!dni) {
                Toast.fire({
                    icon: "warning",
                    title: "DNI requerido",
                    text: "Debes ingresar un DNI válido",
                });
                return;
            }

            if (dniList.includes(dni)) {
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

                // Crear elemento de autor con mejor diseño
                const div = document.createElement("div");
                div.className =
                    "flex items-center justify-between gap-3 border-b border-slate-100 py-2.5 last:border-0 dark:border-slate-700";
                div.innerHTML = `
                    <div class="flex items-center gap-2">
                        <div class="h-7 w-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs dark:bg-indigo-900/40 dark:text-indigo-400">
                            ${data.nombres?.charAt(0) || "A"}
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                            ${data.nombres} ${data.apellidos}
                        </span>
                    </div>
                    <button type="button"
                        class="eliminar rounded-md bg-red-100 px-2 py-1 text-xs font-semibold text-red-600 transition-all hover:bg-red-200 hover:scale-95 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50"
                        data-dni="${dni}">
                        ✕ Eliminar
                    </button>
                `;

                container.appendChild(div);
                dniList.push(dni);
                dniOculto.value = dniList.join(",");
                dniInput.value = "";

                Toast.fire({
                    icon: "success",
                    title: "Autor agregado",
                    text: `${data.nombres} ${data.apellidos}`,
                });
            } catch (err) {
                console.error(err);
                Toast.fire({
                    icon: "error",
                    title: "Error del servidor",
                    text: "No se pudo completar la búsqueda. Intenta nuevamente.",
                });
            }
        });
    }

    // Eliminar autor de la lista
    if (container && dniOculto) {
        container.addEventListener("click", (e) => {
            if (!e.target.classList.contains("eliminar")) return;

            const dni = e.target.dataset.dni;
            const autorNombre =
                e.target.closest(".flex")?.querySelector("span")?.textContent ||
                "";

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

                dniList = dniList.filter((d) => d !== dni);
                dniOculto.value = dniList.join(",");
                e.target.parentElement.remove();

                Toast.fire({
                    icon: "success",
                    title: "Autor eliminado",
                    text: "Se ha removido de la lista",
                });
            });
        });
    }
}

document.addEventListener("DOMContentLoaded", initFormAdd);
document.addEventListener("app:init", initFormAdd);
