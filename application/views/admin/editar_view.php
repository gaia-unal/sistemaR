<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/datepicker/css/datepicker.css">
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Editar mis datos
                        <a  class="btn btn-success " href="<?php echo base_url()?>admin/lista_user">
                            <li class="icon-reply"> Volver</li>
                        </a>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <form method="POST" role="form" action="<?php echo base_url();?>index.php/admin/update_user" enctype='multipart/form-data'>
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Información personal
                                        </header>
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">Seleccione el Rol:</label>
                                            <select class="form-control input-sm m-bot15" name="rol" required>
                                                <?php

                                                foreach ($rol as $key) { ?>

                                                    <option name="level[]" value= "<?php echo $key->use_rol_id ?>"><?php echo $key->use_rol_nombre ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input value="<?php echo $usr_all_data[0]["use_nombre"]?>"  type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                                                <input type="hidden" name="username" value="<?php echo $usr_all_data[0]["use_username"]?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido">Apellido:</label>
                                                <input value="<?php echo $usr_all_data[0]["use_apellido"]?>" type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="mail">E-mail:</label>
                                                <input value="<?php echo $usr_all_data[0]["use_email"]?>" type="text" class="form-control" id="mail" name="mail" placeholder="Correo electronico" required>
                                            </div>

                                            <button id="sub" type="submit" class="btn btn-warning">Actualizar mis datos</button>
                                        </div>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>

        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

<!-- Modal chpassword -->
<div class="modal fade" id="dialog_chpasswd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar Contraseña</h4>
            </div>
            <div class="modal-body" id="dialog_chpassword_view">

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" id="cancelar"  class="btn btn-warning" type="button">Cancelar</button>
                <button data-dismiss="modal" id="aceptar"  class="btn btn-success" type="button">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<!--script for this page-->
<script type="text/javascript" src="<?php echo base_url();?>asset/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $("#in_use, #no_use, #no_match").hide();

    $('#fecha_nac').datepicker();
    $("#username").change(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php/usuario/verify_username",
            data: { username: $("#username").val()}
        })
            .done(function( msg ) {
                if(msg >= 1 ){

                    $("#in_name").text($("#username").val());
                    $("#in_use").show();
                    $("#no_use").hide();
                    $("#sub").hide();
                    $("#username").val("");
                }else{
                    $("#no_use").show();
                    $("#in_use").hide();
                    $("#sub").show();
                }
            });
    });

    function chpasswd(){
        $("#dialog_chpassword_view").load("<?php echo base_url(); ?>index.php/usuario/chpasswd");
    }

    $("#aceptar").click(function(){
            window.location="<?php echo base_url()?>";
    })



 </script>