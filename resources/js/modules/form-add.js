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

    if (buscarBtn && dniInput && container && dniOculto) {
        buscarBtn.addEventListener("click", async () => {
            const dni = dniInput.value.trim();

            if (!dni) {
                Toast.fire({ icon: "warning", title: "Debes ingresar un DNI" });
                return;
            }

            if (dniList.includes(dni)) {
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
                        title: data.message || "No se encontró el autor",
                    });
                    return;
                }

                const div = document.createElement("div");
                div.className =
                    "flex items-center justify-between border-b py-2";
                div.innerHTML = `
                    <span>${data.nombres} ${data.apellidos}</span>
                    <button type="button"
                        class="eliminar bg-red-600 text-white px-2 py-1 rounded"
                        data-dni="${dni}">X</button>
                `;

                container.appendChild(div);
                dniList.push(dni);
                dniOculto.value = dniList.join(",");
                dniInput.value = "";

                Toast.fire({ icon: "success", title: "Autor agregado" });
            } catch (err) {
                console.error(err);
                Toast.fire({ icon: "error", title: "Error del servidor" });
            }
        });
    }

    if (container && dniOculto) {
        container.addEventListener("click", (e) => {
            if (!e.target.classList.contains("eliminar")) return;

            const dni = e.target.dataset.dni;

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
                dniList = dniList.filter((d) => d !== dni);
                dniOculto.value = dniList.join(",");
                e.target.parentElement.remove();
                Toast.fire({ icon: "success", title: "Autor eliminado" });
            });
        });
    }
}

document.addEventListener("DOMContentLoaded", initFormAdd);
document.addEventListener("app:init", initFormAdd);
