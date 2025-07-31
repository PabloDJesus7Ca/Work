<?php
require_once("config.php");
require_once("Mesajes.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/Formulario.css">
    <title>Contacto - Biblioteca Digital</title>
</head>

<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <i class="fas fa-envelope floating-element" style="top: 15%; left: 10%; font-size: 3rem;"></i>
        <i class="fas fa-paper-plane floating-element" style="top: 25%; right: 15%; font-size: 2rem;"></i>
        <i class="fas fa-comment-dots floating-element" style="bottom: 30%; left: 20%; font-size: 2.5rem;"></i>
        <i class="fas fa-at floating-element" style="bottom: 20%; right: 10%; font-size: 2rem;"></i>
        <i class="fas fa-heart floating-element" style="top: 60%; left: 5%; font-size: 1.5rem;"></i>
        <i class="fas fa-star floating-element" style="top: 40%; right: 8%; font-size: 1.8rem;"></i>
    </div>

    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="nav justify-content-center w-100">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-envelope me-2"></i>Comienzo
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./Form.php">
                    <i class="fas fa-envelope me-2"></i>Contacto
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Autores.php">
                    <i class="fas fa-user-edit me-2"></i>Autores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Libros.php">
                    <i class="fas fa-book me-2"></i>Ver Libros
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">
                    <i class="fas fa-exclamation-triangle me-2"></i>Libros Agotados
                </a>
            </li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="form-container">
            <h2 class="form-title">
                <i class="fas fa-comments"></i>
                Contáctanos
            </h2>

            <?php
            if (isset($_POST["Enviado"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
                $correo = trim($_POST["correo"]);
                $nombre = trim($_POST["nombre"]);
                $asunto = trim($_POST["asunto"]);
                $comentario = trim($_POST["comentario"]);

                if (empty($correo) || empty($nombre) || empty($asunto) || empty($comentario)) {
                    echo $Error;
                } else {
                    try {
                        $connections = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                        $statement = $connections->prepare("INSERT INTO contacto(correo,nombre,asunto,comentario) VALUES (:correo, :nombre, :asunto, :comentario)");
                        $statement->execute([
                            "correo" => $correo,
                            "nombre" => $nombre,
                            "asunto" => $asunto,
                            "comentario" => $comentario
                        ]);
                        echo $Exito;
                        $_POST = array();
                    } catch (PDOException $pe) {
                        echo $Errodb . " " . $pe->getMessage();
                    }
                }
            }
            ?>

            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="nombre" class="form-label">
                        <i class="fas fa-user"></i>
                        Nombre Completo
                    </label>
                    <input type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control"
                        placeholder="¿Cómo te llamas?"
                       
                        value="<?php echo isset($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : ""; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="correo" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Correo Electrónico
                    </label>
                    <input type="email"
                        id="correo"
                        name="correo"
                        class="form-control"
                        placeholder="tu.email@ejemplo.com"
                      
                        value="<?php echo isset($_POST["correo"]) ? htmlspecialchars($_POST["correo"]) : ""; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="asunto" class="form-label">
                        <i class="fas fa-tag"></i>
                        Asunto
                    </label>
                    <input type="text"
                        id="asunto"
                        name="asunto"
                        class="form-control"
                        placeholder="¿De qué quieres hablarnos?"
                        
                        value="<?php echo isset($_POST["asunto"]) ? htmlspecialchars($_POST["asunto"]) : ""; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="comentario" class="form-label">
                        <i class="fas fa-comment-alt"></i>
                        Tu Mensaje
                    </label>
                    <textarea id="comentario"
                        name="comentario"
                        class="form-control"
                        rows="4"
                        placeholder="Cuéntanos lo que tienes en mente..."
                        ><?php echo isset($_POST["comentario"]) ? htmlspecialchars($_POST["comentario"]) : ""; ?></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" name="Enviado" class="btn btn-enviar">
                        <i class="fas fa-paper-plane"></i>
                        Enviar Mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../js/animaciones.js"></script>
</body>

</html>