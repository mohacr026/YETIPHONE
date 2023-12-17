-- Crear la tabla admin
CREATE TABLE admin (
  email VARCHAR(50) PRIMARY KEY,
  pass VARCHAR(255)
);

-- Crear la tabla category
CREATE TABLE category (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255),
  parentCategory INT REFERENCES category(id),
  isActive BOOLEAN
);

-- Crear la tabla product
CREATE TABLE product (
  id VARCHAR(10) PRIMARY KEY,
  name VARCHAR(100),
  description VARCHAR(2000),
  id_category INT REFERENCES category(id),
  img VARCHAR(150),
  price INT,
  stock INT,
  storage INT,
  memory INT,
  featured BOOLEAN,
  isActive BOOLEAN
);

-- Crear la tabla de colores
CREATE TABLE colors (
  id SERIAL PRIMARY KEY,
  product INT REFERENCES product(id),
  color_code VARCHAR(20)
);

-- Crear la tabla purchase_details
CREATE TABLE purchase_details (
  id SERIAL PRIMARY KEY,
  product_id INT REFERENCES product(id),
  quantity INT
);

-- Crear la tabla purchase
CREATE TABLE purchase (
  id SERIAL PRIMARY KEY,
  id_user VARCHAR(255),
  purchase_details_id INT REFERENCES purchase_details(id),
  status VARCHAR(10) CHECK (status IN ('PENDING', 'SHIPPED')),
  date_order TIMESTAMP,
  date_shipment TIMESTAMP
);

-- Crear la tabla usuarios
CREATE TABLE users (
  email VARCHAR(255),
  phone_number VARCHAR(20),
  username VARCHAR(255),
  surname VARCHAR(255),
  direction VARCHAR(255),
  password VARCHAR(255),
  isActive BOOLEAN
);

-- Insert de cuenta admin
INSERT INTO admin (email, pass) VALUES ('admin@gmail.com', MD5('admin'));