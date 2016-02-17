<?php namespace Utils;

use Save\Warehouse;
use Save\Container;
use Save\Product;
use Save\Stock;
use Save\Order;
use Save\Drone;
use Save\Map;

class Parsing
{
    protected $file;
    protected $nbWarehouse = 0;

    public function __construct($file)
    {
        $this->file = (string)$file;
    }

    public function get()
    {
        if (empty($this->file)) throw new \RuntineException(sprintf('must be defined file parsing'));

        $handle = fopen($this->file, 'r');

        if ($handle) {
            $r = 0;
            $container = new Container;

            while ((($line = fgets($handle, 4096)) !== false)) {

                if (!empty($decalOrder)) $decalOrder++;

                if ($r == 0) {
                    $simulation = explode(' ', rtrim($line));

                    if (count($simulation) != 5) throw new RuntimeException('simulation error');

                    Map::$row = $simulation[0];
                    Map::$column = $simulation[1];

                    for ($i = 0; $i < $simulation[2]; $i++) {
                        $container->drone = new Drone($simulation[3], $simulation[4]);
                    }
                }
                // number products
                if ($r == 1) {
                    $container->typeProd = rtrim($line);
                }

                // products
                if ($r == 2) {

                    $p = explode(' ', rtrim($line));

                    for ($i = 0; $i < count($p); $i++) {
                        $product = new Product;
                        $product->id = $i;
                        $product->weight = $p[$i];
                        $container->product = $product;
                    }

                }
                // number warehouse
                if ($r == 3) {
                    $this->nbWarehouse = rtrim($line);
                    $idW = 0;
                }

                if ($r >= 4 && $r < (2 * $this->nbWarehouse + 4)) {

                    if ($r % 2 == 0) {
                        $cord = explode(' ', rtrim($line));
                        $warehouse = new Warehouse;
                        $warehouse->row = $cord[0];
                        $warehouse->column = $cord[1];
                        $warehouse->id = $idW;
                        $idW++;

                    }
                    // products firts warehouse
                    if ($r % 2 == 1) {
                        // set id product and quantity
                        $products = explode(' ', rtrim($line));
                        for ($id = 0; $id < count($products); $id++) {
                            if ($products[$id] != 0) {
                                // set product and quantity into warehouse
                                $p = $container->getProduct($id);
                                $warehouse->setProduct($p, $products[$id]);
                            }
                        }
                        $container->setWarehouse($warehouse);

                    }

                }

                // number order
                if ($r == (2 * $this->nbWarehouse + 4)) {
                    $container->nbOrder = rtrim($line);
                    $decalOrder = 2;
                    $idO = 0;
                }

                if ($r > (2 * $this->nbWarehouse + 4)) {
                    if (($decalOrder % 3) == 0) {
                        $pos = explode(' ', rtrim($line));
                        $order = new Order;
                        $order->row = $pos[0];
                        $order->column = $pos[1];
                        $order->id = $idO;
                    }

                    if (($decalOrder % 3) == 1) {
                        $order->items = rtrim($line);
                    }

                    if (($decalOrder % 3) == 2) {
                        $types = explode(' ', rtrim($line));

                        foreach ($types as $typeId) {
                            $order->product = $container->getProduct($typeId);
                        }

                        $container->order = $order;
                        $idO++;
                    }
                }
                $r++;
            }
            fclose($handle);

            return $container;
        }
    }

    public function getWarehouse($r=4, $number=10)
    {

    }

}
