<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>FROAC | Login</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url() ?>asset/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>asset/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo base_url() ?>asset/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url() ?>asset/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>asset/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">
            <form class="form-signin" action="<?php echo base_url()?>index.php/sesion" method="POST">
                <p class="form-signin-heading">Federación de Repositorios de Objetos de Aprendizaje Colombia <br><br>
                    <img src="<?php echo base_url() ?>asset/img/logo2.png" alt="aca pondre el texto :D" width="50"></p>
                <?php echo validation_errors(); ?>
                <?php echo form_open('sesion'); ?>
                <div class="login-wrap">
                    <input type="text" class="form-control" placeholder="Username" name="username" autofocus>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <label class="checkbox">
                        <input type="checkbox" value="remember-me"> Recordarme
                        <span class="pull-right">
                            <a data-toggle="modal" href="#myModal"> Olvide mi contraseña?</a>

                        </span>
                    </label>
                    <button class="btn btn-lg btn-login btn-block" type="submit">Iniciar Sesión</button>
                    <div class="registration" align="center">
                        No tienes una cuenta aun?<br>
                        <a class="" href="<?php echo base_url()?>usuario/registro">
                            Crear una nueva cuenta
                        </a>
                    </div><br>
                    <div class="registration" align="center">
                       
                        <a class="" href="<?php echo base_url()?>">
                            <li class="icon-reply"><b>Volver</b></li>
                        </a>
                    </div>

                </div>


            </form>

        </div>



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url() ?>asset/js/jquery.js"></script>
        <script src="<?php echo base_url() ?>asset/js/bootstrap.min.js"></script>


    </body>
</html>
