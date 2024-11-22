CREATE TABLE mesas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL UNIQUE,
    status ENUM('disponível', 'ocupada') DEFAULT 'disponível'
) ENGINE=InnoDB;

CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(512) NOT NULL,  -- Senha já com hash
    email VARCHAR(100) NOT NULL,
    CONSTRAINT UC_Funcionario UNIQUE (usuario)
) ENGINE=InnoDB;

CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    funcionario_id INT,
    cliente_nome VARCHAR(100) NOT NULL,
    mesa_id INT,
    data DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    status varchar(20) not null,
    CONSTRAINT FK_Funcionario FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id),
    CONSTRAINT FK_Mesa FOREIGN KEY (mesa_id) REFERENCES mesas(id),
    CONSTRAINT UC_Reserva UNIQUE (data, hora_inicio, mesa_id)  -- Garantir que não haja sobreposição de reservas
) ENGINE=InnoDB;


CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    funcionario_id INT,
    cliente_nome VARCHAR(100) NOT NULL,
    mesa_id INT,
    data DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    status ENUM('ativa', 'cancelada') DEFAULT 'ativa',
    CONSTRAINT FK_Funcionario FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id),
    CONSTRAINT FK_Mesa FOREIGN KEY (mesa_id) REFERENCES mesas(id),
    CONSTRAINT UC_Reserva UNIQUE (data, hora_inicio, mesa_id)  
) ENGINE=InnoDB;


