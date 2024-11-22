<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elecciones UTA 2024</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
* {
    box-sizing: border-box; /* Asegura que el padding y el borde se incluyan en el tamaño total */
    margin: 0; /* Elimina márgenes por defecto de todos los elementos */
    padding: 0; /* Elimina el padding por defecto de todos los elementos */
}

body {
    margin: 0;
    padding: 0;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    height: calc(100vh - 2px); /* Altura total menos el tamaño del header y del footer */
    width: 100vw;
    gap: 0; /* Quitar espacios entre las imágenes */
    padding: 0; /* Asegúrate de que no haya padding */
}

.candidate {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
    height: 100%; /* Ocupa toda la altura del contenedor */
    width: 100%; /* Ocupa todo el ancho del contenedor */
}

/* Animación al pasar el mouse */
.candidate:hover {
    transform: scale(1.05); /* Efecto de zoom al pasar el mouse */
    box-shadow: none; /* Elimina la sombra */
}

/* Animación al hacer click */
.candidate:active {
    transform: scale(0.95); /* Pequeño zoom inverso al hacer clic */
    box-shadow: none; /* Elimina la sombra al hacer click */
}

.candidate img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Asegura que la imagen cubra todo el contenedor */
    object-position: center;
}

/* Texto flotante que aparece al pasar el mouse */
.candidate .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); /* Fondo semi-transparente */
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    opacity: 0;
    transition: opacity 0.3s ease;
    font-size: 24px;
    cursor: pointer;
}

/* Mostrar el texto al hacer hover */
.candidate:hover .overlay {
    opacity: 1; /* Texto aparece al hacer hover */
}

.overlay a {
    color: white;
    text-decoration: none;
    background-color: #b22222;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    margin-bottom: 10px; /* Espacio entre los botones */
}

.overlay a:hover {
    background-color: #d62828;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background-color: #b22222;
    width: 100%;
    box-sizing: border-box;
    margin: 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

header.hidden {
    transform: translateY(-100%);
}

header .logo {
    display: flex;
    align-items: center;
}

header .logo img {
    width: 35px;
    margin-right: 15px;
}

header .logo h1 {
    color: #ffffff;
    font-size: 1.5em;
}

header nav {
    display: flex;
    align-items: center;
}

header nav a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-size: 1em;
    transition: color 0.3s;
    display: flex;
    align-items: center;
}

header nav a i {
    margin-right: 8px;
}

header nav a:hover {
    color: #2f2929;
}

footer {
    text-align: center;
    padding: 10px;
    background-color: #b22222;
    color: white;
}

.footer-rights {
    background-color: #b22222; 
    text-align: center;
    padding: 0px;
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: 0px; 
}

.suggestions {
    display: none;
    position: fixed;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    padding: 10px 20px;
    border-radius: 5px;
    z-index: 1000;
}

/* Estilos para mostrar sugerencias cuando se hace scroll */
.show {
    display: block;
}

    </style>
    
</head>
<body>
    
    <header id="main-header">
        <div class="logo">
            <img src="Img/logo.png" alt="UTA Logo">
            <h1>Proceso de Elecciones UTA 2024</h1>
        </div>
        <nav>
            <a href="../Home/inicio.php"><i class="fas fa-home"></i> Inicio</a>
            <a href="../Candidatos/Candidatos.php"><i class="fas fa-user"></i> Candidatos</a>
            <a href="../Propuestas/Propuestas.php"><i class="fas fa-bullhorn"></i> Propuestas</a>
            <a href="../Eventos_Noticias/eventos_noticias.php"><i class="fas fa-calendar-alt"></i> Eventos y Noticias</a>
            <a href="../Sugerencias/index.php"><i class="fas fa-comment-dots"></i> Sugerencias</a>
        </nav>
    </header>

    <div class="container">
        <div class="candidate">
            <a href="candidato1.php">
                <img src="Img/BannerSara.jpg" alt="Foto Candidato 1">
            </a>
            <div class="overlay">
                <a href="candidato1.php">Dar sugerencias</a>
            </div>
        </div>
        <div class="candidate">
            <a href="candidato2.php">
                <img src="Img/BannerSaraFinal.jpg" alt="Foto Candidato 2">
            </a>
            <div class="overlay">
                <a href="candidato2.php">Dar sugerencias</a>
            </div>
        </div>
        <div class="candidate">
            <a href="detalle_candidato3.html">
                <img src="Img\VOTARFINALnegro.jpg" alt="Foto Candidato 3">
                
            </a>
            <div class="overlay">
                <p style="margin-top: 100px;"><a href="votos.php" class="btn">Votar</a></p>
                <p style="margin-top: 400px;"><a href="resultados.php" class="btn">Ver Votos</a></p>
            </div>
        </div>
    </div>
    
    <script>
        const suggestions = document.getElementById('suggestions');
        const header = document.getElementById('main-header');
        let lastScrollY = window.scrollY;
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                suggestions.classList.add('show');
            } else {
                suggestions.classList.remove('show');
            }
        
            if (lastScrollY < window.scrollY) {
                header.classList.add('hidden');
            } else {
                header.classList.remove('hidden');
            }
            lastScrollY = window.scrollY;
        });
</script>
</body> 
</html>