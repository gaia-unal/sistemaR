<?php
if ($sess == 1) {
    $logged = 1;
}else $logged = 0;
?>
<link rel="stylesheet" href="<?php echo base_url()?>asset/raty/jquery.raty.css">
</script><script src="<?php echo base_url()?>asset/raty/jquery.raty.js"></script>
<section id="main-content">
    <section class="wrapper">

<div class="col-lg-12">
    <!-- page start-->
    <section class="panel">
        <header class="panel-heading">
            <a href="<?php echo base_url().$url?>"><button type="button" class="btn btn-success btn-sm"><li class="icon-reply"><b> Volver</b></li></button></a> <?php echo $encabezado?>: </b>
            <div id="prueba"></div>
        </header>
        <div class="panel-body">
            <?php
            if (!empty($result)) {
                foreach ($result as $key) {
                    $url = base64_encode($key['lo_location']);
                    $lo_name = base64_encode($key['lo_title']);
                    ?>
                    <div class="classic-search">

                        <p><a target="_blank" class="titulo" id="<?php echo $key['lo_id'] ?>" rep_id="<?php echo $key['rep_id'] ?>" logged="<?php echo $logged ?>" href="<?php echo base_url().'lo/load_lo/'.$url.'/'.$lo_name ?>"><?php echo $key['lo_title'] ?></a>
                        </p>
                        <div>
                            <b>Descripción: </b><?php echo $key['lo_description'] ?><br>
                            <b>Palabras claves: </b><?php echo $key['lo_keyword'] ?><br>

                            <a onclick="verMetadata('<?php echo $key['lo_id'] . '/' . $key['rep_id'] ?>')" class="btn btn-sm btn-info" data-toggle="modal" href="#dialog_medatada" txt="OA1">
                                <li class="icon-eye-open"></li> Ver metadatos
                            </a>
    
                          <!--  <a onclick="verIndicadores('<?php echo $key['lo_id'] . '/' . $key['rep_id'] . '/' . $user; ?>','<?php echo $key['rank']?>')" class="btn btn-warning btn-sm" data-toggle="modal" href="#dialog_indicaores" txt="OA2">
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
    <!-- page end-->
</div>
    </section>
</section>
<!-- Modal Metadata -->
<div class="modal fade" id="dialog_medatada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Metadatos estandar LOM</h4>
            </div>

            <div class="modal-body" id="dialog_metadata_result">

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

                <?php if ($logged == 1) { ?>
                    <b>Usted ha calificado estre objeto:</b>
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
        $("#dialog_metadata_result").load("<?php echo base_url(); ?>index.php/lo/load_metadata/" + id);

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

        <?php }?>;
    }


    $(".titulo").click(function() {
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