<?php
    namespace Models;
    class Country{
        protected static $conn;
        protected static $columnsTbl=['id_country','name_country,id_states'];
        private $id_country;
        private $name_country;
        private $id_states;
        public function __construct($args = []){
            $this->id_country = $args['id_country'] ?? '';
            $this->name_country = $args['name_country'] ?? '';
            $this->id_states = $args['id_states'] ?? '';
        }
        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO country ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            try {
                $stmt->execute($data);
                $response=[[
                    'id_country' => self::$conn->lastInsertId(),
                    'name_country' => $data['name_country'],
                    'id_states' => $data['id_states']
                ]];
            }catch(\PDOException $e) {
                return $sql . "<br>" . $e->getMessage();
            }
            return json_encode($response);
        }       
        public function loadAllData(){
            $sql = "SELECT id_country,name_country, id_states FROM country";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute();
            $country = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $country;
        }
        public function deleteData($id){
            $sql = "DELETE FROM country where id_country = :id";
            $stmt= self::$conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        public function updateData($data){
            $sql = "UPDATE country SET name_country = :name_country, id_states = :id_states where id_country = :id";
            $stmt= self::$conn->prepare($sql);
            $stmt->bindParam(':name_country', $data['name_country']);
            $stmt->bindParam(':id_states', $data['id_states']);
            $stmt->bindParam(':id', $data['id_country']);
            $stmt->execute();
        }
        public static function setConn($connBd){
            self::$conn = $connBd;
        }
        public function atributos(){
            $atributos = [];
            foreach (self::$columnsTbl as $columna){
                if($columna === 'id_country') continue;
                $atributos [$columna]=$this->$columna;
             }
             return $atributos;
        }
        public function sanitizarAttributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$conn->quote($value);
            }
            return $sanitizado;
        }
    }

?>