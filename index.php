<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Datos de base de datos</h3>
            </div>
            <div class="row">
              <p>
                    <a href="create.php" class="btn btn-success">Crear usuario</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Documento</th>
                      <th>Mobile</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM `datos_pesonales` ORDER by nombre';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                              echo '<td>'. $row['nombre'] . '</td>';
                              echo '<td>'. $row['apellido'] . '</td>';
                              echo '<td>'. $row['documento'] . '</td>';
                              echo '<td>'. $row['telefono'] . '</td>';
                              echo '<td width=250>';
                                  echo '<a class="btn" href="read.php?id='.$row['id'].'">Leer</a>';
                                  echo ' ';
                                  echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Actualizar</a>';
                                  echo ' ';
                                  echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Borrar</a>';
                              echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>