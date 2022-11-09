<?php 
    class CategorieModel {
        private $db;

        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=Bestiario_TPE-Web2;charset=utf8', 'root', '');
            $this->columns = array('id', 'nombre', 'descripcion');
        }

        public function getColumns(){
            return $this->columns;
        }

        public function getAll(){
            $query = $this->db->prepare('SELECT * FROM Categoria');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function getAllOrderBy($order, $direction= 'ASC'){
            $query = $this->db->prepare('SELECT * FROM Categoria
                                         ORDER BY '.$order.' '.$direction);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function get($id){
            $query = $this->db->prepare('SELECT * FROM Categoria WHERE id = (?)');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
        }

        public function insert($nombre, $descripcion){
            $query = $this->db->prepare('INSERT INTO Categoria(nombre, descripcion) VALUES (?, ?)');
            $query->execute([$nombre, $descripcion]);
            return $this->db->lastInsertId();
        }
        
        public function delete($id){
            $query = $this->db->prepare('DELETE FROM Categoria where id= (?) ');
            $query->execute([$id]);
        }

        public function update($nombre, $descripcion, $id){
            $query = $this->db->prepare('UPDATE Categoria SET nombre=?, descripcion=? WHERE id=?');
            $query->execute([$nombre, $descripcion, $id]);
        }

    }
?>