<?php

require_once __DIR__.'/../src/Utils/Connect.php';

$database = require_once __DIR__.'/../config/database.php';

use Utils\Connect;

Connect::set(['dsn' => $database['dsn'], 'user' => $database['user'], 'password' => $database['password']]);

if (is_null(Connect::$pdo)) {
        throw new RuntimeException(sprintf('database connect migration fail'));
    }

$db = Connect::$pdo;

/**
 * @create migrations
 */
$count = $db->exec("
  CREATE TABLE migrations (
    `batch` INT UNSIGNED NOT NULL,
    `migration` VARCHAR(100)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  ");


/**
 * @create table warehouse
 */
$count = $db->exec("
  CREATE TABLE warehouses (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `row` SMALLINT ,
    `column` SMALLINT ,
     PRIMARY KEY (id)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  ");


/**
 * @create table products
 */
$count = $db->exec("
  CREATE TABLE products (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `weight` SMALLINT,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  ") ;

/**
 * @create table product_warehouse (abc order)
 */
$count = $db->exec("
  CREATE TABLE product_warehouse (
  warehouse_id INT UNSIGNED,
  product_id INT UNSIGNED,
  quantity INT NOT NULL DEFAULT 0,
  CONSTRAINT product_warehouse_warehouses_warehouse_id_foreign FOREIGN KEY(warehouse_id) REFERENCES warehouses(id) ON DELETE CASCADE,
  CONSTRAINT product_warehouse_products_product_id_foreign FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE,
  CONSTRAINT un_warehouse_id_product_id UNIQUE KEY (warehouse_id, product_id )
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  ") ;

$count = $db->exec("
  CREATE TABLE orders (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `row` SMALLINT,
    `column` SMALLINT,
    `items` SMALLINT,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  ");

$count = $db->exec("
  CREATE TABLE order_product (
  order_id INT UNSIGNED,
  product_id INT UNSIGNED,
  quantity INT NOT NULL DEFAULT 0,
  CONSTRAINT order_product_orders_order_id_foreign FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,
  CONSTRAINT order_product_products_product_id_foreign FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE,
  CONSTRAINT un_order_id_product_id UNIQUE KEY (order_id, product_id )
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  ");


