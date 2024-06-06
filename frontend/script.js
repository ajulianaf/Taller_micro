const urlTareas = "http://127.0.0.1:8000/tareas";
let tareas = [];

function consultarTareas() {
    fetch(urlTareas)
        .then((res) => res.json())
        .then((body) => {
            tareas = body.data;
            console.log(tareas);
            cargarTablaTareas();
        })
        .catch((error) => {
            mostrarError(error.message);
        });
}

function cargarTablaTareas() {
    const tbody = document.getElementById("tareas-body");
    tbody.innerHTML = tareas
        .map((item) => {
            let html = "<tr>";
            html += "   <td>" + item.titulo + "</td>";
            html += "   <td>" + item.prioridad + "</td>";
            html += "</tr>";
            return html;
        })
        .join("");
}

function mostrarError(mensaje) {
    const errorContainer = document.getElementById("error-container");
    errorContainer.innerHTML = `<p>Algo salió mal al cargar las tareas. Por favor, intente más tarde.</p>`;
}

consultarTareas();
