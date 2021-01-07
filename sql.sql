CREATE DATABASE ecommerce1;

USE ecommerce1;

CREATE TABLE categories(
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENTE,
    category VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE pages(
    id INT UNSIGNED NOT NULL AUTO_INCREMENTE, 
    categories_id SMALLINT UNSIGNED NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TINYTEXT NOT NULL,
    content LONGTEXT,
    data_created TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY (id),
    FOREING KEY (categories_id) REFERENCES pages(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE pdfs(
    id INT UNSIGNED 
    title 
    description 
    tmp_name
    file_name,
    size,
    data_created
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE users(
    id,
    type,
    username,
    email,
    pass,
    first_name,
    last_name,
    data_created,
    date_expires,
    date_modified
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE orders(
    id,
    users_id,
    transaction_id,
    payment_status,
    payment_amount,
    date_created
)ENGINE=InnoDB DEFAULT CHARSET=utf8;