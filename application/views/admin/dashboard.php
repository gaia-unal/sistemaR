<?php if($user){$sess = 1; $usr = $user;}else{ $sess = 0; $usr=0;} ?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <header class="panel-heading">
            Resumen de FROAC</b>
        </header>
<br>
        <div class="row state-overview" id="info">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>
                    <div class="value">
                        <p class="numeros">
                            <?php echo $total_user ?>
                        </p>

                        <p>Usarios</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="icon-sitemap"></i>
                    </div>
                    <div class="value">
                        <p class="numeros">
                            <?php echo $total_rep ?>
                        </p>

                        <p>Repositorios</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="icon-file-text"></i>
                    </div>
                    <div class="value">
                        <p class="numeros">
                            <?php echo $total_lo ?>
                        </p>

                        <p>Objetos</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="icon-check"></i>
                    </div>
                    <div class="value">
                        <p class="numeros">
                            <?php echo $total_lo_score ?>
                        </p>

                        <p>Objetos calificados</p>
                    </div>
                </section>
            </div>
        </div>

        <div class="row"  id="result">

        </div>
    </section>
</section>
<!--main content end-->
