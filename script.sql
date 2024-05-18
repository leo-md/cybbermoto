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

CREATE TABLE veiculo (
    placa VARCHAR(15) NOT NULL PRIMARY KEY,  -- Coluna de ID
    marca VARCHAR(15) NOT NULL,              -- Marca do veículo
    modelo VARCHAR(255) NOT NULL,            -- modelo do veículo
    anoFabrica VARCHAR(4) NOT NULL,          -- Ano de fabricação do veículo
    anoModelo VARCHAR(4) NOT NULL,           -- Ano do modelo do veículo
    quilometragem INT,                       -- Quilometragem do veículo
    codCliente INT,                          -- Proprietário do veículo
    FOREIGN KEY (codCliente) REFERENCES cliente(id)
);

INSERT INTO veiculo (marca, modelo, anoFabrica, anoModelo, placa, quilometragem, codCliente)
VALUES
    ('Kawasaki', 'Z900RS ', '2024', '2024', 'ISG4O94', 6900, 1),
    ('Lambretta', 'Vespa PX 200 ', '1986', '1987', 'SBPHQK', 141000, 1),
    ('Harley-Davidson', 'HERITAGE CLASSIC ', '2014', '2015', 'JBL7B27', 93500, 2);

CREATE TABLE peca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codPlaca VARCHAR(15),
    nome VARCHAR(100),
    vida_util_esperada INT,
    km_ultima_substituicao INT,
    condicao VARCHAR(50),
    FOREIGN KEY (codPlaca) REFERENCES veiculo(placa)
);

INSERT INTO peca (codPlaca, nome, vida_util_esperada, km_ultima_substituicao)
VALUES
    ('ISG4O94', 'Pastilha de Freio', 30000, 0),
    ('ISG4O94', 'Óleo Semissintético', 7000, 0),
    ('ISG4O94', 'Correia do Motor', 100000, 0),
    ('ISG4O94', 'Cabo de Embreagem', 10000, 0),
    ('SBPHQK', 'Pastilha de Freio', 30000, 120000),
    ('SBPHQK', 'Óleo Mineral', 7000, 135000),
    ('SBPHQK', 'Correia do Motor', 100000, 89000),
    ('SBPHQK', 'Cabo de Embreagem', 10000, 140000),
    ('JBL7B27', 'Pastilha de freio', 30000, 70000),
    ('JBL7B27', 'Óleo Sintético', 10000, 90000),
    ('JBL7B27', 'Correia do Motor', 100000, 0),
    ('JBL7B27', 'Cabo de Embreagem', 10000, 93500);
