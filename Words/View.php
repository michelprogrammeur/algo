<?php

class View
{

    /**
     * @param $file
     * @param array $data
     */
    public function render($file, array $data)
    {
        $file = $file . ".php";

        if (!file_exists($file)) die(sprintf('this file doesn\'t exists, %s', $file));

        extract($data);
        require_once __DIR__ . '/' . $file;

    }

}