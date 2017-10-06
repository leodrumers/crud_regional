<?php 
include 'ldap.php';
session_start();
    if( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $passwordError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $password = $_POST['password'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Ingrese un name por favor';
            $valid = false;
        }
         
        if (empty($password)) {
            $passwordError = 'Ingrese password por favor';
            $valid = false;
        } 
    }

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 <body>
<?php
    if(!isset($_SESSION['name']))
    {
      if(isset($_POST['login']))
        {
        if(login($name,$password)==1){
          echo "entro";
          $_SESSION['name'] = $name;
          $_SESSION['password'] = $password;
          header("location:index.php");
        }
        else{
          echo '<h4>Usuario y contraseña incorrectos</h4>';
        }
      }
?> 
          <div class="container">     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Inicio de Sesion</h3>
                    </div>
             
                    <form class="form-horizontal" action="index.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Nombre" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                       <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">password</label>
                        <div class="controls">
                            <input name="password" type="text"  placeholder="Nombre" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                       <div class="form-actions">
                          <input type="submit" class="btn btn-success" value="Iniciar Sesión" name="login">
                        </div>
                    </form>
                  </div>
          </div>
  <?php }
  else{
  ?>
    <div class="container">
            <div class="row">
                <h3>Bienvenido <?php echo $_SESSION['name']; ?></h3>
            </div>
            <div class="row">
              <p>
                <?php if(verify($_SESSION['name'],$_SESSION['password'])==3 || verify($_SESSION['name'],$_SESSION['password'])==2 ){ ?>
                    <a href="create.php" class="btn btn-success">Crear usuario</a>
                <?php } ?>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </p>
                <?php  
                  if(!verify($_SESSION['name'],$_SESSION['password'])==0){
                ?>
                
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
                   $sql = 'SELECT * FROM `datos_personales` ORDER by nombre';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                              echo '<td>'. $row['nombre'] . '</td>';
                              echo '<td>'. $row['apellido'] . '</td>';
                              echo '<td>'. $row['documento'] . '</td>';
                              echo '<td>'. $row['telefono'] . '</td>';
                              echo '<td width=250>';
                                  echo '<a class="btn" href="read.php?id='.$row['id'].'">Leer</a>';
                                  echo ' ';
                                  if(verify($_SESSION['name'],$_SESSION['password'])==3){
                                    echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Actualizar</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Borrar</a>';
                                  }
                              echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                 }else{
                  echo "<h3>No tiene permisos para acceder a la base de datos</h3>";
                 }
                  ?>
                  </tbody>
            </table>

      </div>
    </div> <!-- /container -->
  <?php  } ?>

  </body>
</html>