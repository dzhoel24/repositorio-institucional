document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[data-tab]').forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault();

            document.querySelectorAll('[role="tabpanel"]').forEach(content => {
                content.classList.add('hidden');
            });

            // Remover clase 'active' de todas las pestañas
            document.querySelectorAll('a[data-tab]').forEach(t => {
                t.classList.remove('text-blue-600', 'border-blue-600', 'active');
            });

            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.remove('hidden');

            this.classList.add('text-blue-600', 'border-blue-600', 'active');
        });
    });
});
