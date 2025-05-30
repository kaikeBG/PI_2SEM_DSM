-- Criação do banco CEOS
CREATE DATABASE IF NOT EXISTS CEOS;
USE CEOS;

 
-- Tabela Projeto
CREATE TABLE projeto (
    id_projeto INT PRIMARY KEY AUTO_INCREMENT,
    id_professor INT NOT NULL,
    id_curFat INT NOT NULL,
    qtd_horas INT NOT NULL,
    tipo_hae VARCHAR(20) NOT NULL,
    data_inicio DATE NOT NULL,
    data_termino DATE NOT NULL,
    metas VARCHAR(255),
    objetivos VARCHAR(255),
    justificativas VARCHAR(255),
    recursos VARCHAR(255),
    resultado_esperado VARCHAR(255),
    metodologia VARCHAR(255),
    estado INT DEFAULT 0,
    data_submissao TIMESTAMP NULL
);
 
-- Tabela Cronograma
CREATE TABLE cronograma (
    id_cronograma INT PRIMARY KEY AUTO_INCREMENT,
    fkId_projeto INT NOT NULL,
    mes INT(2) NOT NULL,
    atividade VARCHAR(255) NOT NULL,
    concluido BOOLEAN DEFAULT FALSE,
    data_conclusao DATE NULL
);

CREATE TABLE relatorio (
    id_relatorio INT PRIMARY KEY AUTO_INCREMENT,
    fkId_Projeto INT NOT NULL,
    data_relatorio DATE NOT NULL,
    descricao VARCHAR(255) NOT NULL
);
 
-- Chave estrangeira para cronograma
ALTER TABLE cronograma
ADD CONSTRAINT fk_cronograma_projeto
FOREIGN KEY (fkId_projeto) REFERENCES projeto(Id_projeto);

-- Chave estrangeira para cronograma
ALTER TABLE relatorio
ADD CONSTRAINT fk_relatorio_projeto
FOREIGN KEY (fkId_projeto) REFERENCES projeto(id_projeto);