<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Utils\Connect;
use Hydrate\Hydrate;
use Utils\Parsing;

$defaults = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$database = require_once __DIR__ . '/../config/database.php';

Connect::set(['dsn' => $database['dsn'], 'user' => $database['user'], 'password' => $database['password']], $defaults);


/**
 * @hydrate data
 */

$parsing = new Parsing(__DIR__ . '/../src/dump/busy_day.in');

$sql = 'SELECT COUNT(*) FROM migrations';

$res = Connect::$pdo->query($sql);

if ($res->fetchColumn() == 0) {

    $hydrate = new Hydrate;
    $c = $parsing->get();

    $hydrate->setProduct($c->allProduct());
    $hydrate->setWarehouse($c->allWarehouse());

    foreach ($c->allWarehouse() as $warehouse) {

        $warehouseId = $warehouse->id + 1;

        $hydrate->relWarehouseProd($warehouseId, $warehouse->allProduct());
    }
    Connect::$pdo->query(sprintf("INSERT INTO `migrations` SET migration='%s', batch=%d", 'product_warehouse', 1));

    $hydrate->setOrder($c->allOrder());

    foreach ($c->allOrder() as $order) {

        $orderId = $order->id + 1;

        $hydrate->relOrderProd($orderId, $order->allProduct());
    }

    Connect::$pdo->query(sprintf("INSERT INTO `migrations` SET migration='%s', batch=%d", 'order_product', 1));


}