<?php namespace Save;

class Container
{

    protected $drones = null;

    protected $stock = null;

    protected $warehouses = [];

    protected $orders = null;

    protected $nbOrder = 0;

    protected $products = null;

    protected $typeProd = 0;

    use MutatorTrait;

    /**
     * @return int
     */
    public function getTypeProd()
    {
        return $this->typeProd;
    }

    /**
     * @param int $typeProd
     */
    public function setTypeProd($typeProd)
    {
        $this->typeProd = (int)$typeProd;
    }

    /**
     * @return int
     */
    public function getNbOrder()
    {
        return $this->nbOrder;
    }

    /**
     * @param int $nbOrder
     */
    public function setNbOrder($nbOrder)
    {
        $this->nbOrder = (int)$nbOrder;
    }

    /**
     * @param $id int
     * @return Order
     */
    public function getOrder($id)
    {
        if (empty($this->orders[(int)$id])) {
            throw new \RuntimeException(sprintf('this order doesnt exists %s', $id));
        }

        return $this->orders[(int)$id];
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->orders[] = $order;
    }

    /**
     * @return specific Drone
     */
    public function getDrone($id)
    {
        if (empty($this->drones[(int)$id])) {
            throw new \RuntimeException(sprintf('this drone doesnt exists %s', $id));
        }

        return $this->drones[(int)$id];
    }

    /**
     * @param Drone $drone
     */
    public function setDrone(Drone $drone)
    {
        $this->drones[] = $drone;
    }

    /**
     * @param $id
     * @return Product
     */
    public function getProduct($id)
    {
        if (empty($this->products[(int)$id])) {
            throw new \RuntimeException(sprintf('this product doesnt exists %s', $id));
        }

        return $this->products[(int)$id];
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->products[$product->id] = $product;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \RuntineException
     */
    public function getWarehouse($id)
    {
        $id = (int)$id;
        if (empty($this->warehouses[$id])) {
            throw new \RuntimeException(sprintf('this warehouse doesnt exists %s', $id));
        }

        return $this->warehouses[$id];
    }

    /**
     * @param Warehouse $warehouse
     */
    public function setWarehouse(Warehouse $warehouse)
    {
        $this->warehouses[] = $warehouse;

    }

    /**
     * @return array Warehouse
     */
    public function allWarehouse()
    {
        return $this->warehouses;
    }

    /**
     * @return array Warehouse
     */
    public function allOrder()
    {
        return $this->orders;
    }

    /**
     * @return array Warehouse
     */
    public function allProduct()
    {
        return $this->products;
    }

}