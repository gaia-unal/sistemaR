
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
    <h4>El usuario, <?php echo $name ?>, ha sigo registrado exitosamente.</h4>
    <br>


<?php if($user){$sess = 1; $usr = $user;}else{ $sess = 0; $usr=0;} ?>
        


    
    </section>
</section>
<!--main content end-->
