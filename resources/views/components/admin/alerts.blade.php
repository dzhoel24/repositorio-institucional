@if (session('success') || session('info') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = document.documentElement.classList.contains('dark');

            // Configuración base del Toast
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: isDarkMode ? '#1e293b' : '#ffffff',
                color: isDarkMode ? '#f1f5f9' : '#1e293b',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            // 1. Manejo de Errores de Validación (Login o Formularios)
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    Toast.fire({
                        icon: "error",
                        text: "{{ $error }}",
                        iconColor: '#ef4444'
                    });
                @endforeach
            @endif

            // 2. Manejo de Mensajes de Éxito o Info
            @if (session('success') || session('info'))
                const iconType = "{{ session('success') ? 'success' : 'info' }}";
                const messageText = "{{ session('success') ?? session('info') }}";

                Toast.fire({
                    icon: iconType,
                    text: messageText,
                    iconColor: iconType === 'success' ? '#10b981' : '#3b82f6'
                });
            @endif
        });
    </script>
@endif
