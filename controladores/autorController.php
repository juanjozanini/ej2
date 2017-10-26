<?php

    require_once "modelos/autor.php";
    
    class AutorController{

        public function ListarAutores(){
            //$respuesta = Autor::buscar();
            $respuesta = (new Autor)->buscar();
            if($respuesta!=null){
                return $respuesta;
            }else{
                echo "<script language='javascript'>alert('No existen autores')</script>";
            }
        }

        public function guardarAutor(){
            if(isset($_POST["nomAutor"]) && isset($_POST["apelAutor"])){
                
                $nombre = $_POST["nomAutor"]; 
                $apellido = $_POST["apelAutor"]; 
                $datos = array("nombre"=>$nombre, "apellido"=>$apellido);
                $res = Autor::agregar($datos);// crea instancia de la clase autor
                if($res>=0){
                    if($res==0){
                            //ya existe
                    
                        echo "<script language='javascript'>alert('El autor ya existe, no se puede ingresar un autor ya existente.');</script>";
                        echo "<script language='javascript'>window.location='index.php'</script>";
                    }
                    else{
                        //=1
                        echo "<script language='javascript'>alert('El autor se añadió correctamente.')</script>";
                        echo "<script language='javascript'>window.location='index.php'</script>";
                    }
                }else{
                    // = -1
                    echo "<script language='javascript'>alert('Error al añadir autor, intente nuevamente...')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }
            }

        }

        public function buscarAutor(){
            if(isset($_POST["id_a"])){
                $id = $_POST["id_a"];
                $res = Autor::buscarX($id);
                $array = $res->fetch_assoc();
                if($res==0){
                    echo "<script language='javascript'>alert('No existe')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }else{
                    return $array;
                }
            }
        }
        //no se usa porque no lo pude hacer andar llamando a la funcion desde la vista,
        //funciona con ajax y actualizarAutorX
        public function actualizarAutor(){
            if(isset($_POST["id_m"])){
                $id = $_POST["id_m"];
                $nombre = $_POST["nomAutor"]; 
                $apellido = $_POST["apelAutor"]; 
                $autorNuevo = array("id"=> $id,"nombre"=>$nombre, "apellido"=>$apellido);
               $res = (new Autor)->actualizar($autorNuevo);
                echo $res;
                if($res=0){
                    echo "<script language='javascript'>alert('Se actualizo correctamente el autor, se redireccionará a la página principal')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }else{
                    echo "<script language='javascript'>alert('No se pudo actualizar el autor, intente nuevamente')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }
                
            }
        }

        public function actualizarAutorX($datos){
                $res = Autor::actualizar($datos);
                echo $res;
        }

        public function eliminar(){
            if(isset($_POST['id_a'])){
                $idAutor = $_POST['id_a'];
                $res = Autor::eliminar($idAutor);
                if($res>0){
                    echo "<script language='javascript'>alert('Se elimino correctamente el autor, se redireccionará a la página principal')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }else{
                    echo "<script language='javascript'>alert('No se pudo eliminar el autor, intente nuevamente')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }
            }
        }

    }

?>

