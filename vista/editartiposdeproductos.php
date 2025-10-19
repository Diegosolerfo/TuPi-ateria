<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tiposdeproductos.php">Tipos de productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php
        require_once '../modelos/tiposDAO.php';
        $tiposDAO = new tiposdao();
        $tipo = $tiposDAO->obtener_tipo($_GET['id']);
    ?>
    <div class="container">
        <div style="margin: 20px;">
            <h2>Editar Tipo de Producto</h2>
            <form action="../controladores/tiposController.php" method="POST">
                <div>
                    <input type="hidden" name="id" value="<?php echo $tipo['id']; ?>">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $tipo['nombre']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $tipo['descripcion']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="evento" class="form-label">Evento:</label>
                    <input type="text" class="form-control" id="evento" name="evento" value="<?php echo $tipo['evento']; ?>" required>
                </div>
                    <input type="hidden" name="accion" value="editar">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>