
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        
        <section class="panel">
            <header class="panel-heading">
                 Repositorios Federados en FROAC</b>
            </header>
            <div class="panel-body">
                <div class="row">
                    <?php
                    $i = 0;
                    foreach ($repos as $key) {
                        $i+=1;
                        ?>
                        <div class="col-lg-4">
                            <!--widget start-->
                            <aside class="profile-nav alt green-border">
                                <section class="panel">
                                    <div class="user-heading alt green-bg">
                                        <h1><?php echo $key['rep_name'] ?></h1>
                                        <p><?php echo $key['rep_affiliation'] ?></p>
                                    </div>

                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="<?php echo $key['rep_url'] ?>" target="blank"> <i class="icon-cloud"></i> Ver Sitio del Repositorio</a></li>
                                        <li><a href="javascript:;"> <i class="icon-file-text"></i> Estándar: <b><?php echo $key['rep_metadata_inf'] ?></b> </a></li>
                                        <li><a href="<?php echo base_url()?>repositorio/lo_rep/<?php echo $key['rep_id'] ?>"> <i class="icon-file-text-alt"></i> Cantidad de Objetos <span class="label label-info pull-right r-activity"><?php echo $key['rep_countoas']?></span></a></li>
                                        <li><a href="javascript:;"> <i class="icon-calendar"></i> Última Actualización: <b><?php echo $key['rep_lastupdate']?></b> </a></li>
                                        <?php
                                        $session_data = $this->session->userdata('logged_in');
                                            if ($this->session->userdata('logged_in'))
                                            {
                                                if ($session_data ['username'] == "admin")
                                                {?>
                                                    <li><a href="<?php echo base_url()?>repositorio/modificar_repo/<?php echo $key['rep_id'] ?>"> <i class="icon-file-text-alt"></i>Modificar </span></a></li>
                                                    <!-- el action  se le cambio la direccion para que actualizara-->
                                                    <form autocomplete="off" action="<?php echo base_url() ?>index.php/repositorio/actualizar_oas/" method="post" enctype="multipart/form-data">                                                        <input type="hidden" id="idrepository" name="idrepository" value="<?php echo $key['rep_id']; ?>" />
                                                        <input type="hidden" id="lastupdate" name="lastupdate" value="<?php echo $key['rep_lastupdate']; ?>" />
                                                        <input type="hidden" id="cadenaoai" name="cadenaoai" value="<?php echo $key['rep_host']; ?>" />
                                                        <input type="hidden" id="metadata" name="metadata" value="<?php echo $key['rep_metadata_inf']; ?>" />  
                                                        <?php if($key['rep_typerepository']!='roap'){?>
                                                        
                                                            <div  id="actualizaroa<?php echo $i; ?>">
                                                            <br>
                                                            <input type="radio" id="actualizar<?php echo $i; ?>" name="actualizar" value="1" checked="TRUE"/>Todo<br/> <br/>
                                                            <input type="radio" id="actualizar<?php echo $i; ?>" name="actualizar" value="2"/>Desde: <?php echo $key['rep_lastupdate'] ?> <br/><br/>
                                                            <input type="radio" id="actualizar<?php echo $i; ?>" name="actualizar" value="3"/>Rango de Fechas:<br/><br/>
                                                            <!-- SE CAMBIO EL TIPO DE TECT A DATE -->
                                                            Inicio:<input class="form-control" id="fechainicio"type="date"  value="" name="fechainicio" /><br/><br/>
                                                            <!-- SE CAMBIO EL TIPO DE TECT A DATE -->
                                                            Fin:&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-control" id="fechafin" type="date" value="" name="fechafin" />
                                                            <br/>
                                                            <!-- SE ELIMINO LA ETIQUETA DE IMAGEN PARA EL  BOTON Y SE LE AGREGO ACTUALIZAR -->
                                                            <button input class="btn btn-info pull-right r-activity" id="refreshbu" width="16px"  height="16px"  
                                                            type="submit" value="Guardar" class="alt_btn">ACTUALIZAR</button>
                                                           
                                                         
                                                            </div>
                                                    <?php }?>
                                                
                                                    </form>
                                                    </li>

                                                 <?php
                                                }
                                            }?>
                                    </ul>

                                </section>
                            </aside>
                            <!--widget end-->
                        </div>

                    <?php } ?>

                </div>
            </div>
        </section>



        <div class="row"  id="result">

        </div>
    </section>
</section>
<!--main content end-->