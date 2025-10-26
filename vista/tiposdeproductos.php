<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Productos</title>
    <link rel="stylesheet" href="../estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container navbar-expand-lg navegador">
        <?php include 'menu.php'; ?>
    </div>
    <div class="container es1">
        <div style="margin: 20px;">
            <h2>Registrar Tipo de Producto</h2>
            <form action="../controladores/tiposController.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="evento" class="form-label">Evento:</label>
                    <input type="text" class="form-control" id="evento" name="evento" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                </div>
                <input type="hidden" name="accion" value="registrar">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
        <h2>Lista de Productos</h2>
        <table class="table bordered table-striped tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Evento</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../modelos/tiposDAO.php';
                $tiposDAO = new tiposdao();
                $tipos = $tiposDAO->listar_tipos();
                foreach ($tipos as $tipoproducto) {
                    echo "<tr>";
                    echo "<td>" . $tipoproducto['id'] . "</td>";
                    echo "<td>" . $tipoproducto['nombre'] . "</td>";
                    echo "<td>" . $tipoproducto['evento'] . "</td>";
                    echo "<td>" . $tipoproducto['descripcion'] . "</td>";
                    echo "<td>
                        <a href='editartiposdeproductos.php?accion=editar&id=" . $tipoproducto['id'] . "' class='btn btn-warning btn-sm'>Editar</a>
                        <form action='../controladores/tiposController.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='accion' value='eliminar'>
                            <input type='hidden' name='id' value='" . $tipoproducto['id'] . "'>
                            <button type='submit' class='btn btn-danger btn-sm' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este tipo de producto?');\">Eliminar</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        if (isset($_GET['mensaje'])) {
            echo "<div class='alert alert-success' role='alert'>" . htmlspecialchars($_GET['mensaje']) . "</div>";
        }
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger' role='alert'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
    ?>
</body>
</html>