<?php

require_once 'Letter.php';
require_once 'View.php';

$letter = new Letter;

$view = new View;

$letters = $letter->getLetters();

$letter->setPos(1,1);

var_dump($letter->generateMovePossible(0,0, 2)); die('ici');

$view->render('./views/index', compact('letters'));

$square[] = range(0,2);
$square[] = range(0,2);
$square[] = range(0,2);

var_dump($square);

