<link href="css/bootstrap.css" rel="stylesheet">
<div class="container" style="margin-left:-13px"> 
<div  class="col-sm-12 col-xs-12 col-md-12" style="margin-left:-13px">

<?php
                error_reporting(0);

                require_once "controladores/autorController.php";

                echo '<div style="margin-top:15px">';
                echo '<form id="myForm2" method="POST">';
                ?>
                <button class="btn-xs btn-success" type="submit" name="agregar" style="margin-left:0px" onclick="this.form.action='autor_nuevo.php'; this.form.submit()" >Agregar Autor</button>
                <?php
                echo '</form>';
                echo '</div>';

                $autor = new autorController();

                $resultado = $autor -> ListarAutores();

            ?>
                        <table class="table table-striped">
                        <thead>
                            <tr><!-- Fila -->
                                <th>Nombre</th>
                                <th>Apellido</th><!-- columna -->
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                    while($array = $resultado -> fetch_assoc()){?>
                                   <tr>
                                    <td>
                                    <?php   echo $array["nombre"];  ?> 
                                    </td>
                                    <td>
                                    <?php echo $array["apellido"]; ?>
                                     </td>
                                     <form method="POST">
                                     <td>
                                         <input type="hidden"  name="id_a" id="id_a" value="<?php echo $array["id_autor"]; ?>">
                                         <button class="btn-xs btn-warning" type="submit" name="modificar"  onclick="this.form.action='autor_update.php'; this.form.submit()">Modificar</button>
                                         <button class="btn-xs btn-danger" type="submit" name="borrar" onclick="this.form.submit()">Borrar</button>
                                    </td>
                                        </form>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                        </tbody>
                    </table>
            </div>
</div>
<?php $resultado = $autor -> eliminar(); ?>