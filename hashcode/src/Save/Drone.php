<?php namespace Save;

class Drone
{
    protected $turns;
    protected $maxWeight;

    use MutatorTrait;

    public function __construct($turns, $maxWeight)
    {
        $this->setMaxWeight($maxWeight);
        $this->setTurns($turns);
    }

    /**
     * @return mixed
     */
    public function getTurns()
    {
        return $this->turns;
    }

    /**
     * @param mixed $turns
     */
    public function setTurns($turns)
    {
        $this->turns = $turns;
    }

    /**
     * @return mixed
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @param mixed $maxWeight
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;
    }


}