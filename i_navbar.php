<nav class="navbar navbar-inverse" role="navigation">
  <div class="navbar-inner">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand visible-xs" href="#">Menu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo MURL;?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
        <li><a href="./" target="_self">PAQUETES TOUR PERU</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Tour">TOUR <b class="caret"></b></a>
          <?php 
          /*$sql="Select * FROM tblprovincia";*/
          $sql = "Select t2.id AS provincia_id, t2.provincia, count(t1.id) as n_tours FROM tbltours as t1 INNER JOIN tblprovincia as t2 ON (t2.id = t1.id_provincia) WHERE t1.estado != 0 GROUP BY t1.id_provincia ORDER BY n_tours DESC";

          $query=mysql_query($sql,$link);
          echo '<ul class="dropdown-menu">';
          while($com=mysql_fetch_array($query)){
            $url_tour = 'tours/' . $com['provincia_id'] . '/' . url_amigable($com['provincia']) .'/';
            echo '<li><a href="' . $url_tour . '" target="_self">'.$com['provincia'].'</a></li>';
          }
          echo '</ul>';
          ?>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">ESTADIA <b class="caret"></b></a>
          <?php 
          $sql = "SELECT t2.id AS provincia_id, t2.provincia, COUNT(t1.id_hotel) AS n_hoteles FROM tblhotel AS t1 INNER JOIN tblprovincia AS t2 ON (t2.id = t1.id_provincia) WHERE t1.estado != 0 GROUP BY t1.id_provincia ORDER BY n_hoteles DESC";
          $query=mysql_query($sql,$link);
          echo '<ul class="dropdown-menu">';
          while($com=mysql_fetch_array($query)){
            $url_hotel = 'hoteles/' . $com['provincia_id'] . '/' . url_amigable($com['provincia']) .'/';
            echo '<li><a href="'.$url_hotel.'" target="_self">'.$com['provincia'].'</a></li>';
          }
          echo '</ul>';
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>