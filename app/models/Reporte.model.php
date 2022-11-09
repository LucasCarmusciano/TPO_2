<?php 
    class ReportModel {
        private $db;
        private $columns;

        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=Bestiario_TPE-Web2;charset=utf8', 'root', '');
            $this->columns = array('id', 'narrador', 'historia', 'agresividad', 'monstruo');
        }

        public function getColumns(){
            return $this->columns;
        }

        public function getAll(){
            $query = $this->db->prepare('SELECT Reporte.id, Reporte.narrador, Reporte.historia, Reporte.agresividad, Monstruo.nombre as monstruo
                                        FROM Reporte
                                        INNER JOIN Monstruo ON (Reporte.id_Monstruo_fk=Monstruo.id)');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function getAllOrderBy($order, $direction= 'ASC'){
            $query = $this->db->prepare('SELECT Reporte.id, Reporte.narrador, Reporte.historia, Reporte.agresividad, Monstruo.nombre as monstruo
                                        FROM Reporte
                                        INNER JOIN Monstruo ON (Reporte.id_Monstruo_fk=Monstruo.id)
                                        ORDER BY '.$order.' '.$direction);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function getFilter($nombreMonstruo){
            $query = $this->db->prepare('SELECT Reporte.id, Reporte.narrador, Reporte.historia, Reporte.agresividad, Monstruo.nombre as monstruo
                                        FROM Reporte
                                        INNER JOIN Monstruo ON (Reporte.id_Monstruo_fk=Monstruo.id) WHERE Monstruo.nombre = (?)');
            $query->execute([$nombreMonstruo]);
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function getFilterOrderBy($nombreMonstruo, $order, $direction= 'ASC'){
            $query = $this->db->prepare('SELECT Reporte.id, Reporte.narrador, Reporte.historia, Reporte.agresividad, Monstruo.nombre as monstruo
                                        FROM Reporte
                                        INNER JOIN Monstruo ON (Reporte.id_Monstruo_fk=Monstruo.id) WHERE Monstruo.nombre = (?)
                                        ORDER BY '.$order.' '.$direction);
            $query->execute([$nombreMonstruo]);
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function get($id){
            $query = $this->db->prepare('SELECT Reporte.id, Reporte.narrador, Reporte.historia, Reporte.agresividad, Monstruo.nombre as monstruo
                                        FROM Reporte
                                        INNER JOIN Monstruo ON (Reporte.id_Monstruo_fk=Monstruo.id) WHERE Reporte.id = (?)');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
        }
        
        public function insert($narrador, $historia, $agresividad, $id_Monstruo_fk){
            $query = $this->db->prepare('INSERT INTO Reporte(narrador, historia, agresividad, id_Monstruo_fk) VALUES (?,?,?,?)');
            $query->execute([$narrador, $historia, $agresividad, $id_Monstruo_fk]);

            return $this->db->lastInsertId();
        }
        
        public function delete($id){
            $query = $this->db->prepare('DELETE FROM Reporte where id= (?) ');
            $query->execute([$id]);
        }
        

        public function update($narrador, $historia, $agresividad, $id_Monstruo_fk, $id){
            $query = $this->db->prepare('UPDATE Reporte SET narrador=?, historia=?, agresividad=?, id_Monstruo_fk=? 
                                        WHERE id=?');
            $query->execute([$narrador, $historia, $agresividad, $id_Monstruo_fk, $id]);
        }

        public function getIdMonstruoFk($monstruo){
            $query = $this->db->prepare('SELECT Reporte.id_Monstruo_fk
                                        FROM Reporte
                                        INNER JOIN Monstruo ON (Reporte.id_Monstruo_fk=Monstruo.id)
                                        WHERE Monstruo.nombre = (?)');
            $query->execute([$monstruo]);
            return $query->fetch(PDO::FETCH_OBJ);
        }
    }
?>