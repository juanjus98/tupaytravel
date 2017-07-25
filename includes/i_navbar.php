<div class="menu-bar">
  <nav class="navbar navbar-default navbar-wa">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-nav-wa">
        <li class="active"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
        <li><a href="#">Paquetes Tour Perú</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tours <span class="caret"></span></a>
          <?php 
          $sql = "Select t2.id AS provincia_id, t2.provincia, count(t1.id) as n_tours FROM tbltours as t1 INNER JOIN tblprovincia as t2 ON (t2.id = t1.id_provincia) WHERE t1.estado != 0 GROUP BY t1.id_provincia ORDER BY n_tours DESC";

          $query=mysql_query($sql,$link);
          echo '<ul class="dropdown-menu">';
          while($com=mysql_fetch_array($query)){
            $url_tour = 'tours/' . $com['provincia_id'] . '/' . url_amigable($com['provincia']) .'/';

            echo '<li><a href="' . $url_tour . '" title"'.$com['provincia'].'">'.$com['provincia'].'</a></li>';
          }
          echo '</ul>';
          ?>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadia <span class="caret"></span></a>
          <?php 
          $sql = "SELECT t2.id AS provincia_id, t2.provincia, COUNT(t1.id_hotel) AS n_hoteles FROM tblhotel AS t1 INNER JOIN tblprovincia AS t2 ON (t2.id = t1.id_provincia) WHERE t1.estado != 0 GROUP BY t1.id_provincia ORDER BY n_hoteles DESC";
          $query=mysql_query($sql,$link);
          echo '<ul class="dropdown-menu">';
          while($com=mysql_fetch_array($query)){
            $url_hotel = 'hoteles/' . $com['provincia_id'] . '/' . url_amigable($com['provincia']) .'/';
            echo '<li><a href="'.$url_hotel.'" title="'.$com['provincia'].'">'.$com['provincia'].'</a></li>';
          }
          echo '</ul>';
          ?>
        </li>
      </ul>
      <div class="pull-right menu-r">
        <a href="contactenos" class="btn btn-contactenos"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contáctenos</a>
      </div>
    </div>
    <!-- /.navbar-collapse -->
  </nav>
</div>