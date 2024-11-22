document.addEventListener("DOMContentLoaded", function () {
    // Escucha el clic en todos los botones de 'Ver más' para abrir los modales
    document.querySelectorAll(".open-modal").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const candidateId = this.getAttribute("data-id"); // Obtener el ID del candidato desde el data-id
            const modalId = this.getAttribute("data-modal"); // Obtener el ID del modal
            const imgSrc = this.getAttribute("data-img"); // Obtener el nombre de la imagen

            // Fetch para obtener los datos del candidato usando el ID
            fetch(`../src/candidatos_queries.php?id=${candidateId}`)
                .then(response => response.json())
                .then(candidate => {
                    if (candidate.error) {
                        console.error(candidate.error);
                        return;
                    }

                    // Actualizar la imagen del modal
                    const imgElement = document.getElementById(`candidate-img-${candidateId}`);
                    imgElement.src = `./Img/${imgSrc}`;

                    // Actualizar la información en el modal
                    document.getElementById(`candidate-name-${candidateId}`).textContent = candidate.name;
                    document.getElementById(`candidate-bio-${candidateId}`).textContent = candidate.bio;
                    document.getElementById(`candidate-experience-${candidateId}`).textContent = candidate.experience;
                    document.getElementById(`candidate-vision-${candidateId}`).textContent = candidate.vision;
                    document.getElementById(`candidate-achievements-${candidateId}`).textContent = candidate.achievements;

                    // Mostrar el modal
                    document.getElementById(modalId).style.display = "flex";
                })
                .catch(error => console.error("Error al cargar los datos del candidato:", error));
        });
    });

    // Cerrar el modal al hacer clic en el botón de cierre
    document.querySelectorAll(".close-modal").forEach(closeButton => {
        closeButton.addEventListener("click", function () {
            this.closest(".modal").style.display = "none";
        });
    });

    // Cerrar el modal al hacer clic fuera del contenido del modal
    document.querySelectorAll(".modal").forEach(modal => {
        modal.addEventListener("click", function (event) {
            if (event.target === modal) {  // Verifica si el clic fue en el fondo (fuera del contenido)
                modal.style.display = "none";
            }
        });
    });
});
