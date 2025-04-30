-- Tabela Professor
CREATE TABLE professor (
    id_professor INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    rg VARCHAR(20) NOT NULL,
    matricula VARCHAR(20) NOT NULL,
    hora_aula_semanal INT NOT NULL,
    tem_outras_fatecs BOOLEAN NOT NULL
);

-- Tabela Curso
CREATE TABLE Curso (
    id_curso INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);

-- Inserção dos cursos
INSERT INTO Curso (nome) VALUES ('CST em GPI');
INSERT INTO Curso (nome) VALUES ('CST em GE');
INSERT INTO Curso (nome) VALUES ('CST em DSM');

-- Tabela Projeto
CREATE TABLE Projeto (
    id_projeto INT PRIMARY KEY AUTO_INCREMENT,
    id_professor_projeto INT NOT NULL,
    tipo_hae ENUM('Estágio Supervisionado', 'Trabalho de Graduação') NOT NULL,
    data_inicio DATE NOT NULL,
    data_termino DATE NOT NULL,
    metas TEXT,
    objetivos TEXT,
    justificativas TEXT,
    recursos TEXT,
    resultado_esperado TEXT,
    metodologia TEXT
);

-- Tabela ProfessorCursoHAE
CREATE TABLE ProfessorCursoHAE (
    id_professor_curso INT PRIMARY KEY AUTO_INCREMENT,
    id_professor_hae INT NOT NULL,
    id_curso_hae INT NOT NULL,
    qtd_hae INT NOT NULL DEFAULT 0
);

-- Tabela Cronograma
CREATE TABLE Cronograma (
    id_cronograma INT PRIMARY KEY AUTO_INCREMENT,
    id_projeto_cronograma INT NOT NULL,
    mes INT(2) NOT NULL,
    atividade VARCHAR(255) NOT NULL
);

-- Tabela Submissao (histórico)
CREATE TABLE submissao (
    id_submissao INT PRIMARY KEY AUTO_INCREMENT,
    nome_professor VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    rg VARCHAR(20) NOT NULL,
    matricula VARCHAR(20) NOT NULL,
    hora_aula_semanal INT NOT NULL,
    tem_outras_fatecs INT(1) NOT NULL,
    tipo_hae VARCHAR(40) NOT NULL,
    inicio_projeto DATE NOT NULL,
    termino_projeto DATE NOT NULL,
    metas TEXT,
    objetivos TEXT,
    justificativas TEXT,
    recursos TEXT,
    resultado_esperado TEXT,
    metodologia TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela CargaCursos (histórico)
CREATE TABLE carga_cursos (
    id_carga_curso INT PRIMARY KEY AUTO_INCREMENT,
    id_submissao_curso INT NOT NULL,
    curso VARCHAR(25) NOT NULL,
    carga_horaria INT DEFAULT 0
);

-- Adicionar chaves estrangeiras após criação de todas as tabelas

-- Projeto -> Professor
ALTER TABLE Projeto
ADD CONSTRAINT fk_projeto_professor
FOREIGN KEY (id_professor_projeto) REFERENCES professor(id_professor);

-- ProfessorCursoHAE -> Professor
ALTER TABLE ProfessorCursoHAE
ADD CONSTRAINT fk_professor_hae
FOREIGN KEY (id_professor_hae) REFERENCES professor(id_professor);

-- ProfessorCursoHAE -> Curso
ALTER TABLE ProfessorCursoHAE
ADD CONSTRAINT fk_curso_hae
FOREIGN KEY (id_curso_hae) REFERENCES Curso(id_curso);

-- Cronograma -> Projeto
ALTER TABLE Cronograma
ADD CONSTRAINT fk_cronograma_projeto
FOREIGN KEY (id_projeto_cronograma) REFERENCES Projeto(id_projeto);

-- CargaCursos -> Submissao
ALTER TABLE carga_cursos
ADD CONSTRAINT fk_carga_submissao
FOREIGN KEY (id_submissao_curso) REFERENCES submissao(id_submissao);

-- Cronograma (histórico) -> Submissao
ALTER TABLE cronograma
ADD CONSTRAINT fk_cronograma_submissao
FOREIGN KEY (id_submissao_cronograma) REFERENCES submissao(id_submissao);