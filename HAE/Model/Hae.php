<?php
class Hae
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
    public function newHae($idProf, $idCurFat, $qtdHoras, $tipo, $dataIn, $dataFi, $meta, $obj, $jus, $rec, $res, $met)
    {
        $sql = "INSERT INTO projeto(id_professor, id_curFat, qtd_horas, tipo_hae, data_inicio, data_termino, metas, objetivos, justificativas, recursos, resultado_esperado, metodologia)
            VALUES (:id_professor, :id_curFat, :qtd_horas, :tipo_hae, :data_inicio, :data_termino, :metas, :objetivos, :justificativas, :recursos, :resultado_esperado, :metodologia)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id_professor', $idProf);
        $stmt->bindParam(':id_curFat', $idCurFat);
        $stmt->bindParam(':qtd_horas', $qtdHoras);
        $stmt->bindParam(':tipo_hae', $tipo);
        $stmt->bindParam(':data_inicio', $dataIn);
        $stmt->bindParam(':data_termino', $dataFi);
        $stmt->bindParam(':metas', $meta);
        $stmt->bindParam(':objetivos', $obj);
        $stmt->bindParam(':justificativas', $jus);
        $stmt->bindParam(':recursos', $rec);
        $stmt->bindParam(':resultado_esperado', $res);
        $stmt->bindParam(':metodologia', $met);

        return $stmt->execute();

    }
}
