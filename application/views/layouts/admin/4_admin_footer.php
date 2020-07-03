


    
      <!--footer start
      <footer class="site-footer">
          <div class="text-center">
              2014 | FROAC.
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo base_url()?>asset/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url()?>asset/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url()?>asset/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url()?>asset/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>asset/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>asset/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo base_url()?>asset/js/owl.carousel.js" ></script>
    <script src="<?php echo base_url()?>asset/js/jquery.customSelect.min.js" ></script>
    <script src="<?php echo base_url()?>asset/js/respond.min.js" ></script>

    <script class="include" type="text/javascript" src="<?php echo base_url()?>asset/js/jquery.dcjqaccordion.2.7.js"></script>

    <!--common script for all pages-->
    <script src="<?php echo base_url()?>asset/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url()?>asset/js/sparkline-chart.js"></script>
    <script src="<?php echo base_url()?>asset/js/easy-pie-chart.js"></script>
    <script src="<?php echo base_url()?>asset/js/count.js"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
