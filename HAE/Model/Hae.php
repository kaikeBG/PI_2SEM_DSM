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
            $sql = "INSERT INTO projeto(id_professor, id_curFat, qtd_horas, tipo_hae, data_inicio, data_termino, metas, objetivos, justificativas, recursos, resultado_esperado, metodologia, data_submissao)
                VALUES (:id_professor, :id_curFat, :qtd_horas, :tipo_hae, :data_inicio, :data_termino, :metas, :objetivos, :justificativas, :recursos, :resultado_esperado, :metodologia, NOW())";

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

            $stmt->execute();

            return $this->pdo->lastInsertId();

        }
        public function editHae($idProjeto, $idProf, $idCurFat, $qtdHoras, $tipo, $dataIn, $dataFi, $meta, $obj, $jus, $rec, $res, $met)
        {
            $sql = "UPDATE projeto
            SET id_professor = :id_professor,
                id_curFat = :id_curFat,
                qtd_horas = :qtd_horas,
                tipo_hae = :tipo_hae,
                data_inicio = :data_inicio,
                data_termino = :data_termino,
                metas = :metas,
                objetivos = :objetivos,
                justificativas = :justificativas,
                recursos = :recursos,
                resultado_esperado = :resultado_esperado,
                metodologia = :metodologia,
                estado = 0, retorno = null
            WHERE id_projeto = :id_projeto";

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
            $stmt->bindParam(':id_projeto', $idProjeto);
            
            return $stmt->execute();

        }

        public function getHae($id = FALSE){
            $sql = "SELECT * FROM projeto ";
            if($id){
                $sql .= "where id_professor = :id";
            }
            $stmt = $this->pdo->prepare($sql);
            if($id){
                $stmt->bindParam(":id", $id);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getOneHae($id = FALSE){
            $sql = "SELECT * FROM projeto ";
            if($id){
                $sql .= "where id_projeto = :id";
            }
            $stmt = $this->pdo->prepare($sql);
            if($id){
                $stmt->bindParam(":id", $id);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function retornoHae($idProj, $status, $retorno){
            $sql = "UPDATE projeto SET retorno = :ret, estado = :std WHERE id_projeto = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(":id", $idProj);
            $stmt->bindParam(":std", $status);
            $stmt->bindParam(":ret", $retorno);

            $stmt->execute();

        }
    }
