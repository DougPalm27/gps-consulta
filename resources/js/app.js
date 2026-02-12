import '../css/app.css';
document.querySelectorAll('.editar').forEach(btn => {
    btn.addEventListener('click', () => {
        const row = btn.closest('tr');

        document.getElementById('gps_id').value = row.dataset.id;
        document.getElementById('transporte_id').value = row.dataset.transporte;
        document.getElementById('tipo_vehiculo').value = row.dataset.tipo;
        document.getElementById('placa').value = row.dataset.placa;
        document.getElementById('plataforma').value = row.dataset.plataforma ?? '';
        document.getElementById('destino').value = row.dataset.destino ?? '';
        document.getElementById('usuario').value = row.dataset.usuario ?? '';
        document.getElementById('contrasena').value = row.dataset.contrasena ?? '';

        document.getElementById('gpsForm')
            .scrollIntoView({ behavior: 'smooth' });
    });
});

/* BUSCADOR */
const searchInput = document.getElementById('searchInput');
const table = document.getElementById('gpsTable');

if (searchInput && table) {
    const rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', () => {
        const value = searchInput.value.toLowerCase();

        rows.forEach(row => {
            row.classList.toggle(
                'hidden',
                !row.textContent.toLowerCase().includes(value)
            );
        });
    });
}

/* BOTÓN NUEVO */
const btnNuevo = document.getElementById('btnNuevo');
const form = document.getElementById('gpsForm');

if (btnNuevo && form) {
    btnNuevo.addEventListener('click', () => {
        form.reset();
        form.scrollIntoView({ behavior: 'smooth' });
    });
}
