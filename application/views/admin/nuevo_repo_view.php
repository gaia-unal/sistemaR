<?php if($user){$sess = 1; $usr = $user;}else{ $sess = 0; $usr=0;} ?>
<!--main content start-->
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
<!--se borraron algunos campos que  estan implicitos en los formularoios  -->
<script>
    $(function() {
        $('#tiporepositorio').change((function() {
            if ($('#tiporepositorio').val() == '') {
                $('#formulario').hide();
                
            }


            if ($('#tiporepositorio').val() == 'ROAp') {
                $('#formulario').show();
                $('#formulario2').hide();
                $('#formulario3').show();
                $('#lhost').text("Host");


                
            }
            ;

            if ($('#tiporepositorio').val() == 'OAI') {
                $('#formulario').show();
                $('#formulario2').show();
                $('#formulario3').hide();
                $('#lhost').text("Enlace OAI");
                
                
            }
            ;
        }));
    });
</script>





<section id="main-content">
    <section class="wrapper">
        <br>
        <section class="panel">
            <header class="panel-heading">

             <form autocomplete="off" action="<?php echo base_url() ?>index.php/repositorio/insert_repo/" method="post" onsubmit="return verificampos();" enctype="multipart/form-data">
            <header><h3>Registro Repositorio</h3></header>
            <div class="module_content">                
                <div class="col-lg-6">
                  <div class="row"> <br><br>              
                    <label>
                        Tipo de Repositorio
                    </label>

                    <select class="form-control" name="tiporepositorio"  id="tiporepositorio">

                        <option selected="selected" value="">Seleccione Tipo</option>
                        <option value="ROAp">ROAp</option>
                        <option value="OAI">OAI</option>
                    </select>
                    <br>
                </div>

                <div class="row">
                <div class="col-lg-12" id="formulario" style="display: none;">

                    <label>Nombre</label><br>
                    <input type="text" class="form-control" name="nombrerepositorio" id="nombrerepositorio" /><br>
                    <label>Entidad</label><br>
                    <input type="text" class="form-control" name="entidad" id="entidad" /><br>
                    <label>Correo Electrónico</label><br>
                    <input type="email" autocomplete="@gmail.com" class="form-control" name="email" id="email"/><br>
                    <label>URL</label><br>
                    <input type="text" class="form-control" name="url" id="url" /><br>
                    <!--SI  TIPO DE REPOSITORIO ES ROAp lhost = host, -->
                    <!--SI  TIPO DE REPOSITORIO ES OAi lhost = Enlace OAi, -->
                    <label id="lhost">Host</label><br>
                    <input type="text" class="form-control" name="host" id="host" /><br>

                    <!--ESTA PARTE DE FORMULARIO SOLO APARECERA  CON OAi -->
                    <div class="row">
                    <div class="col-lg-12" id="formulario2" style="display: none;">

                   
                    
                    <!--SELECT ENCARGADO DE LOS TIPOS DE ESTANDARES DE METADATOS -->
                    <label id="lmetadata">Estandar de Metadatos</label><br>
                    <select class="form-control" name="metadata"  id="metadata">

                        <option selected="selected" value="">Seleccione Tipo Metadatos</option>
                        <option value="lom">LOM</option>
                        <option value="obaa">ABAA</option>
                        <option value="cem">CEM</option>
                        <option value="dc">DUBLIN CORE</option>
                    </select><br>

                    <label id="lperiodicidad">Periodicidad Actualizaciones (días)</label>
                    <input type="text" class="form-control" id="periodicidad" name="periodicidad"><br>
                    </div></div>

                    <!--ESTA PARTE DE FORMULARIO SOLO APARECERA  CON ROAp -->
                    <div class="row">
                    <div class="col-lg-12" id="formulario3" style="display: none;">
                    <label id="lpuerto">Puerto</label><br>
                    <input type="text" class="form-control" name="puerto" id="puerto" /><br>
                    <label id="lbasededatos">Base De Datos</label><br>
                    <input type="text" class="form-control" name="basededatos" id="basededatos" /><br>
                    <label id="lusuario">Usuario</label><br>
                    <input type="text" class="form-control" name="usuario" id="usuario" /><br>
                    <label id="lcontrasena">Contraseña</label><br>
                    <input type="password" class="form-control" autocomplete="off" name="contrasena" id="contrasena" /><br>
                    </div></div>

                    <label>Usuario repositorio</label><br>
                     <select  class="form-control" id="usuariorepo" name="usuariorepo">
                    <!--SE AGREGARON LOS CAMPOS  AL SELECT QUE DEFINEN EL TIPO DE USUARIO EN EL FORMULARIO DE NUEVO REPOSITORIO-->
                    <!--PARA ROAp Y  OAi-->

                        <option selected="selected" value="0">--Seleccione un usuario--</option>
                        
                        <!--SE ENCARGA DE  MOSTRAR EN EL SELECT EL USERNAME DE LOS ADMINISTRADORES  Y AGEGARLO COMO OPCION -->
                        <?php
                        foreach ($usuarios as $user) { ?>
                            <option value="<?php echo $user['use_username']; ?>"><?php echo $user['use_nombre'] . " " . $user['use_apellido']; ?></option>
                            <?php
                        }
                        ?>
                        
                    </select><br>

                </div>
                </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="submit_link">

                                <input class="btn btn-info"  type="submit" id="enviar"  value="Guardar" class="alt_btn">
                                <input class="btn btn-danger" type="reset" id="reset" value="Cancelar">

                            </div>
                        </div>
                    </div>
                

            </div>
            <footer>

            </footer>
            <script>
                        $("#refresh").click(function() {
                        window.location = "<?php echo base_url() ?>repositorio/lista_repo/";
                        });
            </script>

          </form>
            </header>
            <div class="panel-body">
                <div class="row">

                <section id="main" class="column">

    <div class="spacer"></div>

       
    

<!--main content end-->


