<?php
class Professor
{
    private $pdo;

    public function __construct()
    {
        try {
            require "../../lib/connSiga.php";
            $this->pdo = $connSiga;
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function getProf($login, $senha)
    {
        $sql = "SELECT id_pro, nome_pro FROM professor WHERE id_pro = :login and senha_pro = :senha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":senha", $senha);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCurProf($id)
    {
        $sql = "SELECT 
            m.nome_mat,
            c.nome_cur,
            id_matCurFat
            FROM materia_curso_fatec mcf
            JOIN materia_curso mc ON mcf.idMatCur_matCurFat = mc.id_matCur
            JOIN materia m ON mc.idMat_matCur = m.id_mat
            JOIN curso c ON mc.idCur_matCur = c.id_cur
            WHERE mcf.idPro_matCurFat = :idProf";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":idProf", $id);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUniCurProf($id, $idMat)
    {
        $sql = "SELECT 
            m.nome_mat,
            c.nome_cur,
            id_matCurFat
            FROM materia_curso_fatec mcf
            JOIN materia_curso mc ON mcf.idMatCur_matCurFat = mc.id_matCur
            JOIN materia m ON mc.idMat_matCur = m.id_mat
            JOIN curso c ON mc.idCur_matCur = c.id_cur
            WHERE mcf.idPro_matCurFat = :idProf
            AND mcf.id_matCurFat = :mat ;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":idProf", $id);
        $stmt->bindParam(":mat", $idMat);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getFormData($id){
        $sql = "SELECT nome_pro, email_pro, rg_pro, id_pro, tempoHae FROM professor WHERE id_pro = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function getCord($login, $senha)
    {
        $sql = "SELECT id_pro, nome_pro, idFat_curFat FROM professor p INNER JOIN curso_fatec on id_pro = idPro_curFat WHERE id_pro = :login and senha_pro = :senha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":senha", $senha);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFats($idProf, $idFat=FALSE){
        $sql = "SELECT DISTINCT f.id_fat, f.nome_fat
        FROM materia_curso_fatec mcf
        JOIN curso_fatec cf ON mcf.idCurFat_matCurFat = cf.id_curFat
        JOIN fatec f ON cf.idFat_curFat = f.id_fat
        WHERE mcf.idPro_matCurFat = :idPro";

        if($idFat){
            $sql .= "AND f.id_fat = :fat";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":idPro", $idProf);

        if($idFat){
            $stmt->bindParam(":fat", $idFat);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
