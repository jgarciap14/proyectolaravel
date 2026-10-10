import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-password').forEach(boton => {
        boton.addEventListener('click', () => {
            const input = boton.parentElement.querySelector('input');
            const visible = input.type === 'text';
            input.type = visible ? 'password' : 'text';
            boton.querySelector('i').className = visible ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    });

    const password = document.querySelector('[data-fuerza]');
    if (password) {
        const barra = document.querySelector('.fuerza div');
        const texto = document.getElementById('fuerza-texto');
        const niveles = [
            ['0%', '#d2d2d7', ''],
            ['25%', '#ff3b30', 'Débil'],
            ['50%', '#ff9500', 'Regular'],
            ['75%', '#ffcc00', 'Buena'],
            ['100%', '#34c759', 'Excelente'],
        ];

        password.addEventListener('input', () => {
            const v = password.value;
            let puntos = 0;
            if (v.length >= 8) puntos++;
            if (/[A-Z]/.test(v) && /[a-z]/.test(v)) puntos++;
            if (/\d/.test(v)) puntos++;
            if (/[^A-Za-z0-9]/.test(v)) puntos++;
            const [ancho, color, etiqueta] = niveles[v ? puntos : 0];
            barra.style.width = ancho;
            barra.style.background = color;
            texto.textContent = etiqueta;
        });
    }

    const filtro = document.getElementById('filtro-clientes');
    if (filtro) {
        const filas = document.querySelectorAll('.tabla-clientes tbody tr[data-cliente]');
        const contador = document.getElementById('contador-clientes');

        filtro.addEventListener('input', () => {
            const texto = filtro.value.toLowerCase();
            let visibles = 0;
            filas.forEach(fila => {
                const coincide = fila.textContent.toLowerCase().includes(texto);
                fila.classList.toggle('d-none', !coincide);
                if (coincide) visibles++;
            });
            contador.textContent = visibles;
        });
    }

    const menu = document.getElementById('btn-menu');
    if (menu) {
        menu.addEventListener('click', () => document.querySelector('.sidebar').classList.toggle('abierta'));
    }
});
