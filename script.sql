CREATE SCHEMA cybermoto;

USE cybermoto;

CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Coluna de ID
    nome VARCHAR(255) NOT NULL,        -- Nome do cliente
    cic VARCHAR(15) NOT NULL,          -- Número de identificação CIC
    telefone VARCHAR(15),              -- Número de telefone
    email VARCHAR(255)                 -- Endereço de e-mail
);

INSERT INTO cliente (nome, cic, telefone, email)
VALUES
    ('Isaac Asimov', '123.456.789-10', '61-123-4567', 'isaac@exemplo.com'),
    ('William Gibson', '987654321-11', '51-987-6543', 'william@exemplo.com'),
    ('Frank Herbert', '456.789.123-12', '11-456-7890', 'frank@exemplo.com');

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Coluna de ID
    nome VARCHAR(255) NOT NULL,        -- Nome do usuário
    nivel TINYINT NOT NULL,            -- Guarda o Nível de acesso do usuário: 1 = Cliente, 2 = Funcionário, 3 = Administrador
    email VARCHAR(255),                -- Endereço de e-mail
    senha VARCHAR(255)                 -- usar SHA-1 (gera um hash de 40 caracteres) para guardar a senha
);

INSERT INTO usuarios (nome, nivel, email, senha)
VALUES ('Mestre', 3, 'mestre@cybermoto.com', SHA1('@123'));

GRANT ALL PRIVILEGES ON cybermoto.* TO 'root'@'localhost';
     FLUSH PRIVILEGES;                 -- Garante as credenciais de acesso do usuário root ao cybermoto
