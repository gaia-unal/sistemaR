<?php 
	$Usuario = $_GET['Usuario'];
	$Contrasenia = $_GET['Contrasenia'];

	//echo var_dump($Usuario);
	//echo var_dump($Contrasenia);

 ?>
<script type="text/javascript">
	
	document.cualquiernombre.submit();


</script>

 <form class="form-signin" name= "cualquiernombre" action="<?php echo base_url()?>index.php/sesion" method="POST">
                <?php
                   if(isset($_GET['Usuario']) && isset($_GET['Contrasenia'])){
               ?>
                       <div class="login-wrap">
                           <input type="text" class="form-control" placeholder="E-mail" name="username" value="<?php echo ($_GET['Usuario']) ?>" autofocus>
                           <input type="password" class="form-control" name="password" value="<?php echo ($_GET['Contrasenia']) ?>" placeholder="Password">
                       </div>
                       <script type="text/javascript">
                           document.getElementById('reg_dir').submit();
                       </script>
               <?php
               } ?>

 </form>