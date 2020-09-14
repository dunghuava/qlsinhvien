<?php 
 class database{

     protected $db = ''; 
     protected $host = '';
     protected $user = '';
     protected $password = '';
     protected $database = '';
     protected $sql = '';
     protected $table = '';
     protected $refix ='';
     protected $where = '';

     function database($config = array())
     {
         if(!empty($config))
         {
             $this->init($config);
             $this->connect();
         }
     }
     function setTable($str)
     {
         $this->table = $str;
     }
     function init($config = array()){
        foreach($config as $k=>$v)
            $this->$k = $v;
     }
     function connect(){
         try {
             $this->db = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->user, $this->password);
             $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $this->db->exec("set names utf8");
         }
         catch(PDOException $e){
             echo "Connection failed: " . $e->getMessage();
         }
     }
     function insert($data = array())
     {
         $into = "";
         $values = "";
         foreach ($data as $int => $val) {
             $into .= ",".$int;
             $values .= ",'".$val."'";
         }
         if($into{0} == ",") $into{0} = "(";
         $into .=")";
         if($values{0} == 0) $values{0} = "(";
         $values .= ")";

         $this->sql = "insert into ".$this->table.$into." values ".$values;			
         $this->sql = str_replace('#_', $this->refix, $this->sql);

         $stmt = $this->db->prepare($this->sql); 
         $stmt->execute();
         return $this->db->lastInsertId();
     }
     function reset(){
        $this->sql='';
        $this->table='';
        $this->where='';
     }
     function update($data = array())
     {
         $values = "";
         foreach ($data as $col => $val) {
             $values .= ",".$col." = '".$val."' ";
         }
         if($values{0} == ",") $values{0} = " ";
         $this->sql = "update ".$this->table." set ".$values.$this->where;

         $this->sql = str_replace('#_', $this->refix, $this->sql);
         $this->result = $this->query($this->sql);
         return $this->result;

     }
     function query($sql)
     {
         $this->sql = str_replace('#_', $this->refix, $sql);
         $stmt = $this->db->prepare($this->sql); 
         return $stmt->execute();
     }
     function setWhere($data = array())
     {
         foreach ($data as $key =>$val){
            $col = $key;
            $dk  = $val;
         }
         if($this->where == ""){
             $this->where = " where ".$col." = '".$dk."'";
         }
         else{
             $this->where .= " and ".$col." = '".$dk."'";
         }
     }
     function delete()
     {
         $this->sql = "delete from ".$this->table.$this->where;
         $this->sql = str_replace('#_', $this->refix, $this->sql);
         return $this->query($this->sql);
     }
     public function fetch()
     {

         $arr = array();
         $this->sql = str_replace('#_', $this->refix, $this->sql);
         $stmt = $this->db->prepare($this->sql); 
         $stmt->execute();
         return $stmt->fetchAll();
     }

     public function o_fet($sql){
         $this->sql = $sql;
         return $this->fetch();
     }
     function disconnect()
     {
         $this->db = null;
     }
 }