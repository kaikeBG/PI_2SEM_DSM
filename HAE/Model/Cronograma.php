<?php
class Cronograma
{
    public $pdo;

    public function __construct()
    {
        try {
            require "../../lib/connHae.php";
            $this->pdo = $connHae;
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }
    
    public function newCronograma(){
        $sql = "";
    }
}