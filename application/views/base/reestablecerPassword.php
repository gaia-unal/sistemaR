<script>
    $(document).ready(function() {
        $("#formReestablecer").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'get',
                url: 'libraries/smtp/registroC.php?reestablecer',
                data: {
                    email: $("#email").val()
                },
                beforeSend: function() {
                    $("#coverDisplay").css({
                        "opacity": "1",
                        "width": "100%",
                        "height": "100%"
                    });
                },
                success: function(result) {
                    result = result.replace(/[\r\n]/g, "");
                    // alert("-->" + result);
                    // console.log(result);
                    if (result == "false") {
                        alert("El e-mail <<" + $("#email").val() + ">> no esta registrado en el sistema");
                        $("#email").attr('value', '');
                    } else {
                        alert("Se ha enviado un link de reestablecimiento de contraseña a: <<" + $("#email").val() + ">>");
                        location.href = 'main.php';
                    }
                    $("#coverDisplay").css({
                        "opacity": "0",
                        "width": "0",
                        "height": "0"
                    });

                },
                error: function(geterror) {
                    alert(geterror);
                }
            });
        });
    });

</script>


<div id="areaReestablecer"> 
    <fieldset id="registrousuario">
        <form id="formReestablecer" action="control/registroC.php?registrarse" method="post">
            <legend><?= $resetPassword ?></legend>            
            <p><i><?= $textResetPassword ?></i><p>
                <label for="pass"><?= $email ?>:</label>
                <input class="texto styleInput" id="email" name="email" type="email" size="20" maxlength="50" required/>

                <br /><br />

                <input  id="registroBotonenviar" class="defaultButton" name="insert" type="submit" value="<?= $submit ?>"   /> 
        </form> 
    </fieldset>
    <div id="asd"></div>
</div>
<style>
    #areaReestablecer{
        width: 80%;
        background: #EBEBEB;
        margin-left: auto;
        margin-right: auto;
        min-height:90%;
        padding: 1em;

    }


    #registrousuario {

        border:medium none;
        color:#333333;
        height:550px;
        padding:0 0 0 50px;
        width:515px;
        margin:auto;
    }

    #registrousuario legend {
        color:#333333;
        font-family:arial;
        font-size:21px;
        letter-spacing:-1px;
        padding-bottom:20px;
        padding-top:8px;
        
    }

    #registrousuario input.texto {
        background:#FFFFFF;
        border:medium none !important;
        color:#222;
        font-size:14px;
        height:24px;
        padding-bottom:0;
        padding-left:5px;
        padding-top:5px;
        width:420px;
        background: white url(vista/img/input-bg.gif) repeat-x;
    }

    #registrousuario textarea.areadetexto {
        background: #ffffff;
        width: 454px;
        height: 212px;
        border:none !important;
        padding-bottom:0;
        padding-left:5px;
        padding-top:5px;
        color:#666666;
        font-size:12px;
        font-family:arial,sans-serif;
    }

    #registrousuario label {
        display:block;
        font-family:arial,sans-serif;
        font-size:14px;
        padding:10px 0 3px;
    }



    #registrousuario .styleInput {
        background: white url(vista/img/input-bg.gif) repeat-x;
        color: #5A5A5A;
        padding: 0 7px;
        height: 25px;
        border: 1px solid silver;
        width: 150px;
        margin: 0;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: #B2B2B2 0 0 5px;
        box-shadow: #B2B2B2 0 0 5px;
    }


</style>