-- Tabela sessão
CREATE TABLE IF NOT EXISTS TBSESSION (
    SESID VARCHAR(256) NOT NULL,
    SESINFO TEXT,
    SESIP VARCHAR(50) NOT NULL,
    SESACTIVE SMALLINT NOT NULL DEFAULT 1,
    SESDTCREATE TIMESTAMP NOT NULL,
    SESDTACTIVITY TIMESTAMP NOT NULL,
    CONSTRAINT pk_tbsession PRIMARY KEY (SESID),
    CONSTRAINT check_active CHECK (SESACTIVE = ANY(array[0,1]))
);
-- Tabela produto
CREATE TABLE IF NOT EXISTS TBPRODUTO (
    PROCODIGO INTEGER NOT NULL,
    PRODESCRICAO VARCHAR(100) NOT NULL,
    PROPRECO NUMERIC(17,2) NOT NULL,
    PROESTOQUE INTEGER,
    CONSTRAINT pk_tbproduto PRIMARY KEY(PROCODIGO)
);
-- Tabela cidade
CREATE TABLE IF NOT EXISTS TBCIDADE (
    CIDCEP VARCHAR(9) NOT NULL,
    CIDNOME VARCHAR(150) NOT NULL,
    CIDESTADO CHAR(2) NOT NULL,
    CONSTRAINT pk_tbcidade PRIMARY KEY(CIDCEP)
);
-- Tabela clientes
CREATE TABLE IF NOT EXISTS TBCLIENTE (
    CIDCEP VARCHAR(9) NOT NULL,
    CLICODIGO INTEGER NOT NULL,
    CLINOME VARCHAR(200) NOT NULL,
    CLIENDERECO VARCHAR(500) NOT NULL,
    CLISEXO SMALLINT NOT NULL,
    CLIDTNASC TIMESTAMP NOT NULL,
    CLISALDO NUMERIC(17,2),
    CLIATIVO SMALLINT NOT NULL,
    CONSTRAINT pk_tbcliente PRIMARY KEY(CLICODIGO),
    CONSTRAINT fk_tbcidade FOREIGN KEY(CIDCEP) REFERENCES TBCIDADE (CIDCEP),
    CONSTRAINT check_sexo CHECK (CLISEXO = ANY(array[1,2,3])),
    CONSTRAINT check_ativo CHECK (CLIATIVO = ANY(array[0,1]))
);
-- Tabela venda
CREATE TABLE IF NOT EXISTS TBVENDA (
    CLICODIGO INTEGER NOT NULL,
    PROCODIGO INTEGER NOT NULL,
    VENDATA TIMESTAMP NOT NULL,
    VENQTD SMALLINT NOT NULL,
    VENDTPAGTO TIMESTAMP,
    VENVALORPAGO NUMERIC(17, 2),
    CONSTRAINT pk_tbvenda PRIMARY KEY(CLICODIGO, PROCODIGO, VENDATA),
    CONSTRAINT fk_tbcliente FOREIGN KEY(CLICODIGO) REFERENCES TBCLIENTE (CLICODIGO),
    CONSTRAINT fk_tbproduto FOREIGN KEY(PROCODIGO) REFERENCES TBPRODUTO (PROCODIGO)
);
-- Tabela usuário
CREATE TABLE IF NOT EXISTS TBUSUARIO (
    CLICODIGO INTEGER NOT NULL,
    USUCODIGO INTEGER NOT NULL,
    USULOGIN VARCHAR(50) NOT NULL,
    USUSENHA VARCHAR(32) NOT NULL,
    USUEMAIL VARCHAR(100) NOT NULL,
    USUATIVO SMALLINT NOT NULL,
    USUTIPO SMALLINT NOT NULL,
    USUSENHAEXPIRACAO TIMESTAMP,
    USUTENTATIVALOGIN SMALLINT,
    CONSTRAINT pk_tbusuario PRIMARY KEY(USUCODIGO),
    CONSTRAINT fk_tbcliente FOREIGN KEY(CLICODIGO) REFERENCES TBCLIENTE (CLICODIGO),
    CONSTRAINT check_ativo CHECK (USUATIVO = ANY(array[0,1])),
    CONSTRAINT check_tipo CHECK (USUTIPO = ANY(array[1,2])),
    CONSTRAINT unique_login UNIQUE (USULOGIN),
    CONSTRAINT unique_email UNIQUE (USUEMAIL)
);