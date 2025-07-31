<?php
require_once("config.php");

try {
  // $connection = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
  $stmt = $pdo->query("SELECT * FROM titulos");
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
  <link rel="stylesheet" href="../css/Libros.css">
  <title>Biblioteca Digital</title>
  
</head>
<body>
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
        <a class="nav-link" href="./Autores.php">
          <i class="fas fa-user-edit me-2"></i>Autores
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./Libros.php">
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
      <i class="fas fa-book-open me-3"></i>
      Biblioteca Digital
    </h1>
    <p class="hero-subtitle">
      Descubre un mundo de conocimiento y aventuras
    </p>
    <div class="stats-section">
      <div class="stat-item">
        <span class="stat-number"><?= count($data) ?></span>
        <span class="stat-label">Libros Disponibles</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">∞</span>
        <span class="stat-label">Aventuras</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">24/7</span>
        <span class="stat-label">Acceso</span>
      </div>
    </div>
    
    <form method="post" class="d-inline">
      <button type="submit" name="ver" class="btn btn-explore">
        <i class="fas fa-search me-2"></i>
        Explorar Colección
      </button>
    </form>
  </div>

  <?php if(isset($_POST["ver"])): ?>
  <!-- Books Container -->
  <div class="books-container">
    <div class="books-header">
      <h2 class="books-title">
        <i class="fas fa-books me-3"></i>
        Nuestra Colección
      </h2>
      <p class="books-subtitle">
        Explora nuestra biblioteca con <?= count($data) ?> títulos únicos
      </p>
    </div>

    <?php if(count($data) > 0): ?>
    <div class="book-grid">
      <?php foreach ($data as $index => $titulo): ?>
      <div class="book-card">
        <div class="book-icon">
          <i class="fas fa-book"></i>
        </div>
        <h3 class="book-title">
          <?= htmlspecialchars($titulo["titulo"]) ?>
        </h3>
        <div class="book-meta">
          <i class="fas fa-hashtag me-1"></i>
          Libro #<?= $index + 1 ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state">
      <div class="empty-icon">
        <i class="fas fa-book-open"></i>
      </div>
      <h3>No hay libros disponibles</h3>
      <p>La biblioteca está esperando nuevos títulos emocionantes.</p>
    </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  
  <script src="../js/animaciones.js"></script>
</body>
</html>