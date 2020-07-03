<script type="text/javascript">

    $(document).ready(function() {

        $("#img_ok").hide();
        $("#img_not").hide();
        $("#submitg, #boton, #cancelar, #proc").button();

        $("#fecha_nac").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            changeDay: true,
            yearRange: "1945:2035"

        });

        $(".submitg").click(function() {
            $("#form").validate({
                rules: {
                    nombre: {
                        required: true,
                        minlength: 3
                    },
                    apellido: {
                        required: true,
                        minlength: 3
                    },
                    fecha_nac: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    sexo: {
                        required: true
                    },
                    lang: {
                        required: true
                    },
                    username: {
                        required: true,
                        minlength: 4
                    },
                    passwd: {
                        required: true,
                        minlength: 6
                    },
                    passwd1: {
                        equalTo: "#passwd"
                    }
                },
                messages: {
                    nombre: {
                        required: "<span style=color:red;>Escribe tu Nombre </span>",
                        minlength: "Tu Nombre con minimo 3 letras."
                    },
                    apellido: {
                        required: "<span style=color:red;>Escribe tu Apellido</span>",
                        minlength: "Tu Nombre con minimo 3 letras"
                    },
                    fecha_nac: {
                        required: "<span style=color:red;>Escribe tu Fecha de Nacimiento </span>"
                    },
                    sexo: {
                        required: "<span style=color:red;>Elige tu Sexo </span>"
                    },
                    lang: {
                        required: "<span style=color:red;>Escribe tu Idioma</span>",
                        minlength: "Mail erróneo",
                        error: "Mail erróneo",
                    },
                    username: {
                        required: "<span style=color:red;>Escribe tu Nombre de usuario</span>",
                        minlength: "Tu nombre de ususario con minimo 4 letras"
                    },
                    passwd: {
                        required: "<span style=color:red;>Escribe tu password</span>",
                        minlength: "Tu password con minimo 6 caracteres "
                    },
                    passwd1: {
                        equalTo: "<span style=color:red;>Las contraseñas no coinciden</span>"
                    }
                }
            });


        });

        $('#proc').click(function() {

            var form_data = $('#form_usr').serializeArray();
            $.post("<?php echo base_url() ?>index.php/usuario/test_result", form_data, function(respuesta) {
                // $("#result").text(respuesta);
                //alert("Resultado"+respuesta);
                $('#result_test').val(respuesta);
                $('#form').show();
                $('#test').hide();
                $('#submitg').show();


                switch ($('#result_test').val()) {
                    case '1':
                        $("#result").text('Su estilo de aprendizaje es: Auditivo-Global ');
                        break;
                    case '2':
                        $("#result").text('Su estilo de aprendizaje es: Auditivo-Secuencial ');
                        break;
                    case '3':
                        $("#result").text('Su estilo de aprendizaje es: Kinestesico-Global ');
                        break;
                    case '4':
                        $("#result").text('Su estilo de aprendizaje es: Kinestesico-Secuencial ');
                        break;
                    case '5':
                        $("#result").text('Su estilo de aprendizaje es: Lector-Global ');
                        break;
                    case '6':
                        $("#result").text('Su estilo de aprendizaje es: Lector-Secuencial ');
                        break;
                    case '7':
                        $("#result").text('Su estilo de aprendizaje es: Visual-Global ');
                        break
                    case '8':
                        $("#result").text('Su estilo de aprendizaje es: Visual-Secuencial ');
                        break
                    case '8':
                        $("#result").text('Su estilo de aprendizaje es: Visual-Secuencial ');
                        break

                }

            });
        });

        $('#boton').click(function() {
            $('#test').show();
            $('#form').hide();
            $('#submitg').hide();
        });

        $('#cancelar').click(function() {
            $('#test').hide();
            $('#form').show();
            $('#submitg').show();
        });

        $('#username').blur(function() {
            $.get("<?php echo base_url() ?>index.php/usuario/checkusr/"+$("#username").val(), function(respuesta) {
                $('#rta').val(respuesta);

                if (respuesta == 1){
                    $('#img_not').show();
                    $('#img_ok').hide();
                } else {
                    $('#img_ok').show();
                    $('#img_not').hide();
                }

            });

        });

    });

</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/datepicker/css/datepicker.css">
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Registro de Usuarios
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <form method="POST" role="form" action="<?php echo base_url();?>index.php/usuario/save_user/" enctype='multipart/form-data' id="form">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Información personal
                                        </header>
                                        <div class="panel-body">
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
                                                <input  type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido">Apellido:</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="mail">E-mail:</label>
                                                <input type="text" class="form-control" id="mail" name="mail" placeholder="Correo electronico" required>
                                            </div>
                                            <div id="in_use1" class="alert alert-block alert-danger fade in">
                                                <button data-dismiss="alert" class="close close-sm" type="button">
                                                    <i class="icon-remove"></i>
                                                </button>
                                                <strong>Lo sentimos!</strong> El correo electrónico ingresado, ya está registrado.
                                            </div>
                                            <div id="no_use1" class="alert alert-success fade in">
                                                <button data-dismiss="alert" class="close close-sm" type="button">
                                                    <i class="icon-remove"></i>
                                                </button>
                                                <strong>Éxito!</strong> este correo electronico esta disponible.
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Nombre de usuario:</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario unico en FROAC" required>
                                            </div>
                                            <div id="in_use" class="alert alert-block alert-danger fade in">
                                                <button data-dismiss="alert" class="close close-sm" type="button">
                                                    <i class="icon-remove"></i>
                                                </button>
                                                <strong>Lo sentimos!</strong> el nombre de usuario <strong id="in_name"></strong> no esta disponible.
                                            </div>
                                            <div id="no_use" class="alert alert-success fade in">
                                                <button data-dismiss="alert" class="close close-sm" type="button">
                                                    <i class="icon-remove"></i>
                                                </button>
                                                <strong>Éxito!</strong> este nombre de usuario esta disponible.
                                            </div>
                                            <div class="form-group">
                                                <label for="passwd">Password:</label>
                                                <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Contraseña" required><br>
                                                <input type="password" class="form-control" id="passwd2" name="passwd2" placeholder="Reescribe la contraseña" required>
                                            </div>
                                            <div id="no_match" class="alert alert-block alert-danger fade in">
                                                <button data-dismiss="alert" class="close close-sm" type="button">
                                                    <i class="icon-remove"></i>
                                                </button>
                                                <strong>Las contraseñas no concuerdan.</strong>
                                            </div>
                                            <div class="form-group">




                                                <input type="hidden" name="result_test" id="result_test" value="0">
                                                <h3 class="art-postheader" id="result"></h3>
                                                <input id="submitg" type="submit" class="btn btn-info" value="Guardar Información">
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


    $("#in_use1, #no_use1").hide();

    $("#mail").change(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php/usuario/verify_email",
            data: { mail: $("#mail").val()}
        })
            .done(function( msg ) {
                if(msg >= 1 ){

                    $("#in_name").text($("#mail").val());
                    $("#in_use1").show();
                    $("#no_use1").hide();
                    $("#sub").hide();
                    $("#mail").val("");
                }else{
                    $("#no_use1").show();
                    $("#in_use1").hide();
                    $("#sub").show();
                }
            });
    });
    $("#passwd").change(function(){
        if ($("#passwd").val().length < 6){
            alert("Su contraseña debe ser de minimo 6 caracteres!")
            $("#passwd").val("");
        }
    });
    $("#passwd2").change(function(){
        if($("#passwd").val() == $("#passwd2").val()){
            $("#no_match").hide();
        }
        if($("#passwd").val() != $("#passwd2").val()){
            $("#no_match").show();
            $("#passwd2").val("")
        }
    });




</script>
