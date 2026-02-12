import '../css/app.css';

/* ============================
   VARIABLES BASE
============================ */

const form = document.getElementById('gpsForm');
const tableBody = document.querySelector('#gpsTable tbody');
const searchInput = document.getElementById('searchInput');
const btnNuevo = document.getElementById('btnNuevo');
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


/* ============================
   MODO EDITAR (delegación)
============================ */

document.addEventListener('click', function (e) {

    if (e.target.closest('.editar')) {

        const row = e.target.closest('tr');

        document.getElementById('gps_id').value = row.dataset.id;
        document.getElementById('transporte_id').value = row.dataset.transporte;
        document.getElementById('tipo_vehiculo').value = row.dataset.tipo;
        document.getElementById('placa').value = row.dataset.placa;
        document.getElementById('plataforma').value = row.dataset.plataforma ?? '';
        document.getElementById('destino').value = row.dataset.destino ?? '';
        document.getElementById('usuario').value = row.dataset.usuario ?? '';
        document.getElementById('contrasena').value = row.dataset.contrasena ?? '';

        highlightRow(row);

        form.scrollIntoView({ behavior: 'smooth' });
    }
});


/* ============================
   BOTÓN NUEVO
============================ */

if (btnNuevo && form) {
    btnNuevo.addEventListener('click', () => {
        form.reset();
        document.getElementById('gps_id').value = '';
        clearErrors();
        clearHighlight();
        form.scrollIntoView({ behavior: 'smooth' });
    });
}


/* ============================
   SUBMIT AJAX
============================ */

if (form) {

    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        clearErrors();

        const formData = new FormData(form);

        try {

            const response = await fetch('/gps', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            // VALIDACIÓN ERROR
            if (response.status === 422) {
                const data = await response.json();
                showErrors(data.errors);
                return;
            }

            const data = await response.json();

            if (data.success) {

                updateTable(data.gps);

                form.reset();
                document.getElementById('gps_id').value = '';
                clearHighlight();
            }

        } catch (error) {
            console.error('Error:', error);
        }

    });
}


/* ============================
   ACTUALIZAR TABLA
============================ */

function updateTable(gps) {

    let row = document.querySelector(`tr[data-id="${gps.id}"]`);

    if (!row) {
        row = document.createElement('tr');
        row.className = "border-b border-stone-800 hover:bg-stone-800/60 transition";
        tableBody.prepend(row);
    }

    // 🔥 ACTUALIZAR DATASETS (MUY IMPORTANTE)
    row.dataset.id = gps.id;
    row.dataset.transporte = gps.transporte_id;
    row.dataset.tipo = gps.tipo_vehiculo;
    row.dataset.placa = gps.placa;
    row.dataset.plataforma = gps.plataforma;
    row.dataset.destino = gps.destino;
    row.dataset.usuario = gps.usuario;
    row.dataset.contrasena = gps.contrasena;

    // 🔥 ACTUALIZAR CONTENIDO VISUAL
    row.innerHTML = `
        <td class="py-4 px-6">${gps.placa}</td>
        <td class="py-4 px-6">${gps.transporte.nombre}</td>
        <td class="py-4 px-6">
            <a href="${gps.plataforma}" target="_blank" class="text-amber-400 hover:underline">
                Ir
            </a>
        </td>
        <td class="py-4 px-6">${gps.usuario}</td>
        <td class="py-4 px-6">${gps.contrasena}</td>
        <td class="py-4 px-6 text-right">
            <button type="button"
                class="editar text-stone-400 hover:text-amber-400 transition text-lg">
                ✏️
            </button>
        </td>
    `;
}


/* ============================
   VALIDACIONES VISUALES
============================ */

function showErrors(errors) {

    Object.keys(errors).forEach(field => {

        const input = document.getElementById(field);

        if (input) {
            input.classList.add(
                'border',
                'border-red-500',
                'ring-2',
                'ring-red-500',
                'bg-red-500/10'
            );
        }
    });
}

function clearErrors() {
    document.querySelectorAll('input, select').forEach(input => {
        input.classList.remove(
            'border',
            'border-red-500',
            'ring-2',
            'ring-red-500',
            'bg-red-500/10'
        );
    });
}


/* ============================
   BUSCADOR DINÁMICO
============================ */

if (searchInput) {

    searchInput.addEventListener('input', () => {

        const value = searchInput.value.toLowerCase();

        document.querySelectorAll('#gpsTable tbody tr').forEach(row => {

            row.classList.toggle(
                'hidden',
                !row.textContent.toLowerCase().includes(value)
            );
        });
    });
}


/* ============================
   EFECTOS VISUALES
============================ */

function highlightRow(row) {
    clearHighlight();
    row.classList.add('bg-amber-500/10');
}

function clearHighlight() {
    document.querySelectorAll('#gpsTable tbody tr')
        .forEach(row => row.classList.remove('bg-amber-500/10'));
}

