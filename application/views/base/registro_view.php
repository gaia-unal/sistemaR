    <script type="text/javascript">

    $(document).ready(function() {

        $("#img_ok").hide();
        $("#img_not").hide();
        $("#submitg, #boton, #cancelar, #proc").button();

        $("#fecha_nac").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
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
                Crear cuenta en FROAC
              </header>
              <div class="panel-body">
               <div class="row">
                <form method="POST" role="form" action="<?php echo base_url();?>index.php/usuario/guardar" enctype='multipart/form-data' id="form">
                  <div class="col-lg-12">
                    <section class="panel">
                      <header class="panel-heading">
                        Información personal
                      </header>
                      <div class="panel-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Usted es:</label>
                          <select class="form-control input-sm m-bot15" name="tipoU" required>
                            <option value="2">Estudiante</option>
                            <!-- Se elimina la opción de registrarse con el rol de "profesor" ya que 
                             para este no se deben tener en cuenta las preferencias. A este lo agrega el admin-->
                            <!--<option value="3">Profesor</option>-->
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
                          <label for="fecha_nac">Fecha de nacimiento:</label>
                          <input data-date-viewmode="years" data-date-format="dd-mm-yyyy" type="text" class="form-control" id="fecha_nac" name="fecha_nac" placeholder="Selecciona año, mes y día" required>
                        </div>
                        <div class="form-group">
                          <label for="mail">E-mail:</label>
                          <input type="text" class="form-control" id="mail" name="mail" placeholder="Correo electronico" required>
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
                          <input type="password" class="form-control" id="passwd" name="" placeholder="Contraseña" required><br>
                          <input type="password" class="form-control" id="passwd2" name="passwd2" placeholder="Reescribe la contraseña" required>
                        </div>  
                        <div id="no_match" class="alert alert-block alert-danger fade in">
                          <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="icon-remove"></i>
                          </button>
                          <strong>Las contraseñas no concuerdan.</strong>
                        </div>                        
                        <div class="form-group">

                            <div class="form-group">
                            <label for="level">Nivel Educativo:</label>
                            <select class="form-control input-sm m-bot15" name="nevel_ed" required>
                            
                                  <?php 

                                foreach ($nivel_educativo as $key) { ?>

                                    <option name="level[]" value= "<?php echo $key->use_id_level ?>"><?php echo $key->use_level ?></option>
                                    <?php } ?>

                            </div>
                            
                            <div class="form-group">
                                <label for="pref">Preferencias:</label>
                              <select class="form-control input-sm m-bot15" name="nevel_ed" required>
                                  <?php 

                                foreach ($preferencias as $key) { ?>

                                    <input type="checkbox" name="pref[]" value= "<?php echo $key->use_pre_id ?>" /><?php echo $key->use_pre_preferencia ?><br />
                                    <?php } ?>
                            </div>
                            <header class="panel-heading">
               TEST DE ESTILO DE APRENDIZAJE
              </header>
                        
                  <p>Para conocer su estilo de aprendizaje puede realizar el test ahora mismo o en el momento que usted
                    lo requiera</p>
                <input type="button" id="boton" class="btn btn-info" value="Realizar Test">
                <input type="hidden" name="result_test" id="result_test" value="0">
                <h3 class="art-postheader" id="result"></h3>
                <input id="submitg" type="submit" class="btn btn-info" value="Guardar Información">
                      </div>
                    </section>
                  </div>
                  
            
                </form>
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
                                        Escoja las respuestas que mejor explican su preferencia. Seleccione mas de una
                                        respuesta si una respuesta simple no encaja con su percepción (Preguntas de la 1 a la 13). 
                                        De la pregunta 14 a la pregunta 24 seleccione una sola respuesta. <br>
                                        Deje en blanco toda pregunta que no se aplique.
                                    </td>                    
                                </tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>1. Usted está por darle instrucciones a una persona que está junto a usted, esa persona es de fuera, no
                                        conoce la ciudad, esta alojada en un hotel y quedan en encontrarse en otro lugar más tarde. Usted que
                                        haría?</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="1" ID="1" VALUE="V"/> Dibujo un mapa en un papel.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="1" VALUE="A"> Le digo cómo llegar.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="1" VALUE="R"> Le escribo las instrucciones (sin dibujar un mapa).</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="1" VALUE="K"> La busco y recojo en el hotel.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>2. Usted no está seguro como se deletrea la palabra tracendente o trascendente. Que haría usted.</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="2" VALUE="R"> Busco la palabra en un diccionario.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="2" VALUE="V"> Veo la palabra en mi mente y escojo según como la veo</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="2" VALUE="A"> La repito en mi mente.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="2" VALUE="K"> Escribo ambas versiones en un papel y escojo una.</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>3. Usted acaba de recibir una copia de un itinerario para un viaje mundial. Esto le interesa a un/a amigo/o.
                                        Usted que haría?</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="3" VALUE="A"> Hablarle por teléfono inmediatamente y contarle del viaje.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="3" VALUE="R"> Enviarle una copia del itinerario impreso.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="3" VALUE="V"> Mostrarle un mapa del mundo.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="3" VALUE="K"> Compartir que planea hacer en cada lugar que visite.</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>4. Usted esta por cocinar algo muy especial para su familia. Usted.</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="4" VALUE="K"> Cocina algo familiar que no necesite receta o instrucciones</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="4" VALUE="V"> Da una vista a través de un recetario por ideas de las fotos.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="4" VALUE="R"> Busca un libro de recetas especifico donde hay una buena receta.</td></tr>                                     
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>5. Un grupo de turistas le han sido asignados para que usted les explique del Area Nacional Protegida. Usted,</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="5" VALUE="K"> Organiza un viaje por el lugar.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="5" VALUE="V"> Les muestra fotos y transparencias</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="5" VALUE="R"> Les da un folleto o libro sobre las Areas Nacionales Protegidas.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="5" VALUE="A"> Les da una platica sobre las Areas Nacionales Protegidas.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>6. Usted está por comprarse un nuevo estéreo. Que otro factor, además del precio, influirá su decisión</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="6" VALUE="A"> El vendedor le dice lo que usted quiere saber.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="6" VALUE="R"> Leyendo los detalles sobre el estéreo.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="6" VALUE="K"> Jugando con los controles y escuchándolo.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="6" VALUE="V"> Luce muy bueno y a la moda (padre, cool, chido).</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>7. Recuerde un momento en su vida en que usted aprendió a hacer algo como a jugar un nuevo juego de
                                        cartas. Trate de evitar escoger una destreza física, como andar en bicicleta. Cómo aprendió usted mejor?</strong>
                                    </td>
                                </tr>                    
                                <tr><td ><INPUT TYPE=RADIO NAME="7" VALUE="V"> Pistas visuales—fotos, diagramas, cuadros...</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="7" VALUE="R"> Instrucciones escritas</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="7" VALUE="A"> Escuchando a alguien que se lo explicaba.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="7" VALUE="K"> Haciéndolo o probándolo.</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>8. Si usted tiene un problema en un ojo, usted prefiere que el doctor</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="8" VALUE="A"> Le diga que anda mal.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="8" VALUE="V"> Le muestre un diagrama de que está mal.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="8" VALUE="K"> Use un modelo para enseñarle qué está mal.</td></tr>                                     
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>9. Usted está apunto de aprender un nuevo programa en la computadora. Usted,</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="9" VALUE="K"> Se sienta frente al teclado y empieza a experimentar con el programa.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="9" VALUE="R"> Lee el manual que viene con el programa.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="9" VALUE="A"> Telefonea a un amigo y le hace preguntas sobre el programa.</td></tr>                                      
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>10. Usted va en su coche, a otra ciudad, en donde tiene amigos que quiere visitar. Usted quisiera que ellos:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="10" VALUE="V"> Le dibujen un mapa en un papel.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="10" VALUE="A"> Le den las instrucciones para llegar.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="10" VALUE="R"> Escriban las instrucciones (sin el mapa)</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="10" VALUE="K"> Lo esperen a usted en la gasolinera de la entrada a la ciudad.</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>11. Aparte del precio, que influirá más su decisión de compra de un libro de texto particular?</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="11" VALUE="K"> Usted ha usado una copia antes.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="11" VALUE="A"> Un amigo le ha platicado acerca del libro.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="11" VALUE="R"> Una lectura rápida de algunas partes del libro.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="11" VALUE="V"> El diseño de la pasta del libro es atractiva.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>12. Una nueva película ha llegado a los cines de la ciudad. Que influirá mas en la decisión de ir al cine o
                                        no—asumiendo que tiene el dinero para los boletos---</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="12" VALUE="A"> Usted oyó en el radio acerca de la película</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="12" VALUE="R"> Usted Leyó una reseña de la película.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="12" VALUE="V"> Usted vió una reseña en la televisión o en el cine.</td></tr>                                      
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>13. Usted prefiere que un profesor/maestro o conferencista use:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="13" VALUE="R"> Un libro de texto, copias, lecturas.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="13" VALUE="V"> Un diagrama de flujo, cuadros, gráficos, dispositivas.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="13" VALUE="K"> Sesiones prácticas, laboratorio, visitas, viajes de campo.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="13" VALUE="A"> Preguntas y respuestas, charlas, grupos de discusión u oradores invitados</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>14. Tengo tendencia a:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="49" VALUE="S"> Entender los detalles de un tema pero no ver claramente su estructura completa.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="49" VALUE="G"> Entender la estructura completa pero no ver claramente los detalles.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>15. Una vez que entiendo:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="50" VALUE="G"> Todas las partes, entiendo el total.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="50" VALUE="S"> El total de algo, entiendo como encajan sus partes.</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>16. Cuando resuelvo problemas de matemáticas:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="51" VALUE="S"> Generalmente trabajo sobre las soluciones con un paso a la vez.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="51" VALUE="G"> Frecuentemente sé cuales son las soluciones, pero luego tengo dificultad  para imaginarme los pasos para llegar a ellas.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>17. Cuando estoy analizando un cuento o una novela:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="52" VALUE="G"> Pienso en los incidentes y trato de acomodarlos para configurar los temas.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="52" VALUE="S"> Me doy cuenta de cuales son los temas cuando termino de leer y luego tengo que regresar y encontrar los incidentes que los demuestran.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>18. Es más importante para mí que un profesor:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="53" VALUE="S"> Exponga el material en pasos secuenciales claros.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="53" VALUE="G"> Me dé un panorama general y relacione el material con otros temas.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>19. Aprendo:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="54" VALUE="S"> A un paso constante. Si estudio con ahínco consigo lo que deseo.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="54" VALUE="G"> En inicios y pausas. Me llego a confundir y súbitamente lo entiendo.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>20. Cuando me enfrento a un cuerpo de información:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="55" VALUE="S"> Me concentro en los detalles y pierdo de vista el total de la misma.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="55" VALUE="G"> Trato de entender el todo antes de ir a los detalles.</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>21. Cuando escribo un trabajo, es más probable que:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="56" VALUE="G">  Lo haga (piense o escriba) desde el principio y avance.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="56" VALUE="S">  Lo haga (piense o escriba) en diferentes partes y luego las ordene.</td></tr>                  
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>22. Cuando estoy aprendiendo un tema, prefiero:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="57" VALUE="S"> Mantenerme concentrado en ese tema, aprendiendo lo más que pueda de él.</td></tr>                 
                                <tr><td ><INPUT TYPE=RADIO NAME="57" VALUE="G"> Hacer conexiones entre ese tema y temas relacionados.</td></tr>                 
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>23. Algunos profesores inician sus clases haciendo un bosquejo de lo que enseñarán. Esos bosquejos son:</strong>
                                    </td>
                                </tr>        
                                <tr><td ><INPUT TYPE=RADIO NAME="58" VALUE="S"> Algo útiles para mí.</td></tr>                  
                                <tr><td ><INPUT TYPE=RADIO NAME="58" VALUE="G"> Muy útiles para mí.</td></tr>                 
                                <tr>
                                <tr>
                                <tr><td>&nbsp;</td></tr>                  
                                <tr> 
                                    <td class="storytitle">
                                        <strong>24. Cuando resuelvo problemas en grupo, es más probable que yo:</strong>
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
                                    </td>
                                </tr> 
                            </table>
                        </td></tr></table>
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

  $("#passwd").change(function(){
    if ($("#passwd").val().length < 6){
      alert("Su contraseña debe ser de minimo 6 caracteres!")
      $("#passwd").val("");
    }
  });
  $("#passwd2").change(function(){
    if($("#passwd").val() != $("#passwd2").val()){
      $("#no_match").show();
      $("#passwd2").val("")
    } 
  });




  </script>
