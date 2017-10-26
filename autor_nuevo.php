<?php
    require_once "controladores/autorController.php";
    
    $autor = new AutorController();
    $autor->guardarAutor();
?>
<link href="css/bootstrap.css" rel="stylesheet">
<div class="col-sm-6">
    <h2 >Datos de autor </h2>
    <form id="myForm" method="POST">
        <div class="input-group">
            <label>Apellido del autor:</label>
            <input type="text" class="form-control" name="apelAutor" placeholder="Apellido" value="">
        </div>
        <br>
        <div class="input-group">
            <label>Nombre del autor:</label>
            <input type="text" class="form-control" name="nomAutor" placeholder="Nombre"  value="">
        </div>
        <br>
        <div class="btn-group">
            <!-- Enviar El Formulario -->
            <button class="btn btn-success" type="submit" >Guardar</button>
        </div>
    </form>
</div>
