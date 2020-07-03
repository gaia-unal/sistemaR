<?php
if ($sess == 1) {
    $logged = 1;
}else $logged = 0;
?>
<link rel="stylesheet" href="<?php echo base_url()?>asset/raty/jquery.raty.css">
</script><script src="<?php echo base_url()?>asset/raty/jquery.raty.js"></script>
<div id="prueba"></div>
<div class="col-lg-12">

</div>

<div class="col-lg-9">
    <!-- page start-->
    <section class="panel">
        <header class="panel-heading">
            Resultados que incluyen todas las palabras <b>( <?php echo $palabras ?> )</b>
            <div id="prueba"></div>
        </header>
        <div class="panel-body">
            <?php
            #echo var_dump($result[0]);
            if (!empty($result[0])) {
                foreach ($result[0] as $key) {
                    $url = base64_encode($key['lo_location']);
                    $lo_name = base64_encode($key['lo_title']);
                    ?>
                    <div class="classic-search">

                        <p><a target="_blank" class="titulo" id="<?php echo $key['lo_id'] ?>" rep_id="<?php echo $key['rep_id'] ?>" logged="<?php echo $logged ?>" href="<?php echo base_url().'lo/load_lo/'.$url.'/'.$lo_name ?>"><?php echo $key['lo_title'] ?></a>
                        </p>
                        <div>
                            <b>Descripción: </b><?php echo $key['lo_description'] ?><br>
                            <b>Palabras claves: </b><?php echo $key['lo_keyword'] ?><br>
                            <a onclick="verMetadata('<?php echo $key['lo_id'] . '/' . $key['rep_id'] ?>')" class="btn btn-sm btn-info" data-toggle="modal" href="#dialog_medatada">
                                <li class="icon-eye-open"></li> Ver metadatos
                            </a>
                            &nbsp;
                            <!--<a onclick="verIndicadores('<?php echo $key['lo_id'] . '/' . $key['rep_id'] . '/' . $user; ?>','<?php echo $key['rank']?>')" class="btn btn-warning btn-sm" data-toggle="modal" href="#dialog_indicaores">
                                <li class="icon-eye-open"></li> Ver Indicadores
                            </a>-->
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                No hay resultados.
            <?php } ?>
        </div>
    </section>
    <section class="panel">
        <header class="panel-heading">
            Resultados que incluyen una o algunas de las palabras <b>( <?php echo $palabras ?> )</b>
        </header>
        <div class="panel-body">
            <?php
            $evitDatRep=true;

            if (!empty($result[1])) {
                foreach ($result[1] as $key) {
                    //si ya lo mostro entonces no se vuelve a mostrar
                    foreach ($result[0] as $mostrados ) {
                        if ($mostrados['lo_id']==$key['lo_id']) {
                            $evitDatRep=false;
                            break;
                        }else{
                            $evitDatRep=true;
                        }
                    }
                    if ($evitDatRep) {

                        ?>
                        <div class="classic-search">

                            <h4><a target="_blank" class="titulo" id="<?php echo $key['lo_id'] ?>" rep_id="<?php echo $key['rep_id'] ?>" logged="<?php echo $logged ?>" href="<?php echo base_url().'lo/load_lo/'.$url.'/'.$lo_name ?>"><?php echo $key['lo_title'] ?></a>
                            </h4>
                            <div>
                                <b>Descripción: </b><?php echo $key['lo_description'] ?><br>
                                <b>Palabras claves: </b><?php echo $key['lo_keyword'] ?><br>

                                <a onclick="verMetadata('<?php echo $key['lo_id'] . '/' . $key['rep_id'] ?>')" class="btn btn-sm btn-info" data-toggle="modal" href="#dialog_medatada">
                                    <li class="icon-eye-open"></li> Ver metadatos
                                </a>


                                &nbsp;
                                <!--<a onclick="verIndicadores('<?php echo $key['lo_id'] . '/' . $key['rep_id'] . '/' . $user; ?>','<?php echo $key['rank']?>')" class="btn btn-warning btn-sm" data-toggle="modal" href="#dialog_indicaores">
                                    <li class="icon-eye-open"></li> Ver Indicadores
                                </a>-->
                            </div>
                        </div>
                    <?php
                    }
                }
            } else {
                ?>
                No hay resultados.
            <?php } ?>

        </div>
    </section>
    <!-- page end-->
</div>
<!--<div class="col-lg-3" id="recomendacion">
    <script>
        //Script para mostrar recomendación
        $(document).ready(function(){
            $("#prueba").hide();
            $("#prueba").text("<?php echo urlencode($oasadaptados) ?>");
            $("#recomendacion").load("<?php echo base_url(); ?>index.php/lo/llenar_recomendacion/" + $("#prueba").text() + "");

        });



    </script>

</div>-->

<!-- Modal Metadata -->
<div class="modal fade" id="dialog_medatada"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Metadatos estandar LOM</h4>
            </div>

            <div class="modal-body" style="height: 450px; width: 700px;" id="dialog_metadata_result">
                <iframe src="" style="height: 450px; width: 500px;" class="insideiframe col-md-12" style="display: none">

                </iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal"  class="btn btn-success" type="button">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->


<!-- Modal indicadores -->
<div class="modal fade" id="dialog_indicaores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Indicadores</h4>
            </div>
            <div class="modal-body">

                <b>Ranking de busqueda: <a href="">(Que significa esto?)</a><br></b>
                <h4><span id="rank"></span></h4>
                <?php if ($logged == 1) { ?>
                    <b>Usted ha calificado este objeto:</b>
                    <div class="raty"  id="" rep_id="" data-score=""  username=""></div>
                <?php }else{ ?>
                    <b>Promedio de calificación de los usuarios:</b>
                    <div class="raty"  id="" rep_id="" data-score="5"  username=""></div>
                    Si desea calificar este objeto y agregarlo a su lista de favoritos, debe crear una cuenta e iniciar sesión!
                <?php }?>

                <!--<div id="dialog_inidicadores_result"></div>-->
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal"  class="btn btn-success" type="button">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->


<script type="text/javascript">


    function verMetadata(id) {
        $(".insideiframe").attr("src", "<?php echo base_url(); ?>index.php/lo/load_metadata/"+id);
        $(".insideiframe").show();

    }

    function verIndicadores(id,rank) {
        var res = id.split("/");

        var lo_id = res[0];
        var rep_id = res[1];
        var username = res[2];
        $("#dialog_inidicadores_result").load("<?php echo base_url(); ?>index.php/lo/load_indicadores/" + id);
        $("#rank").text(rank);
        <?php if ($logged == 1) { ?>
        $.post( "<?php echo base_url() ?>index.php/usuario/get_score/",{ username: username, lo_id: lo_id, rep_id:rep_id }).done(function( data ){
            // $.fn.raty.defaults.path = 'asset/raty/images/';
            $.fn.raty.defaults.path = '<?php echo base_url()?>asset/raty/images/';
            $(".raty").attr("id", lo_id).attr("rep_id", rep_id).attr("username", username).raty({
                score:data,
                cancel     : true,
                click : function(score, evt) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() ?>index.php/usuario/set_score",
                        data: {lo_id:this.id, rep_id:$(this).attr('rep_id'),
                            username:$(this).attr('username'), score:score},
                        success: function(datos) {
                        }
                    });
                }
            });
        });
        <?php }else{ ?>
        $.post( "<?php echo base_url() ?>index.php/lo/get_score_avg/",{lo_id: lo_id, rep_id:rep_id }).done(function( data ){

            $.fn.raty.defaults.path = '<?php echo base_url()?>asset/raty/images/';
            $(".raty").attr("id", lo_id).attr("rep_id", rep_id).raty({
                score:data,
                cancel     : true
            });
        });

        <?php }?>

    }


    $(".titulo").click(function() {//cargando datos de lo elegido en las opciones de las busquedas
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>index.php/lo/set_visita",
            data: "lo_id=" + this.id + "&rep_id=" + $(this).attr('rep_id') + "&logged=" + $(this).attr('logged') + "",
            success: function(datos) {
                // alert("Se guardaron los datos: " + datos);
            }
        });

    })


</script>



<!--$.fn.raty.defaults.path = '<?php #echo base_url() ?>asset/raty/images';

var temp = '<?php #echo base_url() ?>asset/raty/images';
