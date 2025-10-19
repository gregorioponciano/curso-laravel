-- Banco de dados do Burger Express
CREATE DATABASE IF NOT EXISTS burger_express CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE burger_express;

-- Tabela de usuários
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NULL,
    tipo ENUM('cliente', 'admin', 'funcionario') DEFAULT 'cliente',
    status ENUM('ativo', 'inativo', 'suspenso') DEFAULT 'ativo',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_status (status)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de endereços dos usuários
CREATE TABLE enderecos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    cep VARCHAR(10) NOT NULL,
    rua VARCHAR(255) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(255) NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    referencia TEXT NULL,
    principal BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_principal (principal)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de categorias de produtos
CREATE TABLE categorias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NULL,
    imagem VARCHAR(255) NULL,
    ordem INT DEFAULT 0,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_ordem (ordem)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de produtos
CREATE TABLE produtos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(10,2) NOT NULL,
    preco_promocional DECIMAL(10,2) NULL,
    imagem VARCHAR(255) NOT NULL,
    ingredientes_base JSON NULL, -- Armazena ingredientes padrão do produto
    tempo_preparo INT DEFAULT 15, -- Tempo em minutos
    disponivel BOOLEAN DEFAULT TRUE,
    destaque BOOLEAN DEFAULT FALSE,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT,
    INDEX idx_categoria_id (categoria_id),
    INDEX idx_status (status),
    INDEX idx_disponivel (disponivel),
    INDEX idx_destaque (destaque),
    FULLTEXT idx_nome_descricao (nome, descricao)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de adicionais
CREATE TABLE adicionais (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(8,2) NOT NULL,
    slug VARCHAR(50) UNIQUE NOT NULL, -- Identificador único (bacon, cheddar, etc)
    disponivel BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_disponivel (disponivel),
    INDEX idx_slug (slug)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de adicionais disponíveis por produto
CREATE TABLE produto_adicionais (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    produto_id BIGINT UNSIGNED NOT NULL,
    adicional_id BIGINT UNSIGNED NOT NULL,
    ordem INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (adicional_id) REFERENCES adicionais(id) ON DELETE CASCADE,
    UNIQUE KEY unique_produto_adicional (produto_id, adicional_id),
    INDEX idx_produto_id (produto_id),
    INDEX idx_ordem (ordem)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de pedidos
CREATE TABLE pedidos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    codigo_pedido VARCHAR(20) UNIQUE NOT NULL, -- Formato: BE-2024-000001
    user_id BIGINT UNSIGNED NOT NULL,
    endereco_id BIGINT UNSIGNED NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    taxa_entrega DECIMAL(8,2) DEFAULT 0.00,
    metodo_pagamento ENUM('pix', 'cartao', 'dinheiro') NOT NULL,
    status ENUM(
        'pendente', 
        'confirmado', 
        'preparando', 
        'pronto', 
        'saiu_entrega', 
        'entregue', 
        'cancelado'
    ) DEFAULT 'pendente',
    observacao TEXT NULL,
    avaliacao TINYINT UNSIGNED NULL CHECK (avaliacao BETWEEN 1 AND 5),
    comentario_avaliacao TEXT NULL,
    tempo_estimado INT NULL, -- Tempo total estimado em minutos
    data_confirmado TIMESTAMP NULL,
    data_preparando TIMESTAMP NULL,
    data_pronto TIMESTAMP NULL,
    data_saiu_entrega TIMESTAMP NULL,
    data_entregue TIMESTAMP NULL,
    data_cancelado TIMESTAMP NULL,
    motivo_cancelamento TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (endereco_id) REFERENCES enderecos(id) ON DELETE RESTRICT,
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_codigo_pedido (codigo_pedido),
    INDEX idx_created_at (created_at),
    INDEX idx_metodo_pagamento (metodo_pagamento)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de itens do pedido
CREATE TABLE pedido_itens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pedido_id BIGINT UNSIGNED NOT NULL,
    produto_id BIGINT UNSIGNED NOT NULL,
    nome_produto VARCHAR(255) NOT NULL, -- Nome no momento do pedido
    preco_unitario DECIMAL(8,2) NOT NULL, -- Preço no momento do pedido
    quantidade INT NOT NULL DEFAULT 1,
    personalizacao JSON NULL, -- Armazena remoções e adicionais
    observacao TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE RESTRICT,
    INDEX idx_pedido_id (pedido_id),
    INDEX idx_produto_id (produto_id)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de carrinho (sessão temporária)
CREATE TABLE carrinhos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    session_id VARCHAR(255) NULL, -- Para usuários não logados
    item_data JSON NOT NULL, -- Armazena todos os dados do item
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_session_id (session_id)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de configurações do sistema
CREATE TABLE configuracoes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    chave VARCHAR(100) UNIQUE NOT NULL,
    valor TEXT NOT NULL,
    tipo ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    descricao TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_chave (chave)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de histórico de status dos pedidos
CREATE TABLE pedido_historico (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pedido_id BIGINT UNSIGNED NOT NULL,
    status_anterior VARCHAR(50) NULL,
    status_novo VARCHAR(50) NOT NULL,
    observacao TEXT NULL,
    user_id BIGINT UNSIGNED NULL, -- Quem alterou o status
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_pedido_id (pedido_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de cupons de desconto
CREATE TABLE cupons (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE NOT NULL,
    descricao VARCHAR(255) NULL,
    tipo_desconto ENUM('percentual', 'valor_fixo') NOT NULL,
    valor_desconto DECIMAL(8,2) NOT NULL,
    valor_minimo DECIMAL(8,2) NULL,
    usos_maximos INT NULL,
    usos_atuais INT DEFAULT 0,
    data_validade DATE NULL,
    ativo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_codigo (codigo),
    INDEX idx_ativo (ativo),
    INDEX idx_data_validade (data_validade)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Tabela de cupons utilizados
CREATE TABLE cupons_utilizados (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cupom_id BIGINT UNSIGNED NOT NULL,
    pedido_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    valor_desconto_aplicado DECIMAL(8,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cupom_id) REFERENCES cupons(id) ON DELETE RESTRICT,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_cupom_pedido (cupom_id, pedido_id),
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Inserir dados iniciais
INSERT INTO categorias (nome, descricao, ordem, status) VALUES
('Lanches', 'Deliciosos hambúrgueres artesanais', 1, 'ativo'),
('Acompanhamentos', 'Porções e complementos', 2, 'ativo'),
('Bebidas', 'Refrigerantes, sucos e cervejas', 3, 'ativo'),
('Sobremesas', 'Doces e sobremesas especiais', 4, 'ativo');

INSERT INTO adicionais (nome, descricao, preco, slug, disponivel) VALUES
('Bacon Extra', 'Fatias crocantes de bacon', 5.00, 'bacon', TRUE),
('Queijo Cheddar', 'Queijo cheddar derretido', 3.00, 'cheddar', TRUE),
('Ovo Frito', 'Ovo frito especial', 2.00, 'ovo', TRUE),
('Molho Especial', 'Molho secreto da casa', 1.50, 'molho_especial', TRUE),
('Cebola Caramelizada', 'Cebola caramelizada no mel', 2.50, 'cebola_caramelizada', TRUE);

INSERT INTO configuracoes (chave, valor, tipo, descricao) VALUES
('nome_restaurante', 'Burger Express', 'string', 'Nome do restaurante'),
('telefone_contato', '(14) 99176-1256', 'string', 'Telefone para contato'),
('taxa_entrega', '5.00', 'number', 'Taxa de entrega padrão'),
('tempo_entrega_estimado', '45', 'number', 'Tempo estimado de entrega em minutos'),
('horario_funcionamento', '18:00-23:00', 'string', 'Horário de funcionamento'),
('pedido_minimo', '25.00', 'number', 'Valor mínimo para pedido'),
('whatsapp_numero', '5514991761256', 'string', 'Número do WhatsApp para pedidos');

-- Trigger para gerar código do pedido automaticamente
DELIMITER //
CREATE TRIGGER before_insert_pedidos
BEFORE INSERT ON pedidos
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    
    IF NEW.codigo_pedido IS NULL THEN
        SELECT COALESCE(MAX(CAST(SUBSTRING(codigo_pedido, 9) AS UNSIGNED)), 0) + 1 
        INTO next_id 
        FROM pedidos 
        WHERE codigo_pedido LIKE CONCAT('BE-', YEAR(CURRENT_DATE), '-%');
        
        SET NEW.codigo_pedido = CONCAT('BE-', YEAR(CURRENT_DATE), '-', LPAD(next_id, 6, '0'));
    END IF;
END//
DELIMITER ;

-- Trigger para atualizar histórico de pedidos
DELIMITER //
CREATE TRIGGER after_update_pedidos
AFTER UPDATE ON pedidos
FOR EACH ROW
BEGIN
    IF OLD.status != NEW.status THEN
        INSERT INTO pedido_historico (pedido_id, status_anterior, status_novo, created_at)
        VALUES (NEW.id, OLD.status, NEW.status, NOW());
    END IF;
END//
DELIMITER ;

-- Views úteis
CREATE VIEW view_pedidos_detalhados AS
SELECT 
    p.id,
    p.codigo_pedido,
    p.user_id,
    u.name as cliente_nome,
    u.email as cliente_email,
    p.total,
    p.metodo_pagamento,
    p.status,
    p.created_at,
    COUNT(pi.id) as total_itens,
    TIMESTAMPDIFF(MINUTE, p.created_at, NOW()) as minutos_decorridos
FROM pedidos p
LEFT JOIN users u ON p.user_id = u.id
LEFT JOIN pedido_itens pi ON p.id = pi.pedido_id
GROUP BY p.id;

CREATE VIEW view_produtos_populares AS
SELECT 
    p.id,
    p.nome,
    p.categoria_id,
    c.nome as categoria_nome,
    COUNT(pi.id) as total_vendidos,
    SUM(pi.quantidade) as total_itens_vendidos,
    AVG(pr.avaliacao) as media_avaliacao
FROM produtos p
LEFT JOIN categorias c ON p.categoria_id = c.id
LEFT JOIN pedido_itens pi ON p.id = pi.produto_id
LEFT JOIN pedidos pr ON pi.pedido_id = pr.id AND pr.avaliacao IS NOT NULL
WHERE p.status = 'ativo'
GROUP BY p.id
ORDER BY total_vendidos DESC;