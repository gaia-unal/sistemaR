
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <br>

                <div class="row">

                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Lista de ususarios en FROAC.
                            </header>
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th></i> Nombres</th>
                                    <th>Apellidos</th>
                                    <th>E-mail</th>
                                    <th>Fecha de registro</th>
                                    <th>Rol</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $key){?>
                                <tr>
                                    <td><?php echo $key["use_username"]?></td>
                                    <td><?php echo $key["use_nombre"]?></td>
                                    <td><?php echo $key["use_apellido"]?></td>
                                    <td><?php echo $key["use_email"]?></td>
                                    <td><?php echo $key["use_fecha_registro"]?></td>
                                    <td><?php echo $key["use_rol_nombre"]?></td>

                                    <td>
                                        <a href="<?php echo base_url().'admin/editar_usr/'.$key["use_username"]?>" alt="Editar"class="btn btn-warning btn-xs"><i class="icon-pencil"></i></a>
                                        <a data-toggle="modal" href="#delete_confirm" id="<?php echo $key["use_username"]?>" alt="Eliminar" class="delete btn btn-danger btn-xs"><i class="icon-trash "></i></a>
                                    </td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>




        <div class="row"  id="result">

        </div>
    </section>
</section>
<!--main content end-->
<!-- Modal indicadores -->
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">

                Esta a punto de eliminar al usuario <span id="username_modal"></span>

            <div class="modal-footer">
                <button id="ok_del" data-dismiss="modal"  class="btn btn-info" type="button">Aceptar</button>
                <button data-dismiss="modal"  class="btn btn-danger" type="button">Cancelar</button>

            </div>
        </div>
    </div>
</div>
<!-- modal -->
<script>

   $(".delete").click(function(){
       $("#username_modal").text(this.id)
       $("#ok_del").click(function(){
           window.location.href = '<?php echo base_url()?>admin/delete_usr/'+$("#username_modal").text();
       })
   })



</script>