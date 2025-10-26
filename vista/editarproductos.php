<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\modelos\ProductosDAO;
use App\modelos\TiposDAO;

$productosDAO = new ProductosDAO();
$tiposDAO = new TiposDAO();
$producto = $productosDAO->obtener_producto($_GET['id']);
$tipos = $tiposDAO->listar_tipos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container navbar-expand-lg navegador">
        <?php include 'menu.php'; ?>
    </div>
    <?php
        require_once '../modelos/productosDAO.php';
        $productosDAO = new productosdao();
        $producto = $productosDAO->obtener_producto($_GET['id']);
    ?>
    <div class="container">
        <div style="margin: 20px;">
            <h2>Editar Producto</h2>
            <form action="../controladores/productosController.php" method="POST">
                <div>
                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="especificaciones" class="form-label">Especificaciones:</label>
                    <input type="text" class="form-control" id="especificaciones" name="especificaciones" value="<?php echo $producto['especificaciones']; ?>" required>
                </div>
                <?php
                    include_once '../modelos/tiposDAO.php';
                    $objeto = new tiposdao;
                    $respuesta = $objeto->listar_tipos();
                ?>
                <div class="mb-3">
                    <label for="tipo_producto" class="form-label">Tipo de Producto:</label>
                    <select name="Tipo_Producto" id="Tipo_Producto" class="form-select">
                        <?php
                            foreach($respuesta as $tipo){
                                $selected = ($producto['tipo_producto'] == $tipo['id']) ? 'selected' : '';
                                echo '<option value="'.$tipo["id"].'" '.$selected.'>'.$tipo["nombre"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                    <input type="hidden" name="accion" value="editar">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>