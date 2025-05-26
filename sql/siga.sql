-- Tabela Fatec
create database siga;
use siga

CREATE TABLE fatec (
    id_fat INT PRIMARY KEY AUTO_INCREMENT,
    nome_fat VARCHAR(100) NOT NULL
);
 
-- Tabela Professor
CREATE TABLE professor (
    id_pro INT PRIMARY KEY AUTO_INCREMENT,
    nome_pro VARCHAR(100) NOT NULL,
    senha_pro VARCHAR(255) NOT NULL,
    email_pro VARCHAR(100) UNIQUE NOT NULL,
    rg_pro VARCHAR(20) UNIQUE NOT NULL,
    tempoHae INT
);
 
-- Tabela Matéria
CREATE TABLE materia (
    id_mat INT PRIMARY KEY AUTO_INCREMENT,
    nome_mat VARCHAR(100) NOT NULL,
    desc_mat VARCHAR(255)
);
 
-- Tabela Curso
CREATE TABLE curso (
    id_cur INT PRIMARY KEY AUTO_INCREMENT,
    nome_cur VARCHAR(100) NOT NULL,
    desc_cur VARCHAR(255)
);
 
-- Tabela MatériaCurso
CREATE TABLE materia_curso (
    id_matCur INT PRIMARY KEY AUTO_INCREMENT,
    idMat_matCur INT NOT NULL,
    idCur_matCur INT NOT NULL,
    semestre INT NOT NULL
);
 
-- Tabela CursoFatec
CREATE TABLE curso_fatec (
    id_curFat INT PRIMARY KEY AUTO_INCREMENT,
    idFat_curFat INT NOT NULL,
    idCur_curFat INT NOT NULL,
    idPro_curFat INT NOT NULL
);
 
-- Tabela MatériaCursoFatec
CREATE TABLE materia_curso_fatec (
    id_matCurFat INT PRIMARY KEY AUTO_INCREMENT,
    idCurFat_matCurFat INT NOT NULL,
    idMatCur_matCurFat INT NOT NULL,
    idPro_matCurFat INT NOT NULL
);
 
-- Chaves estrangeiras para materia_curso
ALTER TABLE materia_curso
ADD CONSTRAINT fk_materia_curso_materia
FOREIGN KEY (idMat_matCur) REFERENCES materia(id_mat);
 
ALTER TABLE materia_curso
ADD CONSTRAINT fk_materia_curso_curso
FOREIGN KEY (idCur_matCur) REFERENCES curso(id_cur);
 
-- Chaves estrangeiras para curso_fatec
ALTER TABLE curso_fatec
ADD CONSTRAINT fk_curso_fatec_fatec
FOREIGN KEY (idFat_curFat) REFERENCES fatec(id_fat);
 
ALTER TABLE curso_fatec
ADD CONSTRAINT fk_curso_fatec_curso
FOREIGN KEY (idCur_curFat) REFERENCES curso(id_cur);
 
ALTER TABLE curso_fatec
ADD CONSTRAINT fk_curso_fatec_professor
FOREIGN KEY (idPro_curFat) REFERENCES professor(id_pro);
 
-- Chaves estrangeiras para materia_curso_fatec
ALTER TABLE materia_curso_fatec
ADD CONSTRAINT fk_mcf_curso_fatec
FOREIGN KEY (idCurFat_matCurFat) REFERENCES curso_fatec(id_curFat);
 
ALTER TABLE materia_curso_fatec
ADD CONSTRAINT fk_mcf_materia_curso
FOREIGN KEY (idMatCur_matCurFat) REFERENCES materia_curso(id_matCur);
 
ALTER TABLE materia_curso_fatec
ADD CONSTRAINT fk_mcf_professor
FOREIGN KEY (idPro_matCurFat) REFERENCES professor(id_pro);

INSERT INTO fatec (nome_fat) VALUES
('FATEC São Paulo'),
('FATEC Campinas');

INSERT INTO professor (nome_pro, login_pro, senha_pro, email_pro, rg_pro, tempoHae) VALUES
('Carlos Silva', 'csilva', 'senha123', 'csilva@fatec.sp.gov.br', '12.345.678-9', 5),
('Ana Paula', 'apaula', 'senha456', 'apaula@fatec.sp.gov.br', '98.765.432-1', 8),
('Roberta Lima', 'rlima', 'senha789', 'rlima@fatec.sp.gov.br', '11.223.344-5', 3),
('João Mendes', 'jmendes', 'senhaabc', 'jmendes@fatec.sp.gov.br', '55.667.889-0', 10);

INSERT INTO materia (nome_mat, desc_mat) VALUES
('Banco de Dados', 'Modelagem, criação e administração de bancos de dados.'),
('Programação Web', 'Desenvolvimento front-end e back-end para aplicações web.'),
('Redes de Computadores', 'Configuração e manutenção de redes.'),
('Engenharia de Software', 'Processos e metodologias para desenvolvimento de software.');

INSERT INTO curso (nome_cur, desc_cur) VALUES
('Análise e Desenvolvimento de Sistemas', 'Formação em desenvolvimento de software e sistemas.'),
('Gestão Empresarial', 'Formação focada em gestão de negócios e administração.');

INSERT INTO materia_curso (idMat_matCur, idCur_matCur, semestre) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2);

INSERT INTO curso_fatec (idFat_curFat, idCur_curFat, idPro_curFat) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 1, 3),
(2, 2, 4);

INSERT INTO materia_curso_fatec (idCurFat_matCurFat, idMatCur_matCurFat, idPro_matCurFat) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 3, 2),
(2, 4, 2),
(3, 1, 3),
(4, 3, 4);