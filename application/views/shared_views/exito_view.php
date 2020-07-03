
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <script type="text/javascript">
    $(document).ready(function() {
$('#pass').hide();
$('#2').hide();
  $('#1').click(function() {
            window.location="<?php echo base_url()?>login";
        });
          });

</script>
<div class="art-postcontent">
    <h1>Registro exitoso !!</h1><br>
    <h4>Bienvenido a FROAC, <?php echo $name ?></h4>
    <br>
    <form autocomplete="off" action="<?php echo base_url() ?>index.php/usuario/check" method="post" name="login" id="form-login" >

        <h5>Desea Iniciar su Sesión</h5>
        <input type="button" value="Iniciar sesión" class="btn btn-info" id="1">
        <input type="hidden" name="username"  alt="username" size="18" value="<?php echo $username ?>" />
        <span id="pass" >Password: <input type="password" name="passwd" id="passwd" alt="username" autocomplete="off" size="18" value="" /></span>
        <input type="submit" value="Iniciar sesión" class="btn btn-info" id="2">
    </form>
    <br></br>
    <a href="<?php echo base_url() ?>"><input type="button" value="No, tal vez mas tarde" class="btn btn-info"></a>

<?php if($user){$sess = 1; $usr = $user;}else{ $sess = 0; $usr=0;} ?>
        