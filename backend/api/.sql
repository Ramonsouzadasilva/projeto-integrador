CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    senha VARCHAR(255) -- armazenada como hash SHA-512
)ENGINE=INNODB;

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nome VARCHAR(255),
    mesa_id INT,
    data_hora_inicio DATETIME,
    data_hora_fim DATETIME,
    funcionario_id INT,
    status ENUM('ativo', 'cancelada') DEFAULT 'ativo',
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id)
)ENGINE=INNODB;
