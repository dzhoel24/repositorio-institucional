@if (session('success') || session('info') || session('error') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Detectar tema actual
            const isDarkMode = document.documentElement.classList.contains('dark');

            // Colores según tema
            const colors = {
                light: {
                    background: '#ffffff',
                    color: '#1e293b',
                    success: '#10b981',
                    error: '#ef4444',
                    info: '#3b82f6'
                },
                dark: {
                    background: '#1e293b',
                    color: '#f1f5f9',
                    success: '#34d399',
                    error: '#f87171',
                    info: '#60a5fa'
                }
            };

            const theme = isDarkMode ? colors.dark : colors.light;

            // Configuración base del Toast
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: theme.background,
                color: theme.color,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            // 1. Manejo de Errores de Validación
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    Toast.fire({
                        icon: "error",
                        text: "{{ $error }}",
                        iconColor: theme.error
                    });
                @endforeach
            @endif

            // 2. Manejo de Mensaje de Éxito
            @if (session('success'))
                Toast.fire({
                    icon: "success",
                    text: "{{ session('success') }}",
                    iconColor: theme.success
                });
            @endif

            // 3. Manejo de Mensaje de Info
            @if (session('info'))
                Toast.fire({
                    icon: "info",
                    text: "{{ session('info') }}",
                    iconColor: theme.info
                });
            @endif

            // 4. Manejo de Mensaje de Error
            @if (session('error'))
                Toast.fire({
                    icon: "error",
                    text: "{{ session('error') }}",
                    iconColor: theme.error
                });
            @endif
        });
    </script>
@endif
