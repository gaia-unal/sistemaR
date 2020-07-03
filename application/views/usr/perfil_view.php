<?php foreach ($usr_all_data as $usr_data){} ?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="<?php echo base_url()?>asset/img/user.gif" alt="">
                              </a>
                              <h1><?php echo $usr_data['use_nombre'].' '.$usr_data['use_apellido']?></h1>
                              <p><?php echo $usr_data['use_email']?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="<?php echo base_url()?>usuario/mis_objetos"> <i class="icon-book"></i> Mis objetos</a></li>
                             <!-- <li><a href="profile-activity.html"> <i class="icon-rss-sign"></i> Noticias <span class="label label-danger pull-right r-activity">9</span></a></li>-->
                              <li><a href="<?php echo base_url()?>usuario/editar_usr"> <i class="icon-book"></i> Editar perfil</a></li>
                              <!--<li><a href="<?php echo base_url()?>usuario/estilos"> <i class="icon-edit"></i> Test de Estilos de Aprendizaje </a></li>>-->
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="panel-body bio-graph-info">
                              <h1>Acerca de mi</h1>
                              <div class="row">
                                  <div class="bio-row">
                                     <p><span>Nombres: </span> <?php echo $usr_data['use_nombre']?></p>
                                  </div>
                              
                                  <div class="bio-row">
                                     <p><span>Apellidos: </span> <?php echo $usr_data['use_apellido']?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Fecha de Nacimiento:</span> <?php echo $usr_data['use_stu_datebirth']?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email: </span> <?php echo $usr_data['use_email']?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Educación: </span> <?php echo $usr_data['use_level']?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Registro: </span> <?php echo $usr_data['use_fecha_registro']?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Rol: </span> <?php echo $usr_data['use_rol_nombre']?></p>
                                  </div>
                                  <div class="bio-row">
                                     <p><span>Estilo de Aprendizaje: </span> <?php echo $usr_data['use_ls_learningstyle']?></p>
                                  </div>
                                  <div class="bio-row">
                                     <p><span>Descripción del Estilo de Aprendizaje: </span> <?php echo $usr_data['use_ls_description']?></p>
                                  </div>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->