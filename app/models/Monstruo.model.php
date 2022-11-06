<?php 
    class MonsterModel {
        private $db;
        private $columns;

        // if (isset ($_GET["orden"])&& isset($_GET["forma"])) {
        //     # code...
        // }
        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=Bestiario_TPE-Web2;charset=utf8', 'root', '');
            $this->columns = array('id', 'nombre', 'debilidad', 'descripcion', 'categoria');
        }

        public function getColumns(){
            return $this->columns;
        }

        public function getAll(){
            $query = $this->db->prepare('SELECT Monstruo.id, Monstruo.nombre, Monstruo.debilidad, Monstruo.descripcion, Categoria.nombre as categoria, Monstruo.imagen
                                        FROM Monstruo
                                        INNER JOIN Categoria ON (Monstruo.id_Categoria_fk=Categoria.id)');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function getAllOrderBy($order, $form= 'ASC'){
            $query = $this->db->prepare('SELECT Monstruo.id, Monstruo.nombre, Monstruo.debilidad, Monstruo.descripcion, Categoria.nombre as categoria
                                         FROM Monstruo
                                         INNER JOIN Categoria ON (Monstruo.id_Categoria_fk=Categoria.id)
                                         ORDER BY '.$order.' '.$form);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function get($id){
            $query = $this->db->prepare('SELECT Monstruo.id, Monstruo.nombre, Monstruo.debilidad, Monstruo.descripcion, Categoria.nombre as nombre2, Monstruo.imagen
                                        FROM Monstruo
                                        INNER JOIN Categoria ON (Monstruo.id_Categoria_fk=Categoria.id) WHERE Monstruo.id = (?)');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ); 
        }

        public function insert($nombre, $debilidad, $descripcion, $id_Categoria_fk, $imagen= null){
            $pathImg = null;
            if ($imagen){
                $pathImg = $this->uploadImage($imagen);
            }
            $query = $this->db->prepare('INSERT INTO Monstruo(nombre,debilidad, descripcion, id_Categoria_fk, imagen) VALUES (?,?,?,?,?)');
            $query->execute([$nombre, $debilidad, $descripcion, $id_Categoria_fk, $pathImg]);

            return $this->db->lastInsertId();
        }
        
        public function delete($id){
            $query = $this->db->prepare('DELETE FROM Monstruo where id= (?) ');
            $query->execute([$id]);
        }
        
        // public function getFilter($nombreCategoria){
        //     $query = $this->db->prepare('SELECT  Monstruo.id, Monstruo.nombre, Monstruo.debilidad, Monstruo.descripcion, Categoria.nombre as nombre2 FROM Monstruo
        //                                  INNER JOIN Categoria ON Monstruo.id_Categoria_fk=Categoria.id WHERE Categoria.nombre = (?)');
        //     $query->execute([$nombreCategoria]);
        //     return $query->fetchAll(PDO::FETCH_OBJ);
        // }

        // public function update($nombre, $debilidad, $descripcion, $id_Categoria_fk, $id, $imagen= null){
        //     $pathImg = null;
        //     if ($imagen){
        //         $pathImg = $this->uploadImage($imagen);
        //     }
        //     $query = $this->db->prepare('UPDATE Monstruo SET nombre=?, debilidad=?, descripcion=?, id_Categoria_fk=?, imagen=? WHERE id=?');
        //     $query->execute([$nombre, $debilidad, $descripcion, $id_Categoria_fk, $pathImg, $id]);
        // }

        private function uploadImage($imagen){
            $target = './images/' . uniqid() . '.jpg';
            move_uploaded_file($imagen, $target);
            return $target;
        }
    
    }
?>