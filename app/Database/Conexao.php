<?php


class Conexao {
   
   public static $instance;

   private function __construct() {
       //
   }

   public static function getConexao() {


        $host = 'localhost';
        $dbname = 'PHPtest';
        $user = 'root';
        $pass = '';
        
        try {
      
            if (!isset(self::$instance)) {
                self::$instance = new \PDO('mysql:host='.$host.';dbname=' . $dbname . ';options=\'--client_encoding=UTF8\'', $user, $pass);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(\PDO::ATTR_ORACLE_NULLS, \PDO::NULL_EMPTY_STRING);
            }
            
            return self::$instance;
        
        } catch (Exception $ex) {
            echo $ex.'<br>';
        }
        
   }

}