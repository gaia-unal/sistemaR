hidden<script type="text/javascript">

    $(document).ready(function() {
        estiloAprendizaje= 'Para conocer su estilo de aprendizaje puede realizar el test ahora mismo o en el momento que usted lo requiera';
        $('#estiloaprendizaje').text(estiloAprendizaje);

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
         //Cerrar el calendario (datapicker) al seleccionar el dia
        $('#fecha_nac').on('changeDate', function (cer) {
            if(cer.viewMode === 'days'){
                $('fecha_nac').datepicker('hide');
            }
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
                var cantidades =  JSON.parse(respuesta);
                //$('#verResult').val(','+cantidades[0]+',');
                var larespuesta, cantidad1, cantidad2, cantidad3, cantidad4, cantidad5, cantidad6;
                var i=0;
                for (var x in cantidades) {
                    if (i==0) {
                        larespuesta= cantidades[x];
                    }else if (i==1) {
                        cantidad1= cantidades[x];
                    }else if (i==2){
                        cantidad2= cantidades[x];
                    }else if (i==3){
                        cantidad3= cantidades[x];
                    }else if (i==4){
                        cantidad4= cantidades[x];
                    }else if (i==5){
                        cantidad5= cantidades[x];
                    }else if (i==6){
                        cantidad6= cantidades[x];
                    }
                    i++;
                }
                $('#result_test').val(larespuesta);
                $('#form').show();
                $('#test').hide();
                $('#submitg').show();

                var estiloAprendizaje;
                switch ($('#result_test').val()) {
                    case '1':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Auditivo-Global (La instrucción que se habla o se escucha facilita el aprendizaje de este tipo de aprendizaje. Las conferencias, las grabaciones, los debates son todos mecanismos que permiten que las personas de este estilo exploren conceptos) ';
                        break;
                    case '2':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Auditivo-Secuencial (Las personas Auditivas secuenciales tienden a deletrear fonéticamente (sonidos.) Estos estudiantes aprenden escuchando y recuerdan los hechos cuando éstos son presentados en forma de poemas, cantos o melodías) ';
                        break;
                    case '3':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Kinestesico-Global (Estas personas aprender mejor haciendo actividades que les permiten experimentar o practicar el concepto que están intentando aprender. La clave para el aprendizaje efectivo es que la instrucción les ofrece oportunidades concretas para aplicar la información.)';
                        break;
                    case '4':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Kinestesico-Secuencial (Estas personas aprenden mejor moviendo, experimentando  y manipulando. Les gusta descubrir como funcionan las cosas y muchas veces son exitosos en artes prácticas como carpintería o diseño)';
                        break;
                    case '5':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Lector-Global (Las personas con una preferencia a la modalidad leer/escribir aprenden mejor cuando reciben y devuelven la información en palabras)';
                        break;
                    case '6':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Lector-Secuencial (Las personas con estilo de aprendizaje Lector Secuencial tienen preferencia por información impresa en forma de palabras)';
                        break;
                    case '7':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Visual-Global (Las personas Visuales Globales aprenden  mirando. Ellos van a imágenes del pasado cuando tratan de recordar. Ellos dibujan la forma de las cosas en su mente)';
                        break;
                    case '8':
                        estiloAprendizaje= 'Su estilo de aprendizaje es: Visual-Secuencial (Las personas visuales secuenciales gustan de reunir y procesar información usando tablas, diagramas, gráficas, mapas y otras imágenes o formas basadas en gráfico para aprender)';
                        break;
                    default:
                        estiloAprendizaje= 'Para conocer su estilo de aprendizaje puede realizar el test ahora mismo o en el momento que usted lo requiera';
                        break;
                }


                $('#estiloaprendizaje').text(estiloAprendizaje);
                $('#result_test').val(larespuesta);
                $('#cantidad1').val(cantidad1);
                $('#cantidad2').val(cantidad2);
                $('#cantidad3').val(cantidad3);
                $('#cantidad4').val(cantidad4);
                $('#cantidad5').val(cantidad5);
                $('#cantidad6').val(cantidad6);




            });
        });



        $('#boton').click(function() {
            $('#test').show();
            $('#form').hide();
            $('#submitg').hide();
            window.location.href = "#main-content";
        });
        $('#cancelar').click(function() {
            $('#test_need').hide();
            $('#form').show();
            $('#submitg').show();
        });
        $('#cancelar1').click(function() {
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
                        <header   class="panel-heading">
                            Crear cuenta en FROAC
                        </header>

                        <!--FORMULARIO DE REGISTRO DE USUARIO-->

                        <div class="panel-body">
                            <div class="row">
                                <form method="POST" role="form" action="<?php echo base_url();?>index.php/usuario/guardar" enctype='multipart/form-data' id="form">
                                    <div class="col-lg-12">
                                        <!--label>hola:</label><input type="text" id="verResult"/-->
                                        <section class="panel">
                                            <header class="panel-heading">
                                                Información personal
                                            </header>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <input type="hidden" value="2" name="tipoU">
                                                    <!--<label for="exampleInputEmail1">Usted es:</label>
                                                    <select class="form-control input-sm m-bot15" name="tipoU" required>
                                                    <option value="2">Estudiante</option>-->
                                                    <!-- Se elimina la opción de registrarse con el rol de "profesor" ya que
                                                    para este no se deben tener en cuenta las preferencias. A este lo agrega el admin-->
                                                    <!--<option value="3">Profesor</option>
                                                    </select>-->
                                                </div>
                                                <div class="form-group">
                                                    <input  type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellido">Apellido:</label>
                                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_nac">Fecha de nacimiento:</label>
                                                    <!--<input data-date-viewmode="years" data-date-format="dd-mm-yyyy" type="text" class="form-control" id="fecha_nac" name="fecha_nac" placeholder="Selecciona año, mes y día" required>-->
                                                    <input  type="text" class="form-control" id="fecha_nac" name="fecha_nac" placeholder="Selecciona año, mes y día" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mail">E-mail:</label>
                                                    <!-- Se valida la existencia de @ y . en el correo ingresado por medio del atributo pattern -->
                                                    <input type="text" class="form-control" id="mail" name="mail" placeholder="Correo electrónico" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
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
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario único en FROAC" required>
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
                                                    <label for="level">Nivel Educativo:</label>
                                                    <select class="form-control input-sm m-bot15" name="nevel_ed" required>
                                                        <?php
                                                        foreach ($nivel_educativo as $key) { ?>
                                                            <option name="level[]" value= "<?php echo $key->use_id_level ?>"><?php echo $key->use_level ?></option>
                                                        <?php } ?>
                                                </div><br/>
                                                <div class="form-group">
                                                    <label for="pref">Preferencias:</label>
                                                    <select class="form-control input-sm m-bot15" name="pref" required>
                                                        <?php
                                                        foreach ($preferencias as $key) { ?>
                                                            <input type="checkbox" name="pref[]" value= " <?php echo $key->use_pre_id ?> "/><?php echo $key->use_pre_preferencia ?><br />
                                                        <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pref">Idioma de preferencia:</label><br/>
                                                        <input type="checkbox" name="language[]" value="es"/>Español <br/>
                                                        <input type="checkbox" name="language[]" value="en"/>Ingles <br/>
                                                        <input type="checkbox" name="language[]" value="pt"/>Portugues<br />

                                                </div>
                                                <div class="form-group">
                                                    <label for="pref">Preferencias del formato del recurso educativo:</label><br/>
                                                        <input type="checkbox" name="format[]" value="zip/html"/>Zip<br/>
                                                        <input type="checkbox" name="format[]" value="rar"/>RAR <br/>
                                                        <input type="checkbox" name="format[]" value="7z"/>7Z <br/>
                                                        <input type="checkbox" name="format[]" value="pdf"/>PDF <br/>
                                                        <input type="checkbox" name="format[]" value="pptx"/>PowerPoint <br/>
                                                        <input type="checkbox" name="format[]" value="mp4"/>MP4 <br/>
                                                        <input type="checkbox" name="format[]" value="svg"/>SVG <br/>
                                                        <input type="checkbox" name="format[]" value="jpg"/>JPG <br/>
                                                        <input type="checkbox" name="format[]" value="png"/>PNG <br/>
                                                        <input type="checkbox" name="format[]" value="wmv"/>WMV <br/>
                                                        <input type="checkbox" name="format[]" value="exe"/>EXE <br/>
                                                        <input type="checkbox" name="format[]" value="Html/php/Javascript"/>HTML <br/>
                                                        <input type="checkbox" name="format[]" value="Realidad aumentada"/>Realidad aumentada <br/>

                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <strong>¿Presenta algún tipo de necesidad especial?</strong>
                                                <div class="row col-md-12">
                                                    <INPUT TYPE=RADIO id="discapasi" NAME="NO" value="Si"> Si
                                                    <INPUT TYPE=RADIO id="discapano" NAME="NO" value="No"> No
                                                </div>
                                            </div>

                                            <input type="button" style="display:none;" value="Realizar Test NEED" name="need" id="need" class="btn btn-info">
                                    </div>
                                    <!--FIN FORMULARIO DE REGISTRO DE USUARIO-->
                                    <input type="text" style="display: none;" id="necesidadespecial" name="necesidadespecial">


                                    TEST DE ESTILO DE APRENDIZAJE
                                    </header>
                                    <p><label id="estiloaprendizaje"></label></p>

                                    <input type="button" id="boton" class="btn btn-info" value="Realizar Test">
                                    <input type="hidden" name="result_test" id="result_test" ><!--value="0"-->
                                    <input type="hidden" name="cantidad1" id="cantidad1" ><!--value="0"-->
                                    <input type="hidden" name="cantidad2" id="cantidad2" ><!--value="0"-->
                                    <input type="hidden" name="cantidad3" id="cantidad3" ><!--value="0"-->
                                    <input type="hidden" name="cantidad4" id="cantidad4" ><!--value="0"-->
                                    <input type="hidden" name="cantidad5" id="cantidad5" ><!--value="0"-->
                                    <input type="hidden" name="cantidad6" id="cantidad6" ><!--value="0"-->
                                    <h3 class="art-postheader" id="result" ></h3>


                                    <input id="submitg" type="submit" class="btn btn-info" value="Guardar Información">
                                </form>
                            </div>
                    </section>
                </div>

                <!-- TEST PARA ESTUDIANTES CON NECESIDADES ESPECIALES-->

                <div id="test_need" class="col-md-12" style="display: none;">
                    <h3  align="center">Test para Personas con Necesidades Especiales</h3>
                    <form action="<?php echo base_url() ?>index.php/usuario/test_need/" name="form_test_need" id="form_test_need" method="POST" enctype="multipart/form-data">
                        Con el fin de ofrecer Objetos de Aprendizaje más acorde a sus necesidades, se aconseja realizar el siguiente test. Se recomienda contar con el apoyo de un acompañante


                        <div id="tipoLim"class="row col-md-12">
                            <strong>•   ¿Qué tipo de necesidad especial presenta?</strong>
                            <div class="row col-md-12">
                                <INPUT TYPE=checkbox id="1" NAME="1" estado="0" value="Visual"> Visual
                                <div class="row col-md-12">
                                    <INPUT TYPE=checkbox id="2" NAME="2" estado="0" value="Auditivo"> Auditivo
                                </div>
                                <div class="row col-md-12">
                                    <INPUT TYPE=checkbox id="3" NAME="3" estado="0" value="Motriz"> Motriz
                                </div>
                                <div class="row col-md-12">
                                    <INPUT TYPE=checkbox id="4" NAME="4" estado="0" value="Cognitiva"> Cognitiva
                                </div>
                            </div>
                        </div>

                        <!--#########################################################################################-->
                        <!-- Limitacion Visual -->

                        <div id="limitacionV" class="row col-md-12" style="display: none;">
                            <hr>
                            <strong>•   ¿En qué grado se presenta dicha condición?</strong>
                            <div class="row col-md-12">
                                <INPUT TYPE=radio id="5" NAME="7" value="Vision Nula"> Visión Nula
                                <div class="row col-md-12">
                                    <INPUT TYPE=radio id="6" NAME="7" value="Baja Vision"> Baja Visión
                                </div>

                                <div id="tamaño" class="row col-md-12" style="display: none;">
                                    <hr>
                                    <strong>•   ¿Cuál de los siguientes textos puede comprender con mayor facilidad?</strong>

                                    <div class="row col-md-12">
                                        <INPUT TYPE=radio id="81" NAME="8" estado="0" value="1.1"><span style="font-size: 1.1em">Federación de Repositorios de Objetos de Aprendizaje Colombia – FROAC</span>
                                        <div class="row col-md-12">
                                            <INPUT TYPE=radio id="82" NAME="8" estado="0" value="1.3"><span style="font-size: 1.3em">Federación de Repositorios de Objetos de Aprendizaje Colombia – FROAC</span>
                                        </div>
                                        <div class="row col-md-12">
                                            <INPUT TYPE=radio id="83" NAME="8" estado="0" value="1.7"> <span style="font-size: 1.7em">Federación de Repositorios de Objetos de Aprendizaje Colombia – FROAC</span>
                                        </div>
                                        <div class="row col-md-12">
                                            <INPUT TYPE=radio id="84" NAME="8" estado="0" value="2.0"> <span style="font-size: 2.0em">Federación de Repositorios de Objetos de Aprendizaje Colombia – FROAC</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--#########################################################################################-->
                        <!-- Limitacion Auditiva -->

                        <div id="limitacionA"class="row col-md-12" style="display: none;">
                            <hr>
                            <strong>•   ¿En qué grado se presenta dicha condición?</strong>

                            <div class="row col-md-12">
                                <INPUT TYPE=RADIO id="91" NAME="91" value="Audicion Nula"> Audición Nula
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="92" NAME="92" value="Baja Audicion"> Audición Baja
                                </div>
                            </div>
                            <div id="Señas-Simbolo"class="row col-md-12">
                                <hr>
                                <strong>•   ¿Comprende lenguaje de señas?</strong>
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="101" NAME="10" value="Si Lenguaje"> Si
                                    <div id="edad"class="row col-md-12">
                                        <INPUT TYPE=RADIO id="102" NAME="10" value="No Lenguaje"> No
                                    </div>
                                </div>
                            </div>
                            <div id="entiende_lenguaje"class="row col-md-12">
                                <hr>
                                <strong>•   ¿Comprende textos?</strong>
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="111" NAME="11" value="Si Idioma"> Si
                                    <div class="row col-md-12">
                                        <INPUT TYPE=RADIO id="112" NAME="11" value="No Idioma"> No
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--######################################################-->
                        <!-- Limitacion Motriz -->

                        <div id="limitacionM"class="row col-md-12" style="display: none;">
                            <hr>
                            <strong>•   ¿Presenta usted alguna dificultad para manipular el mouse?</strong>

                            <div class="row col-md-12">
                                <INPUT TYPE=RADIO id="12" NAME="12" value="Si mouse"> Si
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="12" NAME="12" value="No mouse"> No
                                </div>
                            </div>
                            <div id="utiliza_teclado"class="row col-md-12">
                                <hr>
                                <strong>•   ¿Presenta usted alguna dificultad para manipular el teclado?</strong>
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="13" NAME="13" value="Si teclado"> Si
                                    <div class="row col-md-12">
                                        <INPUT TYPE=RADIO id="13" NAME="13" value="No teclado"> No
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--######################################################-->
                        <!-- Limitacion Cognitiva -->

                        <div id="limitacionC"class="row col-md-12"style="display: none;">
                            <hr>
                            <strong>•   ¿Presenta dificultades para recordar o concentrarse?</strong>

                            <div class="row col-md-12">
                                <INPUT TYPE=RADIO id="141" NAME="14" value="Si concentra"> Si
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="142" NAME="14" value="No concentra"> No
                                </div>
                            </div>
                            <div id="lee"class="row col-md-12">
                                <hr>
                                <strong>•   ¿Tiene dificultades para comprender un texto escrito o expresarse a través del mismo?</strong>
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="151" NAME="15" value="Si texto"> Si
                                    <div class="row col-md-12">
                                        <INPUT TYPE=RADIO id="152" NAME="15" value="No texto"> No
                                    </div>
                                </div>
                            </div>
                            <div id="sigue_instrucciones"class="row col-md-12">
                                <strong>•   ¿Suele tener dificultades para seguir instrucciones o actividades que se le indican?</strong>
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="161" NAME="16" value="Si instrucciones"> Si
                                    <div class="row col-md-12">
                                        <INPUT TYPE=RADIO id="162" NAME="16" value="No instrucciones"> No
                                    </div>
                                </div>
                            </div>
                            <div id="se_distrae"class="row col-md-12">
                                <hr>
                                <strong>  • ¿Se distrae fácilmente?</strong>
                                <div class="row col-md-12">
                                    <INPUT TYPE=RADIO id="171" NAME="17" value="Si distrae"> Si
                                    <div id="edad"class="row col-md-12">
                                        <INPUT TYPE=RADIO id="172" NAME="17" value="No distrae"> No
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                    <div class="row col-md-12">
                        <input type="button" value="Enviar" name="respuesta_need" id="respuesta_need" class="btn btn-info">
                        <input type="button" value="Cancelar" name="cancelar" id="cancelar" class="btn btn-info">
                    </div>
                </div>

                <!-- FIN TEST PARA ESTUDIANTES CON NECESIDADES ESPECIALES-->


                <!--TEST DE ESTILO DE APRENDIZAJE-->

                <div id="test" style="display: none;">
                    <h3>Test de Estilos de Aprendizaje</h3>
                    <form action="<?php echo base_url() ?>index.php/usuario/test_result/" name="form_usr" id="form_usr" method="POST" enctype="multipart/form-data">
                        <table class="table1" width="100%" border="0" cellspacing="1" cellpadding="0" align="center"><tr><td>
                            <table class="table2" width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
                                <tr>
                                    <td class="boxtitle" align="left"><strong>¿CÓMO APRENDO MEJOR?</strong></td>
                                </tr>
                                <tr>
                                    <td align="justify">
                                        <br></br>
                                        Este cuestionario tiene como propósito saber algo acerca de sus preferencias sobre cómo trabaja con
                                        información. Usted tendrá un estilo de aprendizaje preferido y una parte de ese Estilo de Aprendizaje es
                                        su preferencia para capturar, procesar y entregar ideas e información.
                                        Escoja las respuestas que mejor explican su preferencia. Seleccione más de una
                                        respuesta si una respuesta simple no encaja con su percepción (Preguntas de la 1 a la 13).
                                        De la pregunta 14 a la pregunta 24 seleccione una sola respuesta. <br>
                                        Deje en blanco toda pregunta que no se aplique.
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        1. Usted está por darle instrucciones a una persona que está junto a usted, esa persona es de fuera, no
                                        conoce la ciudad, ésta alojada en un hotel y quedan en encontrarse en otro lugar más tarde. ¿Usted que
                                        haría?
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="1" VALUE="V"> Dibujo un mapa en un papel.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="2" VALUE="A"> Le digo cómo llegar.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="3" VALUE="R"> Le escribo las instrucciones (sin dibujar un mapa).</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="4" VALUE="K"> La busco y recojo en el hotel.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        2. Usted no está seguro como se deletrea la palabra tracendente o trascendente. Que haría usted.
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="5" VALUE="R"> Busco la palabra en un diccionario.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="6" VALUE="V"> Veo la palabra en mi mente y escojo según como la veo</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="7" VALUE="A"> La repito en mi mente.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="8" VALUE="K"> Escribo ambas versiones en un papel y escojo una.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        3. Usted acaba de recibir una copia de un itinerario para un viaje mundial. Esto le interesa a un/a amigo/o.
                                        ¿Usted que haría?
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="9" VALUE="A"> Hablarle por teléfono inmediatamente y contarle del viaje.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="10" VALUE="R"> Enviarle una copia del itinerario impreso.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="11" VALUE="V"> Mostrarle un mapa del mundo.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="12" VALUE="K"> Compartir que planea hacer en cada lugar que visite.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        4. Usted está por cocinar algo muy especial para su familia. Usted.
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="13" VALUE="K"> Cocina algo familiar que no necesite receta o instrucciones</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="14" VALUE="V"> Da una vista a través de un recetario por ideas de las fotos.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="15" VALUE="R"> Busca un libro de recetas específico donde hay una buena receta.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        5. Un grupo de turistas le han sido asignados para que usted les explique del Área Nacional Protegida. Usted,
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="16" VALUE="K"> Organiza un viaje por el lugar.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="17" VALUE="V"> Les muestra fotos y transparencias</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="18" VALUE="R"> Les da un folleto o libro sobre las Áreas Nacionales Protegidas.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="19" VALUE="A"> Les da una platica sobre las Áreas Nacionales Protegidas.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        6. Usted está por comprarse un nuevo estéreo. Que otro factor, además del precio, influirá su decisión
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="20" VALUE="A"> El vendedor le dice lo que usted quiere saber.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="21" VALUE="R"> Leyendo los detalles sobre el estéreo.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="22" VALUE="K"> Jugando con los controles y escuchándolo.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="23" VALUE="V"> Luce muy bueno y a la moda (padre, cool, chido).</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        7. Recuerde un momento en su vida en que usted aprendió a hacer algo como a jugar un nuevo juego de
                                        cartas. Trate de evitar escoger una destreza física, como andar en bicicleta. ¿Cómo aprendió usted mejor?
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="24" VALUE="V"> Pistas visuales—fotos, diagramas, cuadros...</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="25" VALUE="R"> Instrucciones escritas</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="26" VALUE="A"> Escuchando a alguien que se lo explicaba.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="27" VALUE="K"> Haciéndolo o probándolo.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        8. Si usted tiene un problema en un ojo, usted prefiere que el doctor
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="28" VALUE="A"> Le diga que anda mal.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="29" VALUE="V"> Le muestre un diagrama de que está mal.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="30" VALUE="K"> Use un modelo para enseñarle qué está mal.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        9. Usted está apunto de aprender un nuevo programa en la computadora. Usted,
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="31" VALUE="K"> Se sienta frente al teclado y empieza a experimentar con el programa.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="32" VALUE="R"> Lee el manual que viene con el programa.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="33" VALUE="A"> Telefonea a un amigo y le hace preguntas sobre el programa.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        10. Usted va en su coche, a otra ciudad, en donde tiene amigos que quiere visitar. Usted quisiera que ellos:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="34" VALUE="V"> Le dibujen un mapa en un papel.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="35" VALUE="A"> Le den las instrucciones para llegar.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="36" VALUE="R"> Escriban las instrucciones (sin el mapa)</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="37" VALUE="K"> Lo esperen a usted en la gasolinera de la entrada a la ciudad.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        11. Aparte del precio, ¿Qué influirá más su decisión de compra de un libro de texto particular?
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="38" VALUE="K"> Usted ha usado una copia antes.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="39" VALUE="A"> Un amigo le ha platicado acerca del libro.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="40" VALUE="R"> Una lectura rápida de algunas partes del libro.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="41" VALUE="V"> El diseño de la pasta del libro es atractiva.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        12. Una nueva película ha llegado a los cines de la ciudad. Que influirá más en la decisión de ir al cine o
                                        no—asumiendo que tiene el dinero para los boletos---
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="42" VALUE="A"> Usted oyó en el radio acerca de la película</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="43" VALUE="R"> Usted Leyó una reseña de la película.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="44" VALUE="V"> Usted vio una reseña en la televisión o en el cine.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        13. Usted prefiere que un profesor/maestro o conferencista use:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="45" VALUE="R"> Un libro de texto, copias, lecturas.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="46" VALUE="V"> Un diagrama de flujo, cuadros, gráficos, dispositivas.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="47" VALUE="K"> Sesiones prácticas, laboratorio, visitas, viajes de campo.</td></tr>
                                <tr><td ><INPUT TYPE=CHECKBOX NAME="48" VALUE="A"> Preguntas y respuestas, charlas, grupos de discusión u oradores invitados</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        14. Tengo tendencia a:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="49" VALUE="S"> Entender los detalles de un tema pero no ver claramente su estructura completa.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="49" VALUE="G"> Entender la estructura completa pero no ver claramente los detalles.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        15. Una vez que entiendo:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="50" VALUE="G"> Todas las partes, entiendo el total.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="50" VALUE="S"> El total de algo, entiendo como encajan sus partes.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        16. Cuando resuelvo problemas de matemáticas:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="51" VALUE="S"> Generalmente trabajo sobre las soluciones con un paso a la vez.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="51" VALUE="G"> Frecuentemente sé cuáles son las soluciones, pero luego tengo dificultad  para imaginarme los pasos para llegar a ellas.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        17. Cuando estoy analizando un cuento o una novela:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="52" VALUE="G"> Pienso en los incidentes y trato de acomodarlos para configurar los temas.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="52" VALUE="S"> Me doy cuenta de cuáles son los temas cuando termino de leer y luego tengo que regresar y encontrar los incidentes que los demuestran.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        18. Es más importante para mí que un profesor:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="53" VALUE="S"> Exponga el material en pasos secuenciales claros.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="53" VALUE="G"> Me dé un panorama general y relacione el material con otros temas.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        19. Aprendo:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="54" VALUE="S"> A un paso constante. Si estudio con ahínco consigo lo que deseo.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="54" VALUE="G"> En inicios y pausas. Me llego a confundir y súbitamente lo entiendo.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        20. Cuando me enfrento a un cuerpo de información:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="55" VALUE="S"> Me concentro en los detalles y pierdo de vista el total de la misma.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="55" VALUE="G"> Trato de entender el todo antes de ir a los detalles.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        21. Cuando escribo un trabajo, es más probable que:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="56" VALUE="G">  Lo haga (piense o escriba) desde el principio y avance.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="56" VALUE="S">  Lo haga (piense o escriba) en diferentes partes y luego las ordene.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        22. Cuando estoy aprendiendo un tema, prefiero:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="57" VALUE="S"> Mantenerme concentrado en ese tema, aprendiendo lo más que pueda de él.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="57" VALUE="G"> Hacer conexiones entre ese tema y temas relacionados.</td></tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        23. Algunos profesores inician sus clases haciendo un bosquejo de lo que enseñarán. Esos bosquejos son:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="58" VALUE="S"> Algo útiles para mí.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="58" VALUE="G"> Muy útiles para mí.</td></tr>
                                <tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td class="storytitle">
                                        24. Cuando resuelvo problemas en grupo, es más probable que yo:
                                    </td>
                                </tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="59" VALUE="S"> Piense en los pasos para la solución de los problemas.</td></tr>
                                <tr><td ><INPUT TYPE=RADIO NAME="59" VALUE="G"> Piense en las posibles consecuencias o aplicaciones de la solución en un amplio rango de campos.</td></tr>
                                <tr>

                                <tr><td>&nbsp;</td></tr>
                                <tr>


                                    <td class="cuadroOscuro" colspan="2" align="center">
                                        <input type="hidden" name="op" value="guardar_vark">
                                        <input type="hidden" name="mod" value="mod_vark">
                                        <input type="button" value="Enviar" name="proc" id="proc" class="btn btn-info">
                                        <input type="button" value="Cancelar" name="cancelar1" id="cancelar1" class="btn btn-info">
                                    </td>
                                </tr>
                            </table>
                        </td></tr></table>
                </form>

                <!--FIN TEST DE ESTILO DE APRENDIZAJE-->
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

//######################################################################################################################

  //En caso de tener discapacidad se debe mostar un botón que lo lleve al formulario Test para personas con necesidades
  // especiales

  $("#discapasi").click(function () {
          $("#need").show();
      });

  //En caso de dar click en la opción "SI" por equivocación, al dar click en la opción "No", el botón se ocultará.

  $("#discapano").click(function () {
      $("#need").hide();
  })
//######################################################################################################################

//####################################################################################################################

  //Cuando se tiene una discapacidad y se da click en el botón realizar test, este muestra el formulario para
  // realizar el test para personas con necesidades especiales

  $('#need').click(function() {
      $('#test_need').show();
      $('#form').hide();
      $('#submitg').hide();
      window.location.href = "#main-content";
  });

//#####################################################################################################################

//#####################################################################################################################

  //Cuando se tiene una discapacidad, se muestran las preguntas correspondientes al tipo de discapacidad seleccionada.

  $("#1").click(function () {
      if($("#1").attr("estado")==0){
          $("#limitacionV").show();
          $("#1").attr("estado", 1);

      }else{
          $("#1").prop("checked", false);
          $("#limitacionV").hide();
          $("#1").attr("estado", 0);

      }

  });

  $("#6").click(function () {
      if($("#6").attr("estado")==0){
          $("#tamaño").show();
          $("#6").attr("estado", 1);

      }else{
          $("#6").prop("checked", false);
          $("#tamaño").hide();
          $("#6").attr("estado", 0);

      }

  });

  $("#5").click(function () {
      $("#tamaño").hide();
  });

  $("#2").click(function () {
          if($("#2").attr("estado")==0){
              $("#limitacionA").show();
              $("#2").attr("estado", 1);

          }else{
              $("#2").prop("checked", false);
              $("#limitacionA").hide();
              $("#2").attr("estado", 0);

          }
  });

  $("#8").click(function () {
        if($("#8").attr("estado")==0){
            $("#8").attr("estado", 1);
        }else{
            $("#8").prop("checked", false);
            $("#8").attr("estado", 0);
        }
  });


  $("#3").click(function () {
      if($("#3").attr("estado")==0){
          $("#limitacionM").show();
          $("#3").attr("estado", 1);

      }else{
          $("#3").prop("checked", false);
          $("#limitacionM").hide();
          $("#3").attr("estado", 0);

      }

  });

  $("#4").click(function () {
      if($("#4").attr("estado")==0){
          $("#limitacionC").show();
          $("#4").attr("estado", 1);

      }else{
          $("#4").prop("checked", false);
          $("#limitacionC").hide();
          $("#4").attr("estado", 0);

      }

  });


//#####################################################################################################################

//#####################################################################################################################


  $('#respuesta_need').click(function() {
      $("#necesidadespecial").val("");
      //Limitacion Visual ******************
      if($("#1").is(":checked")){
        if($("#5").is(":checked")){
            if($("#necesidadespecial").val()!=""){
                $("#necesidadespecial").val($("#necesidadespecial").val()+",Vision-Nula");
            }else{
                $("#necesidadespecial").val("Vision-Nula");
            }

            $("#necesidadespecial").show();
        }

          if($("#81").is(":checked")){

              if($("#necesidadespecial").val()!=""){
                  $("#necesidadespecial").val($("#necesidadespecial").val()+",Vision-Parcial"+$("#81").attr("value"));
              }else{
                  $("#necesidadespecial").val("Vision-Parcial"+$("#81").attr("value"));
              }
          }

          if($("#82").is(":checked")){

              if($("#necesidadespecial").val()!=""){
                  $("#necesidadespecial").val($("#necesidadespecial").val()+",Vision-Parcial"+$("#82").attr("value"));
              }else{
                  $("#necesidadespecial").val("Vision-Parcial"+$("#82").attr("value"));
              }
          }

          if($("#83").is(":checked")){

              if($("#necesidadespecial").val()!=""){
                  $("#necesidadespecial").val($("#necesidadespecial").val()+",Vision-Parcial"+$("#83").attr("value"));
              }else{
                  $("#necesidadespecial").val("Vision-Parcial"+$("#83").attr("value"));
              }
          }

          if($("#84").is(":checked")){

              if($("#necesidadespecial").val()!=""){
                  $("#necesidadespecial").val($("#necesidadespecial").val()+",Vision-Parcial"+$("#84").attr("value"));
              }else{
                  $("#necesidadespecial").val("Vision-Parcial"+$("#84").attr("value"));
              }
          }
          $("#necesidadespecial").show();
      }

      //Limitacion Visual ******************

      //Limitacion Auditiva *************************
      if($("#2").is(":checked")){
        if($("#91").is(":checked")){

            if($("#101").is(":checked")){

                if($("#111").is(":checked")){

                    if($("#necesidadespecial").val()!=""){
                        $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#91").attr("value")+"/Señas-Texto");
                    }else{
                        $("#necesidadespecial").val($("#91").attr("value")+"/Señas-Texto");
                    }
                }else {

                        if($("#necesidadespecial").val()!=""){
                            $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#91").attr("value")+"/Señas");
                        }else {
                            $("#necesidadespecial").val($("#91").attr("value") + "/Señas");
                        }
                    }
                }else{
                if($("#111").is(":checked")){

                    if($("#101").is(":checked")){
                        if($("#111").is(":checked")){
                            if($("#necesidadespecial").val()!=""){
                                $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#91").attr("value")+"/Señas-Texto");
                            }else{
                                $("#necesidadespecial").val($("#91").attr("value")+"/Señas-Texto");
                            }
                        }else {

                            if($("#necesidadespecial").val()!=""){
                                $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#91").attr("value")+"/Señas");
                            }else{
                                $("#necesidadespecial").val($("#91").attr("value")+"/Señas");
                            }

                        }

                    }else{
                        if($("#111").is(":checked")){
                            if($("#necesidadespecial").val()!=""){
                                $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#91").attr("value")+"/Texto");
                            }else{
                                $("#necesidadespecial").val($("#91").attr("value")+"/Texto");
                            }
                        }
                    }


                }
            }


        }

          if($("#92").is(":checked")){

              if($("#101").is(":checked")){

                  if($("#111").is(":checked")){

                      if($("#necesidadespecial").val()!=""){
                          $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#92").attr("value")+"/Señas-Texto");
                      }else{
                          $("#necesidadespecial").val($("#92").attr("value")+"/Señas-Texto");
                      }
                  }else {

                      if($("#necesidadespecial").val()!=""){
                          $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#92").attr("value")+"/Señas");
                      }else {
                          $("#necesidadespecial").val($("#92").attr("value") + "/Señas");
                      }
                  }
              }else{
                  if($("#111").is(":checked")){

                      if($("#101").is(":checked")){
                          if($("#111").is(":checked")){
                              if($("#necesidadespecial").val()!=""){
                                  $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#92").attr("value")+"/Señas-Texto");
                              }else{
                                  $("#necesidadespecial").val($("#92").attr("value")+"/Señas-Texto");
                              }
                          }else {

                              if($("#necesidadespecial").val()!=""){
                                  $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#92").attr("value")+"/Señas");
                              }else{
                                  $("#necesidadespecial").val($("#92").attr("value")+"/Señas");
                              }

                          }

                      }else{
                          if($("#111").is(":checked")){
                              if($("#necesidadespecial").val()!=""){
                                  $("#necesidadespecial").val($("#necesidadespecial").val()+","+$("#92").attr("value")+"/Texto");
                              }else{
                                  $("#necesidadespecial").val($("#92").attr("value")+"/Texto");
                              }
                          }
                      }


                  }
              }


          }


          $("#necesidadespecial").show();
      }

      if($("#3").is(":checked")){

          if($("#12").is(":checked")){
              if($("#13").is(":checked")){
                  if($("#necesidadespecial").val()!=""){
                      $("#necesidadespecial").val($("#necesidadespecial").val()+",Motriz"+"/Mouse-Teclado");
                  }else{
                      $("#necesidadespecial").val("Motriz"+"/Mouse-Teclado");
                  }
              }else{
                  if($("#necesidadespecial").val()!=""){
                      $("#necesidadespecial").val($("#necesidadespecial").val()+",Motriz"+"/Mouse");
                  }else{
                      $("#necesidadespecial").val("Motriz"+"/Mouse");
                  }
              }
          }else{
              if($("#13").is(":checked")){
                  if($("#necesidadespecial").val()!=""){
                      $("#necesidadespecial").val($("#necesidadespecial").val()+",Motriz"+"/Teclado");
                  }else{
                      $("#necesidadespecial").val("Motriz"+"/Teclado");
                  }
              }
          }
          $("#necesidadespecial").show();
      }
      if($("#4").is(":checked")){
          if($("#necesidadespecial").val()!=""){
              $("#necesidadespecial").val($("#necesidadespecial").val()+",Cognitivo/");
          }else{
              $("#necesidadespecial").val("Cognitivo/");
          }
          if($("#141").is(":checked")){
              $("#necesidadespecial").val($("#necesidadespecial").val()+"-ConcentraSi");
          }else{
              $("#necesidadespecial").val($("#necesidadespecial").val()+"-ConcentraNo");
          }
          if($("#151").is(":checked")){
              $("#necesidadespecial").val($("#necesidadespecial").val()+"-TextoSi");
          }else{
              $("#necesidadespecial").val($("#necesidadespecial").val()+"/TextoNo");
          }
          if($("#161").is(":checked")){
              $("#necesidadespecial").val($("#necesidadespecial").val()+"-InstruccionesSi");
          }else{
              $("#necesidadespecial").val($("#necesidadespecial").val()+"-InstruccionesNo");
          }
          if($("#171").is(":checked")){
              $("#necesidadespecial").val($("#necesidadespecial").val()+"-DistraccionSi");
          }else{
              $("#necesidadespecial").val($("#necesidadespecial").val()+"-DistraccionNo");
          }
          /*var str = $("#necesidadespecial").val();
          $("#necesidadespecial").val(str.substring(0, (str.length)-1));*/
          $("#necesidadespecial").show();
      }
      $("#necesidadespecial").show();
        $('#form').show();
        $('#test_need').hide();
        $('#submitg').show();


  });
//#####################################################################################################################

  </script>
