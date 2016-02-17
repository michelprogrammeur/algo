<?php

class Letter
{

    private $letters = [];

    private $alphabet = [];

    private $emptySquare = [];

    private $storage = [];

    private $pos = [];

    public function __construct()
    {
        foreach (range(65, 90) as $in) $this->alphabet[] = chr($in);
        $this->generateLetter();

        $this->generateEmptySquare();
    }

    /**
     * @return array
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @param $posX
     * @param $posY
     */
    public function setPos($posX, $posY)
    {
        $this->pos[] = $posX;
        $this->pos[] = $posY;
    }


    /**
     * @return array
     */
    public function getAlphabet()
    {
        return $this->alphabet;
    }

    /**
     * @param array $alphabet
     */
    public function setAlphabet($alphabet)
    {
        $this->alphabet = $alphabet;
    }


    private function generateLetter()
    {
        shuffle($this->alphabet);

        foreach (range(1, 4) as $r) {
            foreach (range(1, 4) as $c) {
                $this->letters[$r][$c] = array_shift($this->alphabet);
            }
        }

    }

    public function getLetters()
    {
        return $this->letters;
    }

    public function generateEmptySquare()
    {
        $i = 1;
        foreach (range(0, 3) as $r) {
            foreach (range(0, 3) as $c) {
                $this->emptySquare[$r][$c] = $i++;
            }
        }
    }

    public function generateMovePossible($row, $column, $length, $storage = [])
    {
        $pos = $this->emptySquare;

        static $rowStart = 0, $columnStart = 0;

        if($rowStart==$row && $columnStart==$column) return ;

        if ($rowStart == 0) $rowStart = $row;
        if ($columnStart == 0) $columnStart = $columnStart;

        $point = $pos[$row][$column];

        $min = 1;

        if (isset($pos[$row][$column - 1])) {

            echo $pos[$row][$column - 1];

            if ($length > $min) {
                $length--;

                return $this->generateMovePossible($row, ($column - 1), $length, $storage);
            }

        } // left

        if (isset($pos[$row][$column + 1])) {
            echo $pos[$row][$column + 1];


            if ($length > $min) {
                $length--;

                return $this->generateMovePossible($row, ($column + 1), $length, $storage);
            }
        } // right

        if (isset($pos[$row - 1][$column])) {
            echo  $pos[$row - 1][$column];


            if ($length > $min) {
                $length--;

                return $this->generateMovePossible(($row - 1), $column, $length, $storage);
            }
        } // top

        if (isset($pos[$row + 1][$column])) {
            echo  $pos[$row + 1][$column];


            if ($length > $min) {
                $length--;

                return $this->generateMovePossible(($row + 1), $column, $length, $storage);
            }
        } // bottom

        if (isset($pos[$row + 1][$column + 1]) && (($row + 1) != $rowStart || ($column + 1) != $columnStart)) {
            echo  $pos[$row + 1][$column + 1];


            if ($length > $min) {
                $length--;

                return $this->generateMovePossible(($row + 1), ($column + 1), $length, $storage);
            }
        } // diagonal bottom left

        if (isset($pos[$row - 1][$column - 1])) {
            echo  $pos[$row - 1][$column - 1];


            if ($length > $min) {
                $length--;

                return $this->generateMovePossible(($row - 1), ($column - 1), $length, $storage);
            }
        } // diagonal bottom right

        if (isset($pos[$row + 1][$column - 1])) {
            echo  $pos[$row + 1][$column - 1];


            if ($length > $min) {
                $length--;

                return $this->generateMovePossible($row + 1, $column - 1, $length, $storage);
            }
        } // diagonal top right

        if (isset($pos[$row - 1][$column + 1])) {
            echo  $pos[$row - 1][$column + 1];


            if ($length > $min) {
                $length--;

                return $this->generateMovePossible(($row - 1), ($column + 1), $length, $storage);
            }
        } // diagonal bottom left


        return $storage;

    }

    // todo recursive 8 directions

}