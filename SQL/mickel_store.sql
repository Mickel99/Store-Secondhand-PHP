CREATE DATABASE Mickel_Store;

USE Mickel_Store;

CREATE TABLE sellers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL
);

CREATE TABLE clothes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clothing VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    sold BOOLEAN DEFAULT FALSE,
    seller_id INT NOT NULL,
    FOREIGN KEY (seller_id) REFERENCES sellers(id)
);
