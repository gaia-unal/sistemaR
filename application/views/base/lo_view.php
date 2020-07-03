
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

                    <!-- Esto es una prueba de vizualización de el objeto -->
                    <center>
                                            <iframe src="<?php echo base64_decode($url);?>" style="aling:center; border:hidden;" width="90%" height="600em"></iframe>

                    </center>

                </div>
            </div>
        </section>

       <center> <form method="POST" role="form" action="<?php echo base_url().'lo/guardar_calificacion/'.$lo_id.'/'.$rep_id?>">

            <label>Califique el OA de 1 a 5 siendo 1 malo y 5 excelente</label>
            <p>
               <div class="form-group">
                   <input  type="radio" class="form-control"  name="calificacion" value="1"/>1
                   <input  type="radio" class="form-control"  name="calificacion" value="2"/>2
                   <input  type="radio" class="form-control"  name="calificacion" value="3"/>3
                   <input  type="radio" class="form-control"  name="calificacion" value="4"/>4
                   <input  type="radio" class="form-control"  name="calificacion" value="5"/>5

               </div>

            </p>
               <textarea name="comentarios" id="comentarios" rows="10" cols="40" placeholder="Escribe aquí tus comentarios"></textarea><br/><br/>
               <input id="submit" type="submit" class="btn btn-info" value="Guardar Información">

        </form></center>


        <div class="row"  id="result">

        </div>
    </section>
</section>
<!--main content end-->
