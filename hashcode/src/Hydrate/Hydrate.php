<?php namespace Hydrate;

use Utils\Connect;

class Hydrate
{

    public function __construct()
    {
        if (is_null(Connect::$pdo))
            throw new \RuntimeException(sprintf('no connection database'));
    }

    /**
     * @param array $products
     */
    public function setProduct(array $products)
    {

        foreach ($products as $product) {
            $data = " weight='{$product->weight}'";
            Connect::$pdo->query(sprintf("INSERT INTO `products` SET %s", $data));
        }

    }

    /**
     * @param array $warehouses
     */
    public function setWarehouse(array $warehouses)
    {
        foreach ($warehouses as $warehouse) {
            $data = "`row` = '{$warehouse->row}', `column`='{$warehouse->column}'";
            Connect::$pdo->query(sprintf("INSERT INTO `warehouses` SET %s", $data));
        }

        Connect::$pdo->query(sprintf("INSERT INTO `migrations` SET migration='%s', batch=%d", 'warehouse', 1));
    }

    /**
     * @param $warehouseId
     * @param array $products
     */
    public function relWarehouseProd($warehouseId, array $products)
    {
        foreach ($products as $info) {

            $product = $info['product'];
            $quantity = $info['quantity'];

            $data = "product_id = " . ($product->id + 1) . ", warehouse_id=$warehouseId, quantity=$quantity";

            Connect::$pdo->query(sprintf("INSERT INTO `product_warehouse` SET %s", $data));

        }

        Connect::$pdo->query(sprintf("INSERT INTO `migrations` SET migration='%s', batch=%d", 'product_warehouse', 1));

    }

    /**
     * @param array $orders
     */
    public function setOrder(array $orders)
    {

        foreach ($orders as $order) {
            $data = "`row`='{$order->row}', `column`='{$order->column}', items={$order->items}";
            Connect::$pdo->query(sprintf("INSERT INTO `orders` SET %s", $data));
        }

    }

    /**
     * @param $orderId
     * @param array $products
     */
    public function relOrderProd($orderId, array $products)
    {
        foreach ($products as $product) {
            $dataAnd = "product_id = " . ($product->id + 1) . " AND order_id=$orderId";
            $sql = sprintf('SELECT COUNT(*) FROM order_product WHERE %s', $dataAnd);

            $res = Connect::$pdo->query($sql);

            if ($res->fetchColumn() > 0) {
                $data = "product_id = " . ($product->id + 1) . ", order_id=$orderId, quantity=quantity+1";
                Connect::$pdo->query(sprintf("UPDATE `order_product` SET %s WHERE %s", $data, $dataAnd));
            } else {
                $data = "product_id = " . ($product->id + 1) . ", order_id=$orderId, quantity=1";
                Connect::$pdo->query(sprintf("INSERT INTO `order_product` SET %s", $data));
            }
        }

    }

}