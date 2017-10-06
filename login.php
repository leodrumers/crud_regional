<?php include 'ldap.php';
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
                          <button type="submit" class="btn btn-success">Iniciar Sesion</button>
                        </div>
                    </form>
                  </div>
</div>