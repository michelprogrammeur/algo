<?php namespace Save;

class Order
{
    /**
     * @var row pos to delivered
     */
    protected $row;

    /**
     * @var column delivered
     */
    protected $column;

    /**
     * @var
     * number of products
     */
    protected $items = 0;

    /**
     * @var id order
     */
    protected $id;

    /**
     * @var
     * products ordres
     */
    protected $products = [];

    use MutatorTrait;

    /**
     * @return id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param id $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @return row
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param row $row
     */
    public function setRow($row)
    {
        $this->row = (int) $row;
    }

    /**
     * @return column
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param column $column
     */
    public function setColumn($column)
    {
        $this->column = (int) $column;
    }

    /**
     * @return int
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = (int) $items;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProduct($id)
    {
        if (empty($this->products[(int)$id])) {
            throw new \RuntimeException(sprintf('this warehouse doesnt exists %s', $id));
        }

        return $this->products[(int)$id];
    }

    /**
     * @param $products
     */
    public function setProduct(Product $products)
    {
        $this->products[] = $products;
    }

    /**
     * @return array Product
     */
    public function allProduct()
    {
        return $this->products;
    }

}