<script>
    $("#form").hide();
</script>
<h5>Luego de cambiar tu contraseña la sesión sera cerrada, y tendras que volver a ingresar con tus nuevas credenciales.</h5>
<div class="col-lg-12" >
    <section class="panel" id="verify">
        <header class="panel-heading">
            Ingrese su contraseña actual
        </header>
        <div class="panel-body">
                <div class="form-group">
                    <input id="psswd_now" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="button" class="btn btn-info" id="verificar">Verificar</button>

        </div>
    </section>


    <section class="panel" id="form">
        <header class="panel-heading">
            Ingrese su nueva contraseña
        </header>
        <div class="panel-body">
            <form class="form-horizontal tasi-form" method="POST" id="form_pass" action="<?php echo base_url()?>index.php/usuario/upd_passwd/">
                <div class="form-group">
                    <input id="psswd_new1" type="password" class="form-control" id="exampleInputPassword1" placeholder="Nueva contaseña" required>
                </div>
                <div class="form-group">
                    <input id="psswd_new2" name="passwd_new" type="password" class="form-control" id="exampleInputPassword1" placeholder="Reescribela" required>
                </div>

                <input type="button" id="update" class="btn btn-success" value="Actualizar">
            </form>
        </div>
    </section>
</div>


<script>

    $("#verificar").click(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>index.php/usuario/verificar_passwd/",
            data: {passwd:$("#psswd_now").val()},
            success: function(datos) {
                if(datos == 1){
                    $("#verify").hide();
                    $("#form").show();
                }
            }
        });
    })

    $("#passwd").change(function(){
        if ($("#passwd").val().length < 6){
            alert("Su contraseña debe ser de minimo 6 caracteres!")
            $("#passwd").val("");
        }
    });

    $("#update").click(function(){
        if($("#psswd_new1").val().toString() != $("#psswd_new2").val().toString()){
            alert("Las contraseñas no coinciden")
            $("#psswd_new").val("")
        }else{
            $("#form_pass").submit();
        }
    });
</script>