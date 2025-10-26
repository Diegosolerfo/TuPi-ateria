<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\modelos\TiposDAO;
use App\modelos\ProductosDAO;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container navbar-expand-lg  navegador">
        <?php require_once 'menu.php'; ?>
    </div>
    <div class="container es1">
        <div style="margin: 20px;">
            <h2>Registrar Producto</h2>
            <form action="../controladores/productosController.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                </div>
                <div class="mb-3">
                    <label for="especificaciones" class="form-label">Especificaciones:</label>
                    <input type="text" class="form-control" id="especificaciones" name="especificaciones" required>
                </div>
                <?php
                    $objeto = new TiposDAO();
                    $respuesta = $objeto->listarTipos();
                ?>
                <div class="mb-3">
                    <label for="tipo_producto" class="form-label">Tipo de Producto:</label>
                    <select name="Tipo_Producto" id="Tipo_Producto" class="form-select">
                        <?php
                            foreach($respuesta as $tipo){
                                echo '<option value="'.$tipo["id"].'">'.$tipo["nombre"].'</option>';
                            }
                        ?>
                    </select>
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
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Especificaciones</th>
                    <th>Tipo de Producto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $productosDAO = new ProductosDAO();
                $productos = $productosDAO->listarProductos();
                foreach ($productos as $producto) {
                    echo "<tr>";
                    echo "<td>" . $producto['id'] . "</td>";
                    echo "<td>" . $producto['nombre'] . "</td>";
                    echo "<td>" . $producto['descripcion'] . "</td>";
                    echo "<td>" . $producto['precio'] . "</td>";
                    echo "<td>" . $producto['especificaciones'] . "</td>";
                    echo "<td>" . $producto['tipo_producto'] . "</td>";
                    echo "<td>
                        <a href='editarproductos.php?accion=editar&id=" . $producto['id'] . "' class='btn btn-warning btn-sm'>Editar</a>
                        <form action='../controladores/productosController.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='accion' value='eliminar'>
                            <input type='hidden' name='id' value='" . $producto['id'] . "'>
                            <button type='submit' class='btn btn-danger btn-sm' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este producto?');\">Eliminar</button>
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
