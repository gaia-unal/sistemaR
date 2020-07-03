<?php
    function base64_url_encode($input) {
        return strtr(base64_encode($input), '/', '.');
    }
       
    $lo_id = base64_url_encode(array_column($result,'lo')[0]);
    $rep_id = base64_url_encode(array_column($result,'rep')[0]);
    $title= base64_url_encode(array_column($result,'title')[0]);
    $url= base64_url_encode(array_column($result,'url')[0]);
    $argument=base64_url_encode(array_column($result,'argument')[0]);
    $argument_type=base64_url_encode(array_column($result,'argument_type')[0]);
    $argument_code=base64_url_encode(array_column($result,'argument_code')[0]);
    $argument_number=1;

    $argument1=base64_url_encode(array_column($result,'argument')[1]);
    $argument_type1=base64_url_encode(array_column($result,'argument_type')[1]);
    $argument_code1=base64_url_encode(array_column($result,'argument_code')[1]);
    $argument_number1=2;

    $argument2=base64_url_encode(array_column($result,'argument')[2]);
    $argument_type2=base64_url_encode(array_column($result,'argument_type')[2]);
    $argument_code2=base64_url_encode(array_column($result,'argument_code')[2]);
    $argument_number2=3;

    $argument3=base64_url_encode(array_column($result,'argument')[3]);
    $argument_type3=base64_url_encode(array_column($result,'argument_type')[3]);
    $argument_code3=base64_url_encode(array_column($result,'argument_code')[3]);
    $argument_number3=4;

    if(array_column($result,'argument')[1]==null){
        $argument1=base64_url_encode('ErrNothing');
        $argument_type1=base64_url_encode('ErrNothing');
        $argument_code1=base64_url_encode('ErrNothing');
    }
    if(array_column($result,'argument')[2]==null){
        $argument2=base64_url_encode('ErrNothing');
        $argument_type2=base64_url_encode('ErrNothing');
        $argument_code2=base64_url_encode('ErrNothing');
    }
    if(array_column($result,'argument')[3]==null){
        $argument3=base64_url_encode('ErrNothing');
        $argument_type3=base64_url_encode('ErrNothing');
        $argument_code3=base64_url_encode('ErrNothing');
    }
    
?>

<style>
    .not-bold {
        font-weight: normal;
    }

    .space {
        margin-left: 10px;
    }

    .not-line-break {
        display: inline-block;
    }

    .line-space {
        line-height: 0px;
    }

    .not-mg {
        margin: 0px;
        /* display: flex; */
        align-items: center;
    }

    .form-group>label>input {
        padding-top: 50px;
    }

    legend.scheduler-border {
        width: auto;
        /* Or auto */
        padding: 0 10px;
        /* To give a bit of padding on the left and right */
        border-bottom: none;
    }

    fieldset.scheduler-border {
        width: 70%;
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;

    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
    }

    .center {
        text-align: center;
    }

    .color-1 {
        color: #144f4d;
    }

    .color-2 {
        color: #0e2e42;
    }
</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <br>
        <section class="panel">
            <header class="panel-heading">
                <h1 class="center color-1">
                    Recurso educativo recomendado: "<?php echo array_column($result,'title')[0];?>"
                </h1>
            </header>

            <div class="col-md-12">

                <form class="center" method="POST" role="form"
                    action="<?php echo base_url().'lo/guardar_calificacion_argument_aux/'
                    .$lo_id.'/'.$rep_id.'/'.$url.'/'.$title.'/'
                    .$argument.'/'.$argument_type.'/'.$argument_code.'/'.$argument_number.'/'
                    .$argument1.'/'.$argument_type1.'/'.$argument_code1.'/'.$argument_number1.'/'
                    .$argument2.'/'.$argument_type2.'/'.$argument_code2.'/'.$argument_number2.'/'
                    .$argument3.'/'.$argument_type3.'/'.$argument_code3.'/'.$argument_number3?>">
                    
<!--###################################################################################################################### -->
<!--------------------------------------------ARGUMENTO 1-------------------------------------------------------------------->
<!--###################################################################################################################### -->

                    <div id="argumento1" class="col-md-12">

                        <h1 class="color-2">Argumento 1</h1>
                        <h2> <?php echo array_column($result,'argument')[0];?></h2><br/>

                        <center>
                        <fieldset class="line-space scheduler-border">
                            <legend class="scheduler-border">Que tal te parecio el recurso</legend>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <label class="not-bold not-mg"><input type="radio" id="accept1"
                                            name="evaluacion" value="Aceptar" required/>
                                        <p class="space not-line-break">Aceptar el recurso recomendado</p>
                                    </label><br/>

                                    <label class="not-bold not-mg"><input type="radio" id="refuse1"
                                            name="evaluacion" value="Rechazar" required/>
                                        <p class="space not-line-break">Rechazar el recurso recomendado</p>
                                    </label><br/>

                                    <?php
                                    if (array_column($result,'argument')[2]!=null){
                                        echo '<label class="not-bold not-mg"><input type="checkbox" id="other_argument1" value="Otro" /><p class="space not-line-break">Desea otra razón por la cual pensamos este recurso puede ser de su agrado</p></label><br/>';
                                    }
                                    ?>
                                    <!-- <label class="not-bold not-mg"><input type="checkbox" id="other_argument1"
                                            value="Otro" />
                                        <p class="space not-line-break">Desea otra razón por la cual pensamos este
                                            recurso puede ser de su agrado</p>
                                    </label><br/> -->
                                </div>
                            </div>
                            <input type="button" style="display:none;" value="Ver la otra explicación"
                                name="argument1" id="argument1" class="btn btn-info"><br />
                        </fieldset>
                        </center>
                        
                        <center>
                        <fieldset class="form-group line-space scheduler-border">
                            
                            <legend class="scheduler-border">Califique el recurso de 1 a 5 siendo 1 malo y 5 excelente</legend>
                            <label class="not-bold not-mg"><input type="radio" name="calificacion" 
                                    value="1" required/>
                                <p class="space not-line-break">1</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion" 
                                    value="2" required/>
                                <p class="space not-line-break">2</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion" 
                                    value="3" required/>
                                <p class="space not-line-break">3</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion" 
                                    value="4" required/>
                                <p class="space not-line-break">4</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion" 
                                    value="5" required/>
                                <p class="space not-line-break">5</p>
                            </label>
                        </fieldset>
                        </center>
                        
                        <center>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Deja tu comentario</legend>
                            <textarea name="comentarios" id="comentarios_1" rows="7" cols="60"
                                placeholder="Escribe aquí tus comentarios" required></textarea>
                        </fieldset> 
                        </center>

                        <input id="submit1" style="display:none;" type="submit" class="btn btn-info" value="Enviar">
                    </div>

<!--###################################################################################################################### -->
<!--------------------------------------------ARGUMENTO 2-------------------------------------------------------------------->
<!--###################################################################################################################### -->
                    
                    <div id="argumento2" style="display: none;">

                        <h1 class="color-2">Argumento 2</h1>
                        <h2> <?php echo array_column($result,'argument')[1];?></h2><br/>

                        <center>
                        <fieldset class="line-space scheduler-border">
                            <legend class="scheduler-border">Que tal te parecio el recurso</legend>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <label class="not-bold not-mg"><input type="radio" id="accept2"
                                            name="evaluacion2" value="Aceptar" />
                                        <p class="space not-line-break">Aceptar el recurso recomendado</p>
                                    </label><br/>

                                    <label class="not-bold not-mg"><input type="radio" id="refuse2"
                                            name="evaluacion2" value="Rechazar" />
                                        <p class="space not-line-break">Rechazar el recurso recomendado</p>
                                    </label><br/>

                                    <?php
                                    if (array_column($result,'argument')[2]!=null){
                                        echo '<label class="not-bold not-mg"><input type="checkbox" id="other_argument2" value="Otro" /><p class="space not-line-break">Desea otra razón por la cual pensamos este recurso puede ser de su agrado</p></label><br/>';
                                    }
                                    ?>

                                    <!-- <label class="not-bold not-mg"><input type="checkbox" id="other_argument2"
                                            value="Otro" />
                                        <p class="space not-line-break">Desea otra razón por la cual pensamos este
                                            recurso puede ser de su agrado</p>
                                    </label><br/> -->
                                </div>
                            </div>
                            <input type="button" style="display:none;" value="Ver la otra explicación"
                                name="argument2" id="argument2" class="btn btn-info"><br />
                        </fieldset>
                        </center>

                        <center>
                        <fieldset class="form-group line-space scheduler-border">
                            
                            <legend class="scheduler-border">Califique el recurso de 1 a 5 siendo 1 malo y 5 excelente</legend>
                            <label class="not-bold not-mg"><input type="radio" name="calificacion2"
                                    value="1" />
                                <p class="space not-line-break">1</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion2"
                                    value="2" />
                                <p class="space not-line-break">2</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion2"
                                    value="3" />
                                <p class="space not-line-break">3</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion2"
                                    value="4" />
                                <p class="space not-line-break">4</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion2"
                                    value="5" />
                                <p class="space not-line-break">5</p>
                            </label>
                        </fieldset>
                        </center>

                        <center>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Deja tu comentario</legend>
                            <textarea name="comentarios2" id="comentarios_2" rows="7" cols="60"
                                placeholder="Escribe aquí tus comentarios"></textarea>
                        </fieldset> 
                        </center>

                        <input id="submit2" style="display:none;" type="submit" class="btn btn-info" value="Enviar">
                    </div>

<!--###################################################################################################################### -->
<!--------------------------------------------ARGUMENTO 3-------------------------------------------------------------------->
<!--###################################################################################################################### -->
  
                    <div id="argumento3" style="display: none;">

                        <h1 class="color-2">Argumento 3</h1>
                        <h2> <?php echo array_column($result,'argument')[2];?></h2><br/>

                        <center>
                        <fieldset class="line-space scheduler-border">
                            <legend class="scheduler-border">Que tal te parecio el recurso</legend>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <label class="not-bold not-mg"><input type="radio" id="accept3"
                                            name="evaluacion3" value="Aceptar" />
                                        <p class="space not-line-break">Aceptar el recurso recomendado</p>
                                    </label><br/>

                                    <label class="not-bold not-mg"><input type="radio" id="refuse3"
                                            name="evaluacion3" value="Rechazar" />
                                        <p class="space not-line-break">Rechazar el recurso recomendado</p>
                                    </label><br/>

                                    <?php
                                    if (array_column($result,'argument')[3]!=null){
                                        echo '<label class="not-bold not-mg"><input type="checkbox" id="other_argument3" value="Otro" /><p class="space not-line-break">Desea otra razón por la cual pensamos este recurso puede ser de su agrado</p></label><br/>';
                                    }
                                    ?>
                                    <!-- <label class="not-bold not-mg"><input type="checkbox" id="other_argument3"
                                            value="Otro" />
                                        <p class="space not-line-break">Desea otra razón por la cual pensamos este
                                            recurso puede ser de su agrado</p>
                                    </label><br/> -->
                                </div>
                            </div>
                            <input type="button" style="display:none;" value="Ver la otra explicación"
                                name="argument3" id="argument3" class="btn btn-info"><br />
                        </fieldset>
                        </center>

                        <center>
                        <fieldset class="form-group line-space scheduler-border">
                            
                            <legend class="scheduler-border">Califique el recurso de 1 a 5 siendo 1 malo y 5 excelente</legend>
                            <label class="not-bold not-mg"><input type="radio" name="calificacion3"
                                    value="1" />
                                <p class="space not-line-break">1</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion3"
                                    value="2" />
                                <p class="space not-line-break">2</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion3"
                                    value="3" />
                                <p class="space not-line-break">3</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion3"
                                    value="4" />
                                <p class="space not-line-break">4</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion3"
                                    value="5" />
                                <p class="space not-line-break">5</p>
                            </label>
                        </fieldset>
                        </center>

                        <center>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Deja tu comentario</legend>
                            <textarea name="comentarios3" id="comentarios_3" rows="7" cols="60"
                                placeholder="Escribe aquí tus comentarios"></textarea>
                        </fieldset> 
                        </center>

                        <input id="submit3" style="display:none;" type="submit" class="btn btn-info" value="Enviar">
                    </div>

<!--###################################################################################################################### -->
<!--------------------------------------------ARGUMENTO 4-------------------------------------------------------------------->
<!--###################################################################################################################### -->
  
                    <div id="argumento4" style="display: none;">
                        
                        <h1 class="color-2">Argumento 4</h1>
                        <h2> <?php
                            if (array_column($result,'argument')[3]!=null){
                            echo array_column($result,'argument')[3];} else{echo "No tenemos más argumentos de porque te puede gustar este recurso";}
                            ?>
                        </h2><br/>

                        <center>
                        <fieldset class="line-space scheduler-border">
                            <legend class="scheduler-border">Que tal te parecio el recurso</legend>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <label class="not-bold not-mg"><input type="radio" id="accept4"
                                            name="evaluacion4" value="Aceptar" />
                                        <p class="space not-line-break">Aceptar el recurso recomendado</p>
                                    </label><br/>

                                    <label class="not-bold not-mg"><input type="radio" id="refuse4"
                                            name="evaluacion4" value="Rechazar" />
                                        <p class="space not-line-break">Rechazar el recurso recomendado</p>
                                    </label><br/>
                                </div>
                            </div>
                            <input type="button" style="display:none;" value="Ver la otra explicación"
                                name="argument4" id="argument4" class="btn btn-info"><br />
                        </fieldset>
                        </center>

                        <center>
                        <fieldset class="form-group line-space scheduler-border">
                            
                            <legend class="scheduler-border">Califique el recurso de 1 a 5 siendo 1 malo y 5 excelente</legend>
                            <label class="not-bold not-mg"><input type="radio" name="calificacion4"
                                    value="1" />
                                <p class="space not-line-break">1</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion4"
                                    value="2" />
                                <p class="space not-line-break">2</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion4"
                                    value="3" />
                                <p class="space not-line-break">3</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion4"
                                    value="4" />
                                <p class="space not-line-break">4</p>
                            </label><br />
                            <label class="not-bold not-mg"><input type="radio" name="calificacion4"
                                    value="5" />
                                <p class="space not-line-break">5</p>
                            </label>
                        </fieldset>
                        </center>

                        <center>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Deja tu comentario</legend>
                            <textarea name="comentarios4" id="comentarios_4" rows="7" cols="60"
                                placeholder="Escribe aquí tus comentarios"></textarea>
                        </fieldset> 
                        </center>

                        <input id="submit4" style="display:none;" type="submit" class="btn btn-info" value="Enviar">
                    </div>

<!--###################################################################################################################### -->
<!--------------------------------------------Fin argumentos-------------------------------------------------------------------->
<!--###################################################################################################################### -->
  
                </form>
            </div>

            <br/>
            <!-- Ver siguiente recurso recomendado -->
            <div id="other_lo" class="col-md-12" style="...">
                <center>
                    <form autocomplete="off" action="<?php echo base_url() ?>index.php/lo/recomendacion_global"
                        method="post" name="login" id="form-login">

                        <input id="next" type="submit" class="btn btn-info" value="Ver siguiente recurso recomendado">
                    </form>
                </center>
            </div>
            <br />
            <!-- Vizualización del objeto -->
            <div class="panel-body">
                <div class="row">
                    <center>
                        <iframe src="<?php echo array_column($result,'url')[0];?>" style="border:hidden;"
                            width="90%" height="600em"></iframe>
                    </center>
                </div>
            </div>
        </section>

        <div class="row" id="result"></div>
    </section>

</section>
<!--main content end-->

<!--script for this page-->
<script type="text/javascript" src="<?php echo base_url();?>asset/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

    $("input[name=evaluacion]").click(function () {
        if (!$('#other_argument1').is(':checked')){
            $("#submit1").show();
        }
    });
    $("#other_argument1").click(function () {
        $("#argument1").toggle("show");
        if ($('input[name=evaluacion]:checked').val()){
            $("#submit1").toggle("show");
        }else{
            $("#submit1").hide();
        }
    });
    // -----------------------------------------------------

    $("input[name=evaluacion2]").click(function () {
        if (!$('#other_argument2').is(':checked')){
            $("#submit2").show();
        }
        $("input[name=calificacion2]").prop('required', true);
        $("#comentarios_2").prop('required', true);
    });
    $("#other_argument2").click(function () {
        $("#argument2").toggle("show");
        if ($('input[name=evaluacion2]:checked').val()){
            $("#submit2").toggle("show");
        }else{
            $("#submit2").hide();
        }
    });
    // -----------------------------------------------------

    $("input[name=evaluacion3]").click(function () {
        if (!$('#other_argument3').is(':checked')){
            $("#submit3").show();
        }
        $("input[name=calificacion3]").prop('required', true);
        $("#comentarios_3").prop('required', true);
    });
    $("#other_argument3").click(function () {
        $("#argument3").toggle("show");
        if ($('input[name=evaluacion3]:checked').val()){
            $("#submit3").toggle("show");
        }else{
            $("#submit3").hide();
        }
    });
    // -----------------------------------------------------

    $("input[name=evaluacion4]").click(function () {
        if (!$('#other_argument4').is(':checked')){
            $("#submit4").show();
        }
        $("input[name=calificacion4]").prop('required', true);
        $("#comentarios_4").prop('required', true);
    });
    //no mostrar other argumet por ser el último 

// --------------------------------------------------------------------------------------------
    $("#argument1").click(function () {
        if ($('input[name=evaluacion]:checked').val() &&
            $('input[name=calificacion]:checked').val() &&
            $('#comentarios_1').val() != 0) {
             
            $("#argumento2").show();
            $("#argumento1").hide();
            window.location.href = "#main-content";
        } else {
            alert("Verifique que haya llenado toda la información");
        }

    });

    $("#argument2").click(function () {
        if ($('input[name=evaluacion2]:checked').val() &&
            $('input[name=calificacion2]:checked').val() &&
            $('#comentarios_2').val() != 0) {


            $("#argumento3").show();
            $("#argumento2").hide();
            window.location.href = "#main-content";
        } else {
            alert("Verifique que haya llenado toda la información");
        }
    });

    $("#argument3").click(function () {
        if ($('input[name=evaluacion2]:checked').val() &&
            $('input[name=calificacion2]:checked').val() &&
            $('#comentarios_3').val() != 0) {

            $("#argumento4").show();
            $("#argumento3").hide();
            window.location.href = "#main-content";
        } else {
            alert("Verifique que haya llenado toda la información");
        }
    });
</script>