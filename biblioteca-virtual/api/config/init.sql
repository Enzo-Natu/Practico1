CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_rol INT NOT NULL,
    CONSTRAINT fk_usuario_rol FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

CREATE TABLE autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre_autor VARCHAR(100) NOT NULL,
    nacionalidad VARCHAR(50)
);

CREATE TABLE editoriales (
    id_editorial INT AUTO_INCREMENT PRIMARY KEY,
    nombre_editorial VARCHAR(100) NOT NULL
);

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL
);

CREATE TABLE articulos (
    id_articulo INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    tipo ENUM('libro', 'revista', 'audio') NOT NULL,
    meta_info VARCHAR(50) NOT NULL,
    calificacion DECIMAL(2,1) DEFAULT 0.0,
    id_autor INT NOT NULL,
    id_editorial INT NOT NULL,
    id_categoria INT NOT NULL,
    CONSTRAINT fk_articulo_autor FOREIGN KEY (id_autor) REFERENCES autores(id_autor),
    CONSTRAINT fk_articulo_editorial FOREIGN KEY (id_editorial) REFERENCES editoriales(id_editorial),
    CONSTRAINT fk_articulo_categoria FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- 1. Insertar los roles correspondientes
INSERT INTO roles (nombre_rol) VALUES ('Administrador'), ('Usuario');

-- 2. Insertar usuarios de prueba (Nota: Las contraseñas aquí están hasheadas con bcrypt)
-- La contraseña para ambos usuarios en este ejemplo de prueba es: 123456
-- Hash correspondiente a '123456': $2y$10$Vcmt6TIJsHEZPlyuZnTAQ.wdUtEuQpR4jKLwiuiv0hhCm0o12E6ny

INSERT INTO usuarios (nombre, email, password, id_rol) VALUES 
('Administrador General', 'admin@bibliovirtual.com', '$2y$10$Vcmt6TIJsHEZPlyuZnTAQ.wdUtEuQpR4jKLwiuiv0hhCm0o12E6ny', 1),
('Juan Pérez', 'usuario@bibliovirtual.com', '$2y$10$Vcmt6TIJsHEZPlyuZnTAQ.wdUtEuQpR4jKLwiuiv0hhCm0o12E6ny', 2);