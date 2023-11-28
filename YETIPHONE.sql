-- Crear la tabla admin
CREATE TABLE admin (
  username VARCHAR(50) PRIMARY KEY,
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
  id SERIAL PRIMARY KEY,
  name VARCHAR(100),
  description VARCHAR(2000),
  id_category INT REFERENCES category(id),
  img VARCHAR(150),
  price INT,
  stock INT,
  featured BOOLEAN,
  isActive BOOLEAN
);

-- Crear la tabla purchase
CREATE TABLE purchase (
  id SERIAL PRIMARY KEY,
  id_user VARCHAR(255),
  products JSONB,
  status VARCHAR(10) CHECK (status IN ('PENDING', 'SHIPPED')),
  date_order TIMESTAMP,
  date_shipment TIMESTAMP
);

/*
EJEMPLO DE INSERCION EN PURCHASE

INSERT INTO purchase (id_user, products, status, date_order, date_shipment)
VALUES (
  'pablo@gmail.com',
  '[{"id_product": "prod1", "quantity": 2}, {"id_product": prod2, "quantity": 1}]'::JSONB,
  'PENDING',
  CURRENT_TIMESTAMP,
  NULL
);
*/

-- Crear la tabla usuarios
CREATE TABLE usuarios (
  email VARCHAR(255),
  phone_number VARCHAR(20),
  name VARCHAR(255),
  surname VARCHAR(255),
  direction VARCHAR(255),
  password VARCHAR(255),
  isActive BOOLEAN
);