<?php

echo '
<form action="controlador.php" method="post">
  <h1>Generador de pruebas tipo multiple choise</h1>
  <h3>Abajo ingrese el directorio de su archivo .yml con las preguntas</h3>
  <br></br>
  <div class="form-group">
    <label for="archivo">Directorio</label>
    <input type="text" class="form-control" id="archivo" name="archivo" placeholder="Ingrese el directorio">
  </div>

  <div class="form-group">
    <label for="materia">Materia</label>
    <input type="text" class="form-control" id="materia" name="materia" placeholder="Ingrese la materia">
  </div>
    <div class="form-group">
    <label for="temas">Cant. temas</label>
    <input type="text" class="form-control" id="canTemas" name="canTemas" placeholder="Ingrese la cant. de temas">
  </div>
  <div class="form-group">
    <label for="fecha">Fecha del examen</label>
    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="DD/MM/AA">
  </div>
  <button type="submit" >Enviar</button>
</form>
';
