<?php
require_once("config.php");

try {
  // $connection = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
  $stmt = $pdo->query("SELECT * FROM autores");
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pe) {
  die("Error: " . $pe->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/Autores.css">
  <title>Nuestros Autores</title>
  
</head>
<body>
  <!-- Floating Background Elements -->
  <div class="floating-elements">
    <i class="fas fa-feather-alt floating-element" style="top: 10%; left: 10%; font-size: 3rem;"></i>
    <i class="fas fa-pen-fancy floating-element" style="top: 20%; right: 15%; font-size: 2rem;"></i>
    <i class="fas fa-scroll floating-element" style="bottom: 30%; left: 20%; font-size: 2.5rem;"></i>
    <i class="fas fa-quill-pen floating-element" style="bottom: 20%; right: 10%; font-size: 2rem;"></i>
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
        <a class="nav-link" href="./Form.php">
          <i class="fas fa-envelope me-2"></i>Contacto
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./Autores.php">
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

  <!-- Hero Section -->
  <div class="hero-section">
    <h1 class="hero-title">
      <i class="fas fa-users me-3"></i>
      Nuestros Autores
    </h1>
    <p class="hero-subtitle">
      Conoce a los talentosos escritores que dan vida a nuestras historias más fascinantes
    </p>
    <div class="stats-section">
      <div class="stat-item">
        <span class="stat-number"><?= count($data) ?></span>
        <span class="stat-label">Autores Registrados</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">∞</span>
        <span class="stat-label">Historias</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">📖</span>
        <span class="stat-label">Inspiración</span>
      </div>
    </div>
    
    <form method="post" class="d-inline">
      <button type="submit" name="ver" class="btn btn-discover">
        <i class="fas fa-search me-2"></i>
        Descubrir Autores
      </button>
    </form>
  </div>

  <?php if(isset($_POST["ver"])): ?>
  <!-- Authors Container -->
  <div class="authors-container">
    <div class="authors-header">
      <h2 class="authors-title">
        <i class="fas fa-pen-nib me-3"></i>
        Galería de Escritores
      </h2>
      <p class="authors-subtitle">
        Explora los perfiles de nuestros <?= count($data) ?> autores destacados
      </p>
    </div>

    <?php if(count($data) > 0): ?>
    <div class="authors-grid">
      <?php foreach ($data as $index => $autor): ?>
      <div class="author-card">
        <!-- Author Header -->
        <div class="author-header">
          <div class="author-avatar">
            <i class="fas fa-user-tie"></i>
          </div>
          <div class="author-name">
            <h3 class="author-full-name">
              <?= htmlspecialchars($autor["nombre"]) ?> <?= htmlspecialchars($autor["apellido"]) ?>
            </h3>
            <p class="author-title">Escritor Profesional</p>
          </div>
        </div>

        <!-- Author Info -->
        <div class="author-info">
          <div class="info-row">
            <div class="info-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="info-content">
              <p class="info-label">Dirección</p>
              <p class="info-value"><?= htmlspecialchars($autor["direccion"]) ?></p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon">
              <i class="fas fa-city"></i>
            </div>
            <div class="info-content">
              <p class="info-label">Ciudad</p>
              <p class="info-value"><?= htmlspecialchars($autor["ciudad"]) ?></p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon">
              <i class="fas fa-flag"></i>
            </div>
            <div class="info-content">
              <p class="info-label">Estado</p>
              <p class="info-value"><?= htmlspecialchars($autor["estado"]) ?></p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon">
              <i class="fas fa-globe"></i>
            </div>
            <div class="info-content">
              <p class="info-label">País</p>
              <p class="info-value"><?= htmlspecialchars($autor["pais"]) ?></p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon">
              <i class="fas fa-mail-bulk"></i>
            </div>
            <div class="info-content">
              <p class="info-label">Código Postal</p>
              <p class="info-value"><?= htmlspecialchars($autor["cod_postal"]) ?></p>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state">
      <div class="empty-icon">
        <i class="fas fa-user-slash"></i>
      </div>
      <h3>No hay autores registrados</h3>
      <p>Próximamente estaremos agregando más escritores talentosos a nuestra plataforma.</p>
    </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  
 <script src="../js/animaciones.js"></script>
  </script>
</body>
</html>