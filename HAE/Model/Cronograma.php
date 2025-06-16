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
    
    public function newCronograma($idProj, $mes, $atividade){
        $sql = "INSERT INTO cronograma(fkId_projeto, mes, atividade)
            VALUES (:idProj, :mes, :atividade)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':idProj', $idProj);
        $stmt->bindParam(':mes', $mes);
        $stmt->bindParam(':atividade', $atividade);

        return $stmt->execute();

    }

    public function updateCronograma($idCronograma, $mes, $atividade) {
    $sql = "UPDATE cronograma
            SET mes = :mes,
                atividade = :atividade
            WHERE id_cronograma = :idCronograma";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':mes', $mes);
    $stmt->bindParam(':atividade', $atividade);
    $stmt->bindParam(':idCronograma', $idCronograma);

    return $stmt->execute();
}

    public function getCronograma($idProj){
        $sql = "SELECT * FROM cronograma WHERE fkId_projeto = :idProj";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idProj', $idProj);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}