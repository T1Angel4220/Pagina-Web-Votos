// Mensaje para verificar que el archivo de JavaScript está cargado
console.log("Script cargado correctamente");

function filterProposals() {
    console.log("Evento onchange activado"); // Verificar si el evento se activa

    var selectedFaculty = document.getElementById("faculty").value;

    // Realizar una solicitud AJAX para obtener las propuestas desde el servidor
    fetch('http://localhost/Pagina_Web/Pagina_Web/src/propuestas_queries.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `category=${encodeURIComponent(selectedFaculty)}`
    })
    .then(response => response.json())
    .then(data => {
        console.log("Datos recibidos del servidor:", data); // Verificar que los nombres de los partidos llegan
        displayProposals(data);
    })
    .catch(error => console.error('Error:', error));
    
}

function displayProposals(proposals) {
    const partido1Nombre = document.getElementById("partido1Nombre");
    const partido2Nombre = document.getElementById("partido2Nombre");
    const candidato1Description = document.getElementById("candidato1Description");
    const candidato2Description = document.getElementById("candidato2Description");

    // Limpia el contenido anterior
    partido1Nombre.innerHTML = "";
    partido2Nombre.innerHTML = "";
    candidato1Description.innerHTML = "";
    candidato2Description.innerHTML = "";

    // Agrupamos las propuestas por partidos
    const partidos = [...new Set(proposals.map(proposal => proposal.partido))];

    // Verificamos si hay al menos un partido
    if (partidos.length > 0) {
        // Mostrar siempre el nombre del primer partido
        const partido1 = partidos[0];
        partido1Nombre.innerText = partido1;

        // Filtra propuestas para el primer partido y muestra
        const partido1Proposals = proposals.filter(proposal => proposal.partido === partido1);
        if (partido1Proposals.length > 0) {
            candidato1Description.innerHTML = partido1Proposals.map((proposal, index) => `
                <div class="proposal-item visible">
                    <strong>Propuesta ${index + 1}: ${proposal.titulo}</strong>
                    <p>${proposal.descripcion}</p>
                    <p><strong>Categoría:</strong> ${proposal.categoria}</p>
                </div>
            `).join('');
        } else {
            candidato1Description.innerHTML = `<div class="proposal-item visible"><strong>No hay propuestas disponibles para este partido.</strong></div>`;
        }

        // Mostrar el nombre del segundo partido dinámicamente, aunque no tenga propuestas
        const segundoPartido = proposals.find(proposal => proposal.partido !== partido1);
        if (segundoPartido) {
            const partido2 = segundoPartido.partido;
            partido2Nombre.innerText = partido2;

            // Filtra propuestas para el segundo partido
            const partido2Proposals = proposals.filter(proposal => proposal.partido === partido2);
            if (partido2Proposals.length > 0) {
                candidato2Description.innerHTML = partido2Proposals.map((proposal, index) => `
                    <div class="proposal-item visible">
                        <strong>Propuesta ${index + 1}: ${proposal.titulo}</strong>
                        <p>${proposal.descripcion}</p>
                        <p><strong>Categoría:</strong> ${proposal.categoria}</p>
                    </div>
                `).join('');
            } else {
                candidato2Description.innerHTML = `<div class="proposal-item visible"><strong>No hay propuestas disponibles para este partido.</strong></div>`;
            }
        } else {
            // Si no hay un segundo partido, mostrar un mensaje para el segundo cuadro
            partido2Nombre.innerText = "Partido no disponible";
            candidato2Description.innerHTML = `<div class="proposal-item visible"><strong>No hay propuestas disponibles para este partido.</strong></div>`;
        }
    } else {
        // Si no hay ningún partido disponible
        partido1Nombre.innerText = "No hay partidos disponibles";
        partido2Nombre.innerText = "No hay partidos disponibles";
        candidato1Description.innerHTML = `<div class="proposal-item visible"><strong>No hay propuestas disponibles para este partido.</strong></div>`;
        candidato2Description.innerHTML = `<div class="proposal-item visible"><strong>No hay propuestas disponibles para este partido.</strong></div>`;
    }
}





// Inicializar con la primera opción
filterProposals();
