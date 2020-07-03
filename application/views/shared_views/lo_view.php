
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <br>
        <section class="panel">
            <header class="panel-heading">
               <?php echo base64_decode($lo_name);?></b>
            </header>
            <div class="panel-body">
                <div class="row">
<?php
                    echo base64_decode($url);
                   echo '<br>';

?>
                    <!-- Esto es una prueba de vizualización de el objeto 
                    <iframe src="http://froac.manizales.unal.edu.co/roap/control/download.php?id=638" style="border: none; " width="100%" height="800px"></iframe>
-->
                </div>
            </div>

            <form name="calificacion" method="post">

                <label>Califique el OA </label>
                <p>
                    <input type="radio" name="excelente" id="excelente">Excelente<br/>
                    <input type="radio" name="bueno" id="bueno">Bueno<br/>
                    <input type="radio" name="regular" id="regular">Regular<br/>
                    <input type="radio" name="malo" id="malo">Malo<br/>
                </p>


            </form>



        </section>



        <div class="row"  id="result">

        </div>
    </section>
</section>
<!--main content end-->
