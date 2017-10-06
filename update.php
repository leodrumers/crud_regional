<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nombreError = null;
        $apellidoError = null;
        $documentoError = null;
        $telefonoError = null;
         
        // keep track post values
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $documento = $_POST['documento'];
        $telefono = $_POST['telefono'];
         
        // validate input
        $valid = true;
        if (empty($nombre)) {
            $nombreError = 'Ingrese un nombre por favor';
            $valid = false;
        }
         
        if (empty($apellido)) {
            $apellidoError = 'Ingrese apellido por favor';
            $valid = false;
        } 

        if (empty($documento)) {
            $documentoError = 'Ingrese documento por favor';
            $valid = false;
        } 

        if (empty($telefono)) {
            $telefonoError = 'Ingrese un telefono por favor';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `datos_pesonales`  set nombre = ?, apellido = ?, documento =?, telefono = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$apellido,$documento,$telefono,$id));
            Database::disconnect();
            header("Location: index.php");
        }
        }else {
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT * FROM `datos_personales` where id = ?";
          $q = $pdo->prepare($sql);
          $q->execute(array($id));
          $data = $q->fetch(PDO::FETCH_ASSOC);
          $nombre = $data['nombre'];
          $apellido = $data['apellido'];
          $documento = $data['documento'];
          $telefono = $data['telefono'];
          Database::disconnect();
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Actualizar datos de <span style="color: red"><?php echo !empty($nombre)?$nombre:'';?></span></h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($apellidoError)?'error':'';?>">
                        <label class="control-label">Apellido</label>
                        <div class="controls">
                            <input name="apellido" type="text" placeholder="Apellido" value="<?php echo !empty($apellido)?$apellido:'';?>">
                            <?php if (!empty($apellidoError)): ?>
                                <span class="help-inline"><?php echo $apellidoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($documentoError)?'error':'';?>">
                        <label class="control-label">Documento</label>
                        <div class="controls">
                            <input name="documento" type="text" placeholder="Documento" value="<?php echo !empty($documento)?$documento:'';?>">
                            <?php if (!empty($documentoError)): ?>
                                <span class="help-inline"><?php echo $documentoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
                        <label class="control-label">Telefono</label>
                        <div class="controls">
                            <input name="telefono" type="tel"  placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
                            <?php if (!empty($telefonoError)): ?>
                                <span class="help-inline"><?php echo $telefonoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Actualizar</button>
                          <a class="btn" href="index.php">Regresar</a>
                      </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>