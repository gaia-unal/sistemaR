<?php if($user){$sess = 1; $usr = $user;}else{ $sess = 0; $usr=0;} ?>

<script type="text/javascript" language="javascript">
    function verificampos() {
        if ($('#tiporepositorio').val() == 'ROAp') {

            if (document.getElementById("nombrerepositorio").value == "") {
                alert("Por favor ingrese el nombre del repositorio");
                document.getElementById("nombrerepositorio").focus();
                return false;
            }
            if (document.getElementById("entidad").value == "") {
                alert("Por favor ingrese el nombre de la institucion");
                document.getElementById("entidad").focus();
                return false;
            }
            if (document.getElementById("email").value == "") {
                alert("Por favor ingrese el email");
                document.getElementById("email").focus();
                return false;
            }
            if (document.getElementById("basededatos").value == "") {
                alert("Por favor ingrese el nombre de la base de datos");
                document.getElementById("basededatos").focus();
                return false;
            }
            if (document.getElementById("usuario").value == "") {
                alert("Por favor ingrese el nombre de usuario");
                document.getElementById("usuario").focus();
                return false;
            }
            if (document.getElementById("contrasena").value == "") {
                alert("Por favor ingrese la contraseña");
                document.getElementById("contrasena").focus();
                return false;
            }
            if (document.getElementById("puerto").value == "") {
                alert("Por favor ingrese el puerto");
                document.getElementById("puerto").focus();
                return false;
            }
            if (document.getElementById("host").value == "") {
                alert("Por favor ingrese el host");
                document.getElementById("host").focus();
                return false;
            }
            if (document.getElementById("url").value == "") {
                alert("Por favor ingrese la URL");
                document.getElementById("url").focus();
                return false;
            }
        }

        if ($('#tiporepositorio').val() == 'OAI') {
            if (document.getElementById("nombrerepositorio").value == "") {
                alert("Por favor ingrese el nombre del repositorio");
                document.getElementById("nombrerepositorio").focus();
                return false;
            }
            if (document.getElementById("entidad").value == "") {
                alert("Por favor ingrese el nombre de la institucion");
                document.getElementById("entidad").focus();
                return false;
            }
            if (document.getElementById("email").value == "") {
                alert("Por favor ingrese el email");
                document.getElementById("email").focus();
                return false;
            }
            if (document.getElementById("url").value == "") {
                alert("Por favor ingrese la URL");
                document.getElementById("url").focus();
                return false;
            }
            if (document.getElementById("host").value == "") {
                alert("Por favor ingrese el Enlace OAI");
                document.getElementById("host").focus();
                return false;
            }

            if (document.getElementById("metadata").value == "") {
                alert("Por favor ingrese estandar metadatos");
                document.getElementById("metadata").focus();
                return false;
            }
            if (document.getElementById("periodicidad").value == "") {
                alert("Por favor ingrese una periodicidad");
                document.getElementById("periodicidad").focus();
                return false;
            }

            if (document.getElementById("codigov").value == "") {
                alert("Por favor favor ingrese el codigo de verificacion");
                document.getElementById("codigov").focus();
                return false;
            }

        }

    }

    $(function() {
        $("#periodicidad").keydown(function(event) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                return false;
            }
        });
    });

</script>

<script>
    $(function() {
        if ($('#tiporepositorio').val() == 'ROAp') {
                $('#formulario').show();
                $('#lhost').text("Host");
                $('#lmetadata').hide();
                $('#metadata').hide();
                $('#lpuerto').show();
                $('#puerto').show();
                $('#lbasededatos').show();
                $('#basededatos').show();
                $('#lusuario').show();
                $('#usuario').show();
                $('#lcontrasena').show();
                $('#contrasena').show();
                $('#lperiodicidad').hide();
                $('#periodicidad').hide();
            }
            ;

            if ($('#tiporepositorio').val() == 'OAI') {
                $('#formulario').show();
                $('#lhost').text("Enlace OAI");
                $('#lmetadata').show();
                $('#metadata').show();
                $('#lperiodicidad').show();
                $('#periodicidad').show();
                $('#lpuerto').hide();
                $('#puerto').hide();
                $('#lbasededatos').hide();
                $('#basededatos').hide();
                $('#lusuario').hide();
                $('#usuario').hide();
                $('#lcontrasena').hide();
                $('#contrasena').hide();
            }
            ;
    });
</script>





<section id="main-content">
    <section class="wrapper">
        <br>
        <section class="panel">
            <header class="panel-heading">

             <form autocomplete="off" action="<?php echo base_url() ?>index.php/repositorio/actualizar_repo/" method="post" onsubmit="return verificampos();" enctype="multipart/form-data">
            <header><h3>Modificar Repositorio</h3></header>
            <div class="module_content">                
                <div class="col-lg-12">
                <div class="row">
                <br>
                <br>
                <?php foreach ($repomod as $key) { ?>
                <div class="col-lg-8" id="formulario" style="display: none;">
                        <label>Nombre</label><br>
                        <input type="text" class="form-control" name="nombrerepositorio" id="nombrerepositorio" value="<?php echo $key['rep_name']; ?>" /><br>
                        <label>Entidad</label><br>
                        <input type="text" class="form-control" name="entidad" id="entidad" value="<?php echo $key['rep_affiliation'] ?>" /><br>
                        <label>Correo Electrónico</label><br>
                        <input type="email" class="form-control" value="<?php echo $key['rep_email'] ?>" name="email" id="email"/><br>
                        <label id="ltiporepositorio">Tipo Repositorio</label>
                        <input type="text" class="form-control" value="<?php echo $key['rep_typerepository']?>" name="tiporepositorio" id="tiporepositorio" readonly>

                    <label>URL</label>
                        <input type="text" class="form-control" name="url" value="<?php echo $key['rep_url'] ?>" id="url" /><br>
                        <label id="lhost">Host</label>
                        <input type="text" class="form-control" value="<?php echo $key['rep_host'] ?>" name="host" id="host" /><br>
                        <label id="lmetadata">Estandar de Metadatos</label>
                        <input type="text" class="form-control" name="metadata" id="metadata" value="<?php echo $key['rep_metadata_inf'] ?>" />
                        <label id="lpuerto">Puerto</label>
                        <input type="text" class="form-control" name="puerto" id="puerto" value="<?php echo $key['rep_port'] ?>" /><br>
                        <label id="lbasededatos">Base De Datos</label>
                        <input type="text" class="form-control" name="basededatos" id="basededatos" value="<?php echo $key['rep_databasename'] ?>" />
                        <label id="lusuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $key['rep_loggin'] ?>" />
                        <label id="lcontrasena">Contraseña</label>
                        <input type="text" class="form-control" autocomplete="off" name="contrasena" id="contrasena" value="<?php echo $key['rep_password'] ?>" />
                        <label id="lperiodicidad">Perio. Actualizaciones (días)</label>
                        <input type="number" class="form-control" id="periodicidad" name="periodicidad" value="<?php echo $key['rep_frequency'] ?>" />
                        <label>Usuario repositorio</label>
                        <?php 
                            //echo $key['use_username'];
                         ?>   
                        <select id="usuariorepo" class="form-control" name="usuariorepo">

                            <?php 
                            foreach ($usuario as $user) 
                            {
                                if($user['use_username']==$key['use_username'])
                                {?>
                                    <option selected value="<?php echo $user['use_username']; ?>"><?php echo $user['use_nombre'] . " " . $user['use_apellido']; ?></option>
                        <?php  }
                                else
                               {?>

                                    <option value="<?php echo $user['use_username']; ?>"><?php echo $user['use_nombre'] . " " . $user['use_apellido']; ?></option>
                        <?php  }
                                                        
                            }
                            ?>
                        </select>
                        
                        <input type="hidden" value="<?php echo $key['rep_id'] ?>" name="repository" />
                        <input type="hidden" value="<?php echo $key['rep_countoas']?>" name="countoas" />                        
                        <input type="hidden" value="<?php echo $key['rep_registrationdate']?>" name="registrationdate">
                        <?php
                    }
                    ?>

                </div>
                </div>
            </div>
                <div class="row"><br></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="submit_link">

                            <input class="btn btn-info" type="submit" id="enviar"  value="Guardar" class="alt_btn">
                            <input class="btn btn-danger" type="reset" id="reset" value="Cancelar">

                        </div>
                    </div>
                </div>
            <footer>

            </footer>
            <script>
                         $("#refresh").click(function() {
                        window.location = "<?php echo base_url() ?>repositorio/lista/";
                        });
            </script>

          </form>
            </header>
            <div class="panel-body">
                <div class="row">

                <section id="main" class="column">

    <div class="spacer"></div>

       
    

<!--main content end-->


