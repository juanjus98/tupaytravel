<?php
/*echo "<pre>";
print_r($slider);
echo "</pre>";*/
?>
<section>
  <div class="linea-top"><!--Linea amarilla--></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clear-padd">
        <?php
        if(!empty($slider)){
        ?>
        <div class="cont_slide_1">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <?php
              $ii=0;
              foreach ($slider as $key => $value) {
                $ii++;
                $image_url = base_url('images/uploads/' . $value['imagen_1']);
              ?>
              <div class="item <?php echo $active = ($ii==1) ? 'active' : '';?>">
                <img src="<?php echo $image_url;?>" alt="<?php echo $value['titulo1'];?>">
              </div>
              <?php
              }
              ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div><!--//cont_slide_1-->
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>