// Obtener los botones y los divs correspondientes
const btnElMundo = document.querySelector('#el-mundo');
const divElMundo = document.querySelector('#elmundo');
const btnElPais = document.querySelector('#el-pais');
const divElPais = document.querySelector('#elpais');
const btnMasNoticias = document.querySelector('#mas-noticias');
const divMasNoticias = document.querySelector('#masnoticias');

// Función para ocultar todos los divs
const ocultarDivs = () => {
    if (divElMundo.style.display !== 'none') {
        divElMundo.style.display = 'none';
    }
    if (divElPais.style.display !== 'none') {
        divElPais.style.display = 'none';
    }
    if (divMasNoticias.style.display !== 'none') {
        divMasNoticias.style.display = 'none';
    }
};


// Funciones para mostrar los divs correspondientes y ocultar los demás
const mostrarElMundo = () => {
    if (divElMundo.style.display === 'block') {
        divElMundo.style.display = 'none';
    } else {
        ocultarDivs();
        divElMundo.style.display = 'block';
    }
};

const mostrarElPais = () => {
    if (divElPais.style.display === 'block') {
        divElPais.style.display = 'none';
    } else {
        ocultarDivs();
        divElPais.style.display = 'block';
    }
};

const mostrarMasNoticias = () => {
    if (divMasNoticias.style.display === 'block') {
        divMasNoticias.style.display = 'none';
    } else {
        ocultarDivs();
        divMasNoticias.style.display = 'block';
    }
};

// Asignar los eventos de clic a los botones correspondientes
btnElMundo.addEventListener('click', mostrarElMundo);
btnElPais.addEventListener('click', mostrarElPais);
btnMasNoticias.addEventListener('click', mostrarMasNoticias);

// Ocultar todos los divs al cargar la página
ocultarDivs();