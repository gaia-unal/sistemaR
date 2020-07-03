
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
    <h4>El usuario <?php echo $user ?>, aún no evalua 10 recursos educativos, hasta no realizar este proceso no podra recibir recomendaciones del sistema.</h4>
    <br>
    <form autocomplete="off" action="<?php echo base_url() ?>index.php/lo/calificarOA" method="post" name="login" id="form-login" >

        <input id="submit" type="submit" class="btn btn-info" value="Calificar OA">

    </form>
    <br>

<?php if($user){$sess = 1; $usr = $user;}else{ $sess = 0; $usr=0;} ?>
