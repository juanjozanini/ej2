<?php
    require_once "modelos/conexion.php";
    class Autor{

        public function buscar(){
            $conexionClass = new Conexion();
            $conexion = $conexionClass->conectar();
            //Recibo variable de session que contiene la palabra de referecia a buscar
            $datos = $_SESSION['datoBuscar'];

                /*
                    Este archivo muestra una tabla con todos los autores que contengan
                    el valor de la variable $datos que existen en la base de datos,
                mostrando de cada uno su nombre y apellido junto a los
                    botones de modificar y eliminar, junto a todos estos datos esta presente
                    pero oculto en un input el ID de cada autor. Este ID será necesario para
                    realizar las operaciones posteriores de eliminar o modificar un autor.
                    */

            //Consulto los similares a $datos
            $consulta= "SELECT * FROM autor WHERE nombre LIKE '%$datos%' OR apellido LIKE '%$datos%' ";

            $resultado = $conexion->query($consulta);
            //Consigo la cantidad de autores a mostrar
            $cantRegistros = $resultado->num_rows;
            if($cantRegistros!=0){
                return $resultado;
            }
            else{
                //Devuelvo los autores encontrados
                return 0;
            }
            $conexion->close();
        }

        public function buscarX($id){
            $conexionClass = new Conexion();
            $conexion = $conexionClass->conectar();

            $consulta= "SELECT * FROM autor WHERE id_autor LIKE '%$id%'";

            $resultado = $conexion->query($consulta);
            //Consigo la cantidad de autores a mostrar
            $cantRegistros = $resultado->num_rows;
            if($cantRegistros==0){
                return 0;
            }else{
                //Devuelvo los autores encontrados
                return $resultado;
            }
            
            $conexion->close();
        }

        public function agregar($datos){
            $conexionClass = new Conexion();
            $conexion = $conexionClass->conectar(); //conecta en la base de datos
            $nombre = $datos["nombre"]; 
            $apellido = $datos["apellido"];
            $existencia = "SELECT * FROM autor WHERE apellido='$apellido' and nombre='$nombre'";
        
            if($verificacion = $conexion->query($existencia)){
                $numeroRegistros = mysqli_num_rows($verificacion);
                //echo "<script language='javascript'>alert(''.$numeroRegistros);</script>";
                if($numeroRegistros>0){
                    return 0;
                }else {
                    // si no existe el autor se procederá a insertarlo en la base de datos
                    $ingreso = "INSERT INTO autor (nombre,apellido)
                    VALUES ('$nombre','$apellido')";
                    $realizar_ingreso = $conexion->query($ingreso);
                
                    $existencia = "SELECT * FROM autor WHERE apellido='$apellido' and nombre='$nombre'";
                    if($verificacion = $conexion->query($existencia)){
                        $numeroRegistros  = mysqli_num_rows($verificacion);
                        if($numeroRegistros>0){
                            return 1;
                        }
                    }else {
                        return -1;
                    }
                    
                }
            }
            $conexion->close();
        }

        public function actualizar($autor){
            $conexionClass = new Conexion();
            $conexion = $conexionClass->conectar();
            //Inicialización y establecimientos de las variables
            $id_modificar = $autor["id"];
            $nuevoNombre  = $autor["nombre"];
            $nuevoApellido = $autor["apellido"];
          
    
            //Se establecen variables como null si se decidió mantener los datos del autor
            if($nuevoNombre == ""){
                $nuevoNombre = null;
            }
            
            if($nuevoApellido == ""){
                $nuevoApellido = null;
            }
            //Se comprueba si se desea cambiar el nombre si $nuevoNombre no es null
            if(isset($nuevoNombre)){
                $instruc = "UPDATE autor SET nombre='$nuevoNombre' WHERE id_autor='$id_modificar'";
                $ejecutar_query = $conexion->query($instruc);
                $verificacion = "SELECT * FROM autor WHERE nombre='$nuevoNombre' AND id_autor='$id_modificar'";
                $consulta = $conexion->query($verificacion);
                $res = $consulta->num_rows;
                if($res>0){
                    echo "<script language='javascript'>alert('Autor actualizado, se redireccionará al inicio :) ')</script>";
                }else{
                    echo "<script language'javascript'>alert('Error al actualizar, se redireccionará al inicio :(')</script>";
                }
            }
            //Se comprueba si se desea cambiar el apellido si $nuevoApellido no es null
            if(isset($nuevoApellido)){
                $instruc = "UPDATE autor SET apellido='$nuevoApellido' WHERE id_autor='$id_modificar'";
                $ejecutar_query = $conexion->query($instruc);
        
                $verificacion = "SELECT * FROM autor WHERE apellido='$nuevoApellido'";
                $consulta = $conexion->query($verificacion);
                $res = $consulta->num_rows;
                if($res>0){
                    echo "<script language='javascript'>alert('Autor actualizado, se redireccionará al inicio :) ')</script>";
                }else{
                    echo "<script language'javascript'>alert('Error al actualizar, se redireccionará al inicio :(')</script>";
                }
            
            }
            header('Location: index.php'); 
        }

        public function eliminar($id){
            $conexionClass = new Conexion();
            $conexion = $conexionClass->conectar();

            //Variable recibida por metodo post desde autor_mostrarTodos.php o desde autor_filtrado.php 	
            $id_eliminar = $id;
            $eliminar = "DELETE FROM autor WHERE id_autor='$id_eliminar'";
            $realizar_query = $conexion->query($eliminar);
            $busqueda = "SELECT * FROM autor WHERE id_autor = '$id_eliminar'";
            $verificacion = $conexion->query($busqueda);
            $res = $verificacion->num_rows;
            if($res <= 0){
                return 1;
            }
            else{
                return 0;
            }
            $conexion->close();
        }
    }
?>
