<form class="form-vertical" name="buscador" id="buscador" action="tours/" method="post">
 <fieldset class="form-home">
  <div class="form-group">
    <label>Inicio de Tour desde Lima - Perú</label>
    <div class="input-group date">
      <input type="text" class="form-control" name="fecha_inicio" id="date_from" value="" >
      <span class="input-group-addon">
        <a href="#" id="fecha_inicio_show">
          <!-- <span class="glyphicon glyphicon-calendar"></span> -->
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
      </span>
    </div>
  </div>

  <div class="form-group">
    <label>Fin de Tour desde Lima - Perú</label>
    <div class="input-group date">
      <input type="text" class="form-control" name="fecha_fin" id="date_to" value="">
      <span class="input-group-addon">
        <a href="#" id="fecha_fin_show">
          <!-- <span class="glyphicon glyphicon-calendar"></span> -->
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
      </span>
    </div>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Nacionalidad</label>
    <input type="text" id="nacionalidad" name="nacionalidad" class="form-control">
  </div>

  <div class="row">
    <div class="col-xs-3">
      <label class="text-center btn-block">Adultos</label>
      <select name="adultos" id="adultos" class="form-control" placeholder="+18 años">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <p class="help-block text-center">+18 años.</p>
    </div>

    <div class="col-xs-3">
      <label class="text-center btn-block">Adolecentes</label>
      <select name="adolecentes" id="adolecentes" class="form-control" placeholder="12-17">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <p class="help-block text-center">12-17</p>
    </div>

    <div class="col-xs-3">
      <label class="text-center btn-block">Ñiños</label>
      <select name="ninios" id="ninios" class="form-control" placeholder="8-11">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <p class="help-block text-center">8-11</p>
    </div>

    <div class="col-xs-3">
      <label class="text-center btn-block">Infantes</label>
      <select name="infantes" id="infantes" class="form-control" placeholder="3-7">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <p class="help-block text-center">3-7</p>
    </div>
  </div>

  <div class="row mrg-bot-15">
    <div class="col-md-12">
      <label>¿Con Estadia?</label> &nbsp;&nbsp;&nbsp;
      <label class="radio-inline">
        <input type="radio" name="estadia" id="estadia1" value="Si" checked> SI
      </label>
      <label class="radio-inline">
        <input type="radio" name="estadia" id="estadia2" value="No"> NO
      </label>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-12">
      <button id="buscar" class="btn btn-primary-1 btn-block" type="submit"><i class="fa fa-search" aria-hidden="true"></i> BUSCAR TOUR</button>
    </div>
  </div>
</fieldset>
</form>