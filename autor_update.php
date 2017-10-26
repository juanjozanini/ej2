<?php
error_reporting(0);

    require_once "controladores/autorController.php";
    $autor = new AutorController();
    $resultado = $autor->buscarAutor();
        
?>
<link href="css/bootstrap.css" rel="stylesheet">

<div class="container">
<div class="col-sm-6">
    <h2 >Datos de autor </h2>
    <form id="myForm" method="POST">
        <input type="hidden"  name="id_m" value="<?php echo $resultado["id_autor"];?>">
        
        <div class="input-group">
            <label>Apellido del autor: </label>
            <input type="text" class="form-control" name="apelAutor" placeholder="Apellido" value="<?php  echo $resultado["apellido"];?>"><!-- si cambio type a number solo ingresa numeros puede ser pasword, text, checkbox, email -->
        </div>
        <br>
        <div class="input-group">
            <label>Nombre del autor:</label>
            <input type="text" class="form-control" name="nomAutor" placeholder="Nombre"  value="<?php  echo $resultado["nombre"]; ?>">
        </div>
        <br>
        <div class="btn-group">
            <!-- Enviar El Formulario -->
            <input class="btn btn-warning" type="submit" name="guardar" value="Guardar" onclick="this.form.submit()"><!-- pa el bboton btn btn-succes , warning etc-->
        </div>
    </form>
</div>
</div>
<?php 
     $autor = $autor->actualizarAutor();
?>