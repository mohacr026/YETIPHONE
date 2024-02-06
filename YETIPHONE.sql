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
  price INT,
  stock INT,
  storage INT,
  memory INT,
  featured BOOLEAN,
  isActive BOOLEAN
);

-- Crear la tabla de imagenes 
CREATE TABLE product_image (
  id SERIAL PRIMARY KEY,
  img VARCHAR(150),
  product_id VARCHAR(10) REFERENCES product(id)
);

-- Crear la tabla de colores
CREATE TABLE colors (
  id SERIAL PRIMARY KEY,
  product_id VARCHAR(10) REFERENCES product(id),
  color_code VARCHAR(20)
);

-- Crear la tabla purchase_details
CREATE TABLE purchase_details (
  id SERIAL PRIMARY KEY,
  purchase_id INT,
  product_id VARCHAR(10) REFERENCES product(id),
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
  dni VARCHAR(9) PRIMARY KEY,
  email VARCHAR(255) UNIQUE,
  phone_number VARCHAR(20),
  username VARCHAR(255),
  surname VARCHAR(255),
  direction VARCHAR(255),
  password VARCHAR(255),
  isActive BOOLEAN
);

CREATE TABLE userCarts (
  email VARCHAR(255),
  lastCart JSONB,
  PRIMARY KEY (email)
);

CREATE TABLE companyInfo(
  name VARCHAR(255),
  direction VARCHAR(255)
);

-- Insert de cuenta admin
INSERT INTO admin (email, pass) VALUES ('admin@gmail.com', MD5('admin'));

-- Insert companyInfo
INSERT INTO companyInfo (name, direction) VALUES ('YETiPhone', 'Yetiphones direction');