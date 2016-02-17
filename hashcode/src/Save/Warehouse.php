<?php namespace Save;

class Warehouse implements \Countable
{
    protected $row;
    protected $column;
    protected $products = [];
    protected $id = 0;

    use MutatorTrait;

    /**
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param mixed $row
     */
    public function setRow($row)
    {
        $this->row = $row;
    }

    /**
     * @return mixed
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param mixed $column
     */
    public function setColumn($column)
    {
        $this->column = $column;
    }

    /**
     * @param $id int
     * @return Product
     */
    public function getProduct($id)
    {
        $id = (int)$id;
        if (empty($this->products[$id])) {
            throw new \RuntimeException(sprintf('this product doesnt exists %s', $id));
        }

        return $this->products[$id];
    }

    /**
     * @param Product $product
     * @param (int) $quantity
     */
    public function setProduct(Product $product, $quantity)
    {
        $this->products[] = ['quantity' => $quantity, 'product' => $product];
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function count()
    {
        return count($this->products);
    }

    /**
     * @return array Product
     */
    public function allProduct()
    {
        return $this->products;
    }

}